<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Minsu extends Controller {

    protected $data = [];

    public function __construct() {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->call->model(array('minsu_model'));
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $user = $this->minsu_model->get_user_by_id($userId);
            $this->data['user'] = $user;
        }
    }
    
    //login 
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
                $user = $this->minsu_model->login($email, $password);
                if ($user !== false) {
                    $_SESSION['user_id'] = $user['id'];
                    header("Location: /home");
                    exit();
                } else {
                    $_SESSION['error'] = 'Invalid email or password!';
                }
            }
        }
        $this->call->view('minsu/login', $data);
    }

    //sign up
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
    
    //View User Homepage
    public function home() {
        $this->call->view('Minsu/homepage', $this->data);
    }

    //Logout function
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: /');
        exit();
    }


    //View Admin Dashboard
    public function admin_dashboard() {
        $this->call->view('admin/dashboard');
    }

    //Contact page
    public function contact() {
        $this->call->view('Minsu/contact', $this->data);
    }

    //admin news page
    public function news() {
        // Fetch all news posts from the model
        $data['news_posts'] = $this->minsu_model->get_all_news_sorted();
    
        // If news posts are available, process them to include like counts and comments
        if (is_array($data['news_posts']) && !empty($data['news_posts'])) {
            foreach ($data['news_posts'] as &$post) {
                // Add the like count for each news post
                $post['like_count'] = $this->minsu_model->get_likes_count($post['id']);
                
                // Fetch comments for each post (admin will only see them)
                $post['comments'] = $this->minsu_model->get_comments_by_news($post['id']);
            }
    
            // Merge additional data (like time_ago function) if needed
            $data['time_ago'] = array($this, 'time_ago');
    
            // Call the view to display the news posts along with the comments
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

    //admin Post News
    public function submitNews() {
        if ($this->form_validation->submitted()) {
            $title = $this->io->post('title');
            $category = $this->io->post('category');
            $caption = $this->io->post('caption');
    
            // Image upload logic
            $imageFile = null;
            if ($_FILES['image']['error'] == 0) {
                $uploadDir = 'public/uploads/news_images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); // Create the folder if it doesn't exist
                }
                $imageName = basename($_FILES['image']['name']);
                $uploadImageFile = $uploadDir . $imageName;
                $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['image']['type'], $allowedImageTypes)) {
                    $_SESSION['error'] = 'Invalid image file type. Please upload JPG, PNG, or GIF images.';
                    return $this->call->view('admin/postNews');
                }
                $maxImageSize = 5 * 1024 * 1024;
                if ($_FILES['image']['size'] > $maxImageSize) {
                    $_SESSION['error'] = 'Image file is too large. Max allowed size is 5MB.';
                    return $this->call->view('admin/postNews');
                }
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadImageFile)) {
                    $imageFile = 'uploads/news_images/' . $imageName;
                } else {
                    $_SESSION['error'] = 'Failed to upload image.';
                    return $this->call->view('admin/postNews');
                }
            }
    
            // Video upload logic
            $videoFile = null;
            if ($_FILES['video']['error'] == 0) {
                $uploadDir = 'public/uploads/news_videos/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); // Ensure the folder exists
                }
    
                $videoName = basename($_FILES['video']['name']);
                $uploadVideoFile = $uploadDir . $videoName;
    
                // Check if the video file type is allowed
                $allowedVideoTypes = ['video/mp4', 'video/avi', 'video/mkv'];
                if (!in_array($_FILES['video']['type'], $allowedVideoTypes)) {
                    $_SESSION['error'] = 'Invalid video file type. Please upload MP4, AVI, or MKV videos.';
                    return $this->call->view('admin/postNews');
                }
    
                // Maximum video file size (20MB)
                $maxVideoSize = 20 * 1024 * 1024;
                if ($_FILES['video']['size'] > $maxVideoSize) {
                    $_SESSION['error'] = 'Video file is too large. Max allowed size is 20MB.';
                    return $this->call->view('admin/postNews');
                }
    
                // Move the video to the uploads directory
                if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadVideoFile)) {
                    $videoFile = 'uploads/news_videos/' . $videoName;  // Save the relative path
                } else {
                    $_SESSION['error'] = 'Failed to upload video.';
                    return $this->call->view('admin/postNews');
                }
            }
    
            // Prepare the data to be inserted into the database
            $newsData = [
                'title' => $title,
                'category' => $category,
                'caption' => $caption,
                'created_at' => date('Y-m-d H:i:s'),
            ];
    
            // Add the image or video path to the news data if available
            if ($imageFile) {
                $newsData['image'] = $imageFile;
            }
            if ($videoFile) {
                $newsData['video'] = $videoFile;
            }
    
            // Insert the news data into the database
            if ($this->minsu_model->insert_news($newsData)) {
                $_SESSION['success'] = 'News post created successfully!';
                header("Location: /admin/news");
                exit();
            } else {
                $_SESSION['error'] = 'Failed to post news!';
            }
        }
    
        return $this->call->view('admin/postNews');
    }
    
    
    //Helper: Time ago
    public function time_ago($timestamp) {
        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;
        $minutes = round($seconds / 60);
        $hours = round($seconds / 3600);
        $days = round($seconds / 86400);
        $weeks = round($seconds / 604800);
        $months = round($seconds / 2629440);
        $years = round($seconds / 31553280);

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

    // Display user news feed with like count
    public function userNews() {
        // Fetch all news posts from the model
        $data['news_posts'] = $this->minsu_model->get_all_news_sorted();
        
        // For each news post, add the like count and check if the current user has liked the post
        foreach ($data['news_posts'] as &$post) {
            // Fetch the like count and whether the user has liked the post
            $post['like_count'] = $this->minsu_model->get_likes_count($post['id']);
            $post['user_liked'] = $this->minsu_model->has_user_liked($post['id'], $_SESSION['user_id']); 
            
            // Fetch the comments for each post and add them to the post data
            $post['comments'] = $this->minsu_model->get_comments_by_news($post['id']);
        }
    
        // Passing the time_ago function for formatting timestamps
        $data['time_ago'] = array($this, 'time_ago');
    
        // Merge the data with any other data you have
        $combinedData = array_merge($this->data, $data);
    
        // Load the view with the combined data
        $this->call->view('minsu/userNews', $combinedData);
    }
    

    public function toggle_like() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_log("POST data: " . print_r($_POST, true));
            $news_id = $_POST['news_id'];
            $user_id = $_POST['user_id']; 
    
            // Check if the user has already liked this post
            $has_liked = $this->minsu_model->has_user_liked($news_id, $user_id);
            if ($has_liked) {
                $this->minsu_model->remove_like($news_id, $user_id);
                $action = 'removed';
            } else {
                $this->minsu_model->add_like($news_id, $user_id);
                $action = 'added';
            }
    
            $like_count = $this->minsu_model->get_likes_count($news_id);
    
            // Return a success response
            echo json_encode([
                'status' => 'success',
                'action' => $action,
                'like_count' => $like_count
            ]);
        } else {
            // Invalid request
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid request method'
            ]);
        }
    }

    // Minsu.php

