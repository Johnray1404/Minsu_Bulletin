<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Minsu extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->model(array('minsu_model')); 
    }

    public function login() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $data = [];
    
        if (isset($_SESSION['success'])) {
            $data['success'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }
    
        if (isset($_SESSION['error'])) {
            $data['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }
    
        if ($this->form_validation->submitted()) {
            $email = $this->io->post('email');
            $password = $this->io->post('password');
    
            if ($email === 'admin' && $password === 'admin') {
                $_SESSION['success'] = 'Login successful! Redirecting to the Admin Dashboard.';
                header("Location: /admin/dashboard");
                exit();
            }
    
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Email and password are required.';
            } else {
                if ($this->minsu_model->login($email, $password)) {
                    $_SESSION['success'] = 'Login successful! Redirecting to your homepage.';
                    header("Location: /home");
                    exit();
                } else {
                    $_SESSION['error'] = 'Invalid email or password!';
                }
            }
        }
    
        $this->call->view('minsu/login', $data);
    }
    
    
    
    
    public function signup() {
        $data = [];

        if ($this->form_validation->submitted()) {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            $email = $this->io->post('email');

            if (empty($username) || empty($password) || empty($email)) {
                $data['error'] = 'All fields are required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['error'] = 'Invalid email format';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                if ($this->minsu_model->signup($username, $hashed_password, $email)) {
                    $data['success'] = 'Registration successful! You can now log in.';
                } else {
                    $data['error'] = 'Registration failed';
                }
            }
        }

        $this->call->view('minsu/signup', $data);
    }

    public function home() {
        // Fetch the latest news posts sorted by created_at, newest first
        $data['news_posts'] = $this->minsu_model->get_all_news_sorted();
        
        // Pass the time_ago function to the view
        $data['time_ago'] = array($this, 'time_ago');  // Pass the function reference

        // Load the homepage view
        $this->call->view('minsu/homepage', $data);
    }
    

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        
        session_destroy(); 
        header('Location: /login');
        exit();
    }
    
    
    public function admin_dashboard() {
        $this->call->view('admin/dashboard');
    }

    public function contact() {
        $this->call->view('Minsu/contact');
    }

    public function news() {
        // Fetch the data from the model
        $data['news_posts'] = $this->minsu_model->get_all_news();  // Fetch all news posts
        
        // Check if the data is an array and not empty
        if (is_array($data['news_posts']) && !empty($data['news_posts'])) {
            // Pass the data to the view
            $this->call->view('admin/news', $data); // Corrected view call
        } else {
            // Handle the case where no news posts are found
            echo "Error: No valid news data found.";
        }
    }
    
    

    public function view_news($id) {
        $data['news_post'] = $this->minsu_model->get_news_by_id($id);
        $this->call->view('admin/view_news', $data);
    }

    public function postNews() {
        $this->call->view('admin/postNews'); // Render the Post News form
    }

    // Method to handle form submission from 'Post News'
    public function submitNews() {
        if ($this->form_validation->submitted()) {
            // Get form data
            $title = $this->io->post('title');
            $content = $this->io->post('content');
            $caption = $this->io->post('caption');
        
            // Handle image upload
            if ($_FILES['image']['error'] == 0) {
                // Define the directory inside the public folder
                $uploadDir = 'public/uploads/news_images/'; // Path where the image will be stored
        
                // Ensure the directory exists, if not, create it
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);  // Create the directory with proper permissions
                }
        
                // Get the file's name
                $fileName = basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;  // Complete path for the uploaded file
        
                // Security check: Only allow specific image file types (e.g., JPG, PNG)
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $_SESSION['error'] = 'Invalid image file type. Please upload JPG, PNG, or GIF images.';
                    return $this->call->view('admin/postNews');
                }
        
                // Optionally check for file size if needed (e.g., 5MB max)
                $maxSize = 5 * 1024 * 1024;  // 5MB
                if ($_FILES['image']['size'] > $maxSize) {
                    $_SESSION['error'] = 'File is too large. Max allowed size is 5MB.';
                    return $this->call->view('admin/postNews');
                }
        
                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    // Prepare news data for insertion
                    $newsData = [
                        'title' => $title,
                        'content' => $content,
                        'image' => 'uploads/news_images/' . $fileName,  // Store only the relative path for the image
                        'caption' => $caption,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
        
                    // Insert news data into the database
                    if ($this->minsu_model->insert_news($newsData)) {
                        $_SESSION['success'] = 'News post created successfully!';
                        header("Location: /admin/news");
                        exit();
                    } else {
                        $_SESSION['error'] = 'Failed to post news!';
                    }
                } else {
                    $_SESSION['error'] = 'Failed to upload image.';
                }
            } else {
                $_SESSION['error'] = 'No image selected or there was an error with the image upload.';
            }
        }
        
        // If validation fails or there was an error, show the form again
        return $this->call->view('admin/postNews');
    }
    
    public function time_ago($timestamp) {
        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_difference = $current_time - $time_ago;

        $seconds = $time_difference;
        $minutes      = round($seconds / 60);           // value 60 is seconds
        $hours        = round($seconds / 3600);         // value 3600 is 60 minutes * 60 sec
        $days         = round($seconds / 86400);        // value 86400 is 24 hours * 60 minutes * 60 sec
        $weeks        = round($seconds / 604800);       // value 604800 is 7 days * 24 hours * 60 minutes * 60 sec
        $months       = round($seconds / 2629440);      // value 2629440 is (365*24*60*60)/12
        $years        = round($seconds / 31553280);     // value 31553280 is (365*24*60*60)

        if ($seconds <= 60) {
            return "Now";
        } else if ($minutes <= 60) {
            return ($minutes == 1) ? "one minute ago" : "$minutes minutes ago";
        } else if ($hours <= 24) {
            return ($hours == 1) ? "an hour ago" : "$hours hours ago";
        } else if ($days <= 7) {
            return ($days == 1) ? "yesterday" : "$days days ago";
        } else if ($weeks <= 4.3) {
            return ($weeks == 1) ? "a week ago" : "$weeks weeks ago";
        } else if ($months <= 12) {
            return ($months == 1) ? "a month ago" : "$months months ago";
        } else {
            return ($years == 1) ? "one year ago" : "$years years ago";
        }
    }
    
    

}
?>
