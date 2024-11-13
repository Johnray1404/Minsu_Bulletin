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
}
?>
