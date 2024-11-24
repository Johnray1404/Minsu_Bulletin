<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Minsu extends Controller {

    protected $data = [];

    public function __construct() {
        parent::__construct();
    
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();  // This ensures the session is started
        }

        // Load the model
        $this->call->model(array('minsu_model'));

        // Load user data if logged in
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $user = $this->minsu_model->get_user_by_id($userId);

            // Store user data in the controller's data property
            $this->data['user'] = $user;
        }
    }
    
    public function login() {
        // Start the session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $data = [];
    
        // Handle session success and error messages
        if (isset($_SESSION['success'])) {
            $data['success'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }
    
        if (isset($_SESSION['error'])) {
            $data['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }
    
        // Handle form submission
        if ($this->form_validation->submitted()) {
            $email = $this->io->post('email');
            $password = $this->io->post('password');
    
            // Basic admin check (can be removed later)
            if ($email === 'admin' && $password === 'admin') {
                $_SESSION['success'] = 'Login successful! Redirecting to the Admin Dashboard.';
                header("Location: /admin/dashboard");
                exit();
            }
    
            // Validate form inputs
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Email and password are required.';
            } else {
                // Check if the login credentials are valid
                $user = $this->minsu_model->login($email, $password);
                
                // Check if login is successful and return a valid user array
                if ($user !== false) {
                    $_SESSION['user_id'] = $user['id'];  // Store user ID in session
                    header("Location: /home");
                    exit();
                } else {
                    $_SESSION['error'] = 'Invalid email or password!';
                }
            }
        }
    
        // Load the login view
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
        $this->call->view('Minsu/homepage', $this->data);
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        session_destroy(); 
        header('Location: /');
        exit();
    }

    public function admin_dashboard() {
        $this->call->view('admin/dashboard');
    }

    public function contact() {
        $this->call->view('Minsu/contact',$this->data);
    }

    public function news() {
        $data['news_posts'] = $this->minsu_model->get_all_news();
        
        if (is_array($data['news_posts']) && !empty($data['news_posts'])) {
            $this->call->view('admin/news', $data);
        } else {
            echo "Error: No valid news data found.";
        }
    }

    public function view_news($id) {
        $data['news_post'] = $this->minsu_model->get_news_by_id($id);
        $this->call->view('admin/view_news', $data);
    }

    public function postNews() {
        $this->call->view('admin/postNews' );
    }
    public function submitNews() {
        if ($this->form_validation->submitted()) {
            $title = $this->io->post('title');
            $category = $this->io->post('category');
            $caption = $this->io->post('caption');
        
            if ($_FILES['image']['error'] == 0) {
                $uploadDir = 'public/uploads/news_images/';
        
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
        
                $fileName = basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;
        
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $_SESSION['error'] = 'Invalid image file type. Please upload JPG, PNG, or GIF images.';
                    return $this->call->view('admin/postNews');
                }
        
                $maxSize = 5 * 1024 * 1024;
                if ($_FILES['image']['size'] > $maxSize) {
                    $_SESSION['error'] = 'File is too large. Max allowed size is 5MB.';
                    return $this->call->view('admin/postNews');
                }
        
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $newsData = [
                        'title' => $title,
                        'category' => $category,
                        'image' => 'uploads/news_images/' . $fileName,
                        'caption' => $caption,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
        
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
        
        return $this->call->view('admin/postNews');
    }

    public function time_ago($timestamp) {
        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_difference = $current_time - $time_ago;

        $seconds = $time_difference;
        $minutes      = round($seconds / 60);
        $hours        = round($seconds / 3600);
        $days         = round($seconds / 86400);
        $weeks        = round($seconds / 604800);
        $months       = round($seconds / 2629440);
        $years        = round($seconds / 31553280);

        if ($seconds <= 60) {
            return "Just Now";
        } else if ($minutes <= 60) {
            return ($minutes == 1) ? "1 minute " : "$minutes minutes ";
        } else if ($hours <= 24) {
            return ($hours == 1) ? "1 hour " : "$hours hours";
        } else if ($days <= 7) {
            return ($days == 1) ? "yesterday" : "$days days";
        } else if ($weeks <= 4.3) {
            return ($weeks == 1) ? "a week ago" : "$weeks weeks ago";
        } else if ($months <= 12) {
            return ($months == 1) ? "a month ago" : "$months months ago";
        } else {
            return ($years == 1) ? "one year ago" : "$years years ago";
        }
    }

    public function userNews() {
        // Fetch news posts and time ago
        $data['news_posts'] = $this->minsu_model->get_all_news_sorted();
        $data['time_ago'] = array($this, 'time_ago');
    
        // Combine $this->data with $data
        $combinedData = array_merge($this->data, $data);
    
        // Pass the combined data to the view
        $this->call->view('minsu/userNews', $combinedData);
    }
    

    public function userProfile() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user_id'];
        $user = $this->minsu_model->get_user_by_id($userId);
        $data = [];
        if ($user) {
            $data['user'] = $user;  
            $posts = $this->minsu_model->get_posts_by_user($userId);
            if ($posts) {
                foreach ($posts as &$post) {
                    $post['time_ago'] = $this->time_ago($post['created_at']);
                }
            }
            $data['posts'] = $posts;
    
            // Handle profile pic upload via AJAX
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
                $uploadDir = 'public/uploads/profile_pic/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);  
                }
                $fileName = pathinfo($_FILES['profile_pic']['name'], PATHINFO_FILENAME);
                $fileExt = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
                $newFileName = uniqid('', true) . '.' . $fileExt;  
                $uploadFile = $uploadDir . $newFileName;
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
                if (!in_array($_FILES['profile_pic']['type'], $allowedTypes)) {
                    $_SESSION['error'] = 'Invalid image file type. Please upload JPG, PNG, or GIF images.';
                    echo json_encode(['success' => false, 'message' => 'Invalid image type']);
                    exit();
                }
    
                $maxSize = 5 * 1024 * 1024; 
                if ($_FILES['profile_pic']['size'] > $maxSize) {
                    echo json_encode(['success' => false, 'message' => 'File is too large. Max allowed size is 5MB.']);
                    exit();
                }
    
                if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
                    $imagePath = 'uploads/profile_pic/' . $newFileName;
                    if ($this->minsu_model->update_profile_pic($userId, $imagePath)) {
                        echo json_encode(['success' => true, 'message' => 'Profile picture updated successfully!']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error updating the profile picture.']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
                }
                exit();
            }
        } else {
            $data['error'] = 'User not found';  
        }
        return $this->call->view('minsu/userProfile', $data);
    }
    
    
    
    
    
    public function post_page() {
        // Load the Minsu_model to interact with the database
        $this->call->model('Minsu_model'); 
    
        // Fetch the posts using the get_all_posts method from Minsu_model
        $posts = $this->Minsu_model->get_all_posts();
    
        // Check if posts are fetched
        if ($posts) {
            // Passing the fetched posts data to the view
            $this->data['news_posts'] = $posts;
        } else {
            // If no posts are found, pass an empty array or error message
            $this->data['news_posts'] = [];
        }
        $this->data['time_ago'] = array($this, 'time_ago');
    
        // Call the view and load the data
        $this->call->view('minsu/post_page', $this->data);
    }
    
    

    
    public function getPost() {
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // Fetch user data
            $userId = $_SESSION['user_id'];
            $user = $this->minsu_model->get_user_by_id($userId);
    
            // Add user data to the page
            $this->data['user'] = $user;
    
            // Render the post creation page
            $this->call->view('minsu/post', $this->data);
        } else {
            // Redirect to login page if the user is not logged in
            $_SESSION['error'] = 'You must be logged in to create a post.';
            header("Location: /login");
            exit();
        }
    }

    public function addPost() {
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $user = $this->minsu_model->get_user_by_id($userId);
            $this->data['user'] = $user;

            // Handle form submission for adding a post
            if ($this->form_validation->submitted()) {
                $title = $this->io->post('post_title');
                $caption = $this->io->post('post_caption');
                $mediaFile = $_FILES['post_mediafile'];

                // Validate fields
                if (empty($title) || empty($caption)) {
                    $_SESSION['error'] = 'Title and caption are required.';
                } else {
                    // Upload media file
                    if ($mediaFile['error'] == 0) {
                        $uploadDir = 'public/uploads/posts/';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                        $fileName = basename($mediaFile['name']);
                        $uploadFile = $uploadDir . $fileName;

                        // Allow only specific file types
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!in_array($mediaFile['type'], $allowedTypes)) {
                            $_SESSION['error'] = 'Invalid media file type. Please upload JPG, PNG, or GIF images.';
                            return $this->call->view('minsu/getPost', $this->data);
                        }

                        // Max file size 5MB
                        $maxSize = 5 * 1024 * 1024;
                        if ($mediaFile['size'] > $maxSize) {
                            $_SESSION['error'] = 'File is too large. Max allowed size is 5MB.';
                            return $this->call->view('minsu/getPost', $this->data);
                        }

                        // Move the uploaded file
                        if (move_uploaded_file($mediaFile['tmp_name'], $uploadFile)) {
                            $postData = [
                                'user_id' => $userId,
                                'post_title' => $title,
                                'post_caption' => $caption,
                                'post_mediafile' => 'uploads/posts/' . $fileName,
                                'created_at' => date('Y-m-d H:i:s')
                            ];

                            // Insert the post into the database
                            if ($this->minsu_model->insert_post($postData)) {
                                $_SESSION['success'] = 'Post added successfully!';
                                header("Location: /post");
                                exit();
                            } else {
                                $_SESSION['error'] = 'Failed to add post!';
                            }
                        } else {
                            $_SESSION['error'] = 'Failed to upload media file.';
                        }
                    } else {
                        $_SESSION['error'] = 'No media file uploaded.';
                    }
                }
            }

            // Render the post creation page again
            $this->call->view('minsu/getPost', $this->data);
        } else {
            // Redirect to login page if the user is not logged in
            $_SESSION['error'] = 'You must be logged in to create a post.';
            header("Location: /login");
            exit();
        }
    }

    public function deletePost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get postId from the POST request
            $postId = $_POST['postId'] ?? null;

            if ($postId) {
                // Call the model to delete the post
                $isDeleted = $this->Minsu_model->deletePost($postId);

                // Return response
                if ($isDeleted) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false]);
            }
        }
    }
    

}
?>