public function add_comment() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $news_id = $_POST['news_id'];
        $user_id = $_SESSION['user_id'];  // Assuming user_id is stored in the session
        $comment = $_POST['comment'];

        // Add the comment to the database
        $this->minsu_model->add_comment($news_id, $user_id, $comment);

        // Redirect back to the news page
        header('Location: /userNews');
    }
}


    //User Profile
    public function userProfile() {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Get logged-in user ID
        $userId = $_SESSION['user_id'];
    
        // Fetch user details
        $user = $this->minsu_model->get_user_by_id($userId);
        $data = [];
    
        if ($user) {
            // Add user data to the view
            $data['user'] = $user;
    
            // Fetch posts for the logged-in user
            $posts = $this->minsu_model->get_posts_by_user($userId);
            
            if ($posts) {
                // Add 'time_ago' field for each post
                foreach ($posts as &$post) {
                    $post['time_ago'] = $this->time_ago($post['created_at']);
                    
                    // Add like count and check if the user has already liked the post
                    $post['like_count'] = $this->minsu_model->get_post_likes_count($post['id']);
                    $post['user_liked'] = $this->minsu_model->has_user_liked_post($post['id'], $userId);
                }
            }
    
            // Add posts to data to be passed to the view
            $data['posts'] = $posts;
    
            // Handle profile picture upload
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
                $uploadDir = 'public/uploads/profile_pic/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
    
                // Process image upload
                $fileName = pathinfo($_FILES['profile_pic']['name'], PATHINFO_FILENAME);
                $fileExt = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
                $newFileName = uniqid('', true) . '.' . $fileExt;
                $uploadFile = $uploadDir . $newFileName;
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
                // Validate file type
                if (!in_array($_FILES['profile_pic']['type'], $allowedTypes)) {
                    $_SESSION['error'] = 'Invalid image file type. Please upload JPG, PNG, or GIF images.';
                    echo json_encode(['success' => false, 'message' => 'Invalid image type']);
                    exit();
                }
    
                // Validate file size
                $maxSize = 5 * 1024 * 1024;
                if ($_FILES['profile_pic']['size'] > $maxSize) {
                    echo json_encode(['success' => false, 'message' => 'File is too large. Max allowed size is 5MB.']);
                    exit();
                }
    
                // Move the uploaded file to the server
                if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
                    $imagePath = 'uploads/profile_pic/' . $newFileName;
    
                    // Update the profile picture in the database
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
    
        // Return the user profile view with the user data and posts
        return $this->call->view('minsu/userProfile', $data);
    }
    

    //User Post Page
    public function post_page() {
        $this->call->model('Minsu_model');
        $posts = $this->Minsu_model->get_all_posts();
    
        // Add the like count and check if the user liked each post
        foreach ($posts as &$post) {
            $post['like_count'] = $this->Minsu_model->get_post_likes_count($post['id']);
            $post['user_liked'] = $this->Minsu_model->has_user_liked_post($post['id'], $_SESSION['user_id']);
        }
    
        if ($posts) {
            $this->data['news_posts'] = $posts;
        } else {
            $this->data['news_posts'] = [];
        }
        $this->data['time_ago'] = array($this, 'time_ago');
        $this->call->view('minsu/post_page', $this->data);
    }
    
    // Method to handle the toggling of post like (like/unlike)
    public function toggle_post_like() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post_id = $_POST['post_id'];
            $user_id = $_POST['user_id'];
    
            // Check if the user has already liked the post
            $has_liked = $this->minsu_model->has_user_liked_post($post_id, $user_id);
    
            if ($has_liked) {
                // Remove the like
                $this->minsu_model->remove_post_like($post_id, $user_id);
                $action = 'removed';
            } else {
                // Add the like
                $this->minsu_model->add_post_like($post_id, $user_id);
                $action = 'added';
            }
    
            // Get updated like count
            $like_count = $this->minsu_model->get_post_likes_count($post_id);
    
            // Respond with the updated status and like count
            echo json_encode([
                'status' => 'success',
                'action' => $action,
                'like_count' => $like_count
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid request method'
            ]);
        }
    }
    

    //View User Post 
    public function getPost() {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $user = $this->minsu_model->get_user_by_id($userId);
            $this->data['user'] = $user;
            $this->call->view('minsu/post', $this->data);
        } else {
            $_SESSION['error'] = 'You must be logged in to create a post.';
            header("Location: /login");
            exit();
        }
    }

    //User Add post
    public function addPost() {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $user = $this->minsu_model->get_user_by_id($userId);
            $this->data['user'] = $user;
            if ($this->form_validation->submitted()) {
                $title = $this->io->post('post_title');
                $caption = $this->io->post('post_caption');
                $mediaFile = $_FILES['post_mediafile'];
                if (empty($title) || empty($caption)) {
                    $_SESSION['error'] = 'Title and caption are required.';
                } else {
                    if ($mediaFile['error'] == 0) {
                        $uploadDir = 'public/uploads/posts/';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                        $fileName = basename($mediaFile['name']);
                        $uploadFile = $uploadDir . $fileName;
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!in_array($mediaFile['type'], $allowedTypes)) {
                            $_SESSION['error'] = 'Invalid media file type. Please upload JPG, PNG, or GIF images.';
                            return $this->call->view('minsu/getPost', $this->data);
                        }
                        $maxSize = 5 * 1024 * 1024;
                        if ($mediaFile['size'] > $maxSize) {
                            $_SESSION['error'] = 'File is too large. Max allowed size is 5MB.';
                            return $this->call->view('minsu/getPost', $this->data);
                        }
                        if (move_uploaded_file($mediaFile['tmp_name'], $uploadFile)) {
                            $postData = [
                                'user_id' => $userId,
                                'post_title' => $title,
                                'post_caption' => $caption,
                                'post_mediafile' => 'uploads/posts/' . $fileName,
                                'created_at' => date('Y-m-d H:i:s')
                            ];
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
            $this->call->view('minsu/getPost', $this->data);
        } else {
            $_SESSION['error'] = 'You must be logged in to create a post.';
            header("Location: /login");
            exit();
        }
    }

    // Gallery Page
public function gallery() {
    // This could fetch the gallery images or any data related to the gallery from the database.
    // For now, I'll assume you have the gallery images stored in the 'public/images' folder.
    
    // Example of image data (replace with actual database queries or static data if necessary)
    $this->data['gallery_images'] = [
        ['title' => 'Image 1', 'image_path' => 'images/msu1.jpg'],
        ['title' => 'Image 2', 'image_path' => 'images/msu2.jpg'],
        ['title' => 'Image 3', 'image_path' => 'images/msu3.jpg'],
        ['title' => 'Image 4', 'image_path' => 'images/msu4.jpg']
    ];
    
    // Load the gallery view and pass the gallery data
    $this->call->view('Minsu/gallery', $this->data);
}

public function accounts() {
    // Fetch all user accounts from the model
    $data['users'] = $this->minsu_model->get_all_users();
    
    // Call the view to display the user accounts
    $this->call->view('admin/accounts', $data);
}


}
?>
