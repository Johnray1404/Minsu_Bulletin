<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Minsu_model extends Model {

    //signup model
    public function signup($username, $password, $email) {
        if ($this->is_username_or_email_exists($username, $email)) {
            return false;
        }

        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );

        return $this->db->table('user')->insert($data);
    }


    //login model
    public function login($email, $password) {
        $user = $this->db->table('user')->where('email', $email)->get(); 
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;  
        }
    
        return false; 
    }
    
    private function is_username_or_email_exists($username, $email) {
        $userByUsername = $this->db->table('user')->where('username', $username)->get();
        if ($userByUsername) {
            return true; 
        }

        $userByEmail = $this->db->table('user')->where('email', $email)->get();
        if ($userByEmail) {
            return true;
        }

        return false; 
    }

    //news model
    public function get_all_news() {
        $this->call->database(); 
        $news = $this->db->table('news')->get_all(); 
        
        if ($news) {
            return $news; 
        } else {
            return false; 
        }
    }

    public function get_all_news_sorted() {
        $this->call->database(); 
        $news = $this->db->table('news')->order_by('created_at', 'DESC')->get_all(); 
    
        if ($news) {
            return $news; 
        } else {
            return false; 
        }
    }

    public function insert_news($newsData) {
        return $this->db->table('news')->insert($newsData);
    }

    public function get_user_by_id($userId) {
        return $this->db->table('user')->where('id', $userId)->get(); 
    }


    //profile pic model
    public function update_profile_pic($userId, $imagePath) {
        $data = [
            'profile_pic' => $imagePath
        ];
    
        $updated = $this->db->table('user')->where('id', $userId)->update($data);
    
        return $updated;
    }

    public function get_all_posts() {
        $posts = $this->db->table('posts')
                          ->join('user', 'posts.user_id = user.id')
                          ->select('posts.*, user.username, user.profile_pic')
                          ->order_by('posts.created_at', 'DESC')
                          ->get_all();
    
        if ($posts) {
            return $posts; 
        } else {
            return false; 
        }
    }
    
    public function get_posts_by_user($userId) {
        $posts = $this->db->table('posts')
                          ->join('user', 'posts.user_id = user.id')
                          ->select('posts.*, user.username, user.profile_pic')
                          ->where('user.id', $userId)
                          ->order_by('created_at', 'DESC')
                          ->get_all();  
    
        return $posts ? $posts : false; 
    }
    
    //delete post model
    public function deletePost($postId) {
        $post = $this->db->table('posts')->where('id', $postId)->get();
    
        if ($post && $post->count() > 0) {
            $deleted = $this->db->table('posts')->where('id', $postId)->delete();
    
            error_log("Delete operation status: " . ($deleted ? 'Success' : 'Failed'));
    
            return $deleted ? true : false;
        }
    
        error_log("Post with ID $postId does not exist.");
        return false;
    }

    public function insert_post($postData) {
        return $this->db->table('posts')->insert($postData);  
    }
}
?>
