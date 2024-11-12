<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Minsu_model extends Model {

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

    public function login($email, $password) {
        $user = $this->db->table('user')->where('email', $email)->get(); 
    
        if ($user && password_verify($password, $user['password'])) {
            return true;
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

    public function get_all_news() {
        // Ensure you are connected to the database
        $this->call->database(); // Manually connect to the database if it's not auto-connected
        
        // Query to fetch all news posts
        $news = $this->db->table('news')->get_all();  // get_all() returns all records from the table
        
        if ($news) {
            return $news;  // Return the result as an array of news posts
        } else {
            return false;  // Handle if no results are found
        }
    }
    
    
    

    // Method to get a single news post by ID
    public function get_news_by_id($id) {
        // Retrieve a single news post by its ID
        return $this->db->table('news')->where('id', $id)->get();
    }

    public function insert_news($newsData) {
        // Using the query builder to insert data into the 'news' table
        return $this->db->table('news')->insert($newsData);
    }
    

    
}
?>
