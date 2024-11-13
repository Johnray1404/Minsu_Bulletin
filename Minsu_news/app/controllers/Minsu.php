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
        $this->call->view('Minsu/homepage');
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
        $this->call->view('Minsu/contact');
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
        $this->call->view('admin/postNews');
    }

    public function submitNews() {
        if ($this->form_validation->submitted()) {
            $title = $this->io->post('title');
            $content = $this->io->post('content');
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
                        'content' => $content,
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
            return "Now";
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
        $data['news_posts'] = $this->minsu_model->get_all_news_sorted();
        $data['time_ago'] = array($this, 'time_ago');
        $this->call->view('minsu/userNews', $data);
    }

}
?>
