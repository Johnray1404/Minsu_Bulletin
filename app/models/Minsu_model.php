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

    // Get the like count for a specific news post
    public function get_likes_count($news_id) {
        $this->call->database();
        $likes = $this->db->table('news_likes')->where('news_id', $news_id)->get_all();
        return count($likes);  // Return the total likes count
    }

    // Check if the user has liked a particular news post
    public function has_user_liked($news_id, $user_id) {
        $this->call->database();
        $like = $this->db->table('news_likes')
            ->where('news_id', $news_id)
            ->where('user_id', $user_id)
            ->get();
        return $like ? true : false;  // Return true if the user has liked the post
    }

    // Add a like to the news post
    public function add_like($news_id, $user_id) {
        $this->call->database();
        return $this->db->table('news_likes')->insert([
            'news_id' => $news_id,
            'user_id' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Remove a like from the news post
    public function remove_like($news_id, $user_id) {
        $this->call->database();
        return $this->db->table('news_likes')
            ->where('news_id', $news_id)
            ->where('user_id', $user_id)
            ->delete();
    }

    // Get all news posts sorted by creation date
    public function get_all_news_sorted() {
        $this->call->database();
        $news = $this->db->table('news')->order_by('created_at', 'DESC')->get_all();
        return $news ? $news : false;
    }

    public function insert_news($newsData) {
        return $this->db->table('news')->insert($newsData);
    }

    // In models/Minsu_model.php
    public function delete_news($news_id) {
        // Initialize the database connection
        $this->call->database();
    
        // Attempt to delete the news record from the 'news' table
        $this->db->table('news')->where('id', $news_id)->delete();
    
        // Check if the delete operation was successful
        if ($this->db->row_count() > 0) {
            return true; // Record was deleted
        } else {
            return false; // No record was deleted
        }
    }
    
    

    public function add_comment($news_id, $user_id, $comment) {
        $data = [
            'news_id' => $news_id,
            'user_id' => $user_id,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        // Use the Lavalust Query Builder to insert the data into the 'news_comment' table
        return $this->db->table('news_comment')->insert($data);
    }
    

    // Get all comments for a specific news post
    public function get_comments_by_news($news_id) {
        // Fetch comments along with the username and profile picture of the user
        return $this->db->table('news_comment c')
                        ->select('c.comment, u.username, u.profile_pic, c.created_at')
                        ->join('user u', 'c.user_id = u.id')
                        ->where('c.news_id', $news_id)
                        ->order_by('c.created_at', 'DESC')
                        ->get_all();
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

    // Get all comments for a specific post
    public function get_post_comments($post_id) {
        $result = $this->db->table('post_comment')
                           ->join('user', 'post_comment.user_id = user.id')
                           ->select('post_comment.*, user.username, user.profile_pic')
                           ->where('post_comment.post_id', $post_id)
                           ->order_by('post_comment.created_at', 'DESC')
                           ->get_all();
        return $result;
    }
    

// Add a comment to a post
public function add_post_comment($post_id, $user_id, $comment) {
    $data = [
        'post_id' => $post_id,
        'user_id' => $user_id,
        'comment' => $comment
    ];
    
    return $this->db->table('post_comment')->insert($data);
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

    // Get the like count for a specific post
public function get_post_likes_count($post_id) {
    $likes = $this->db->table('post_likes')->where('post_id', $post_id)->get_all();
    return count($likes);  // Return the total likes count
}

// Check if the user has liked a particular post
public function has_user_liked_post($post_id, $user_id) {
    $like = $this->db->table('post_likes')
        ->where('post_id', $post_id)
        ->where('user_id', $user_id)
        ->get();
    return $like ? true : false;  // Return true if the user has liked the post
}

// Add a like to a post
public function add_post_like($post_id, $user_id) {
    $this->call->database();
    return $this->db->table('post_likes')->insert([
        'post_id' => $post_id,
        'user_id' => $user_id,
        'created_at' => date('Y-m-d H:i:s')
    ]);
}

// Remove a like from a post
public function remove_post_like($post_id, $user_id) {
    $this->call->database();
    return $this->db->table('post_likes')
        ->where('post_id', $post_id)
        ->where('user_id', $user_id)
        ->delete();
}

public function get_all_users() {
    // Use the proper method to fetch all users
    $data = $this->db->table('user')->get_all();  // Get all users from the 'user' table
    
    // Return the fetched data
    return $data;
}

}
?>
