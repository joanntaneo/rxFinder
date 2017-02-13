<?php

class User extends CI_Model{
    
    public $username;
    public $password;
    public $accessright;
    public $group;
    public $emailadd;
    public $firstname;
    public $lastname;
    public $userid;
    public $profileImage;
    
    public function __construct() {
        parent::__construct();
        $this->load->database('rxdb',true);
        $this->load->library('session');
    }
       
    public function addUserAccount($accessright){
             $data = array( "username" => $this->username,
                                        "password" => MD5($this->password),
                                        "group" => $this->group,
                                        "accessright" => $this->accessright,
                                        "emailadd" => $this->emailadd,
                                        "firstname" => $this->firstname,
                                        "lastname" => $this->lastname);
            $result = $this->db->insert('users', $data);
            return $result;
    }
    
    public function updateUserAccount(){
         if (null != $this->session->userdata('is_logged')){
            $data = array( 
                       "firstname" => $this->firstname,
                       "lastname" => $this->lastname);
            $this->db->where('id', $this->session->userdata('userid'));
            $result = $this->db->update('users', $data);          
            return ( $this->db->affected_rows() > 0? true: false);
         }else{
             return false;
         }
    }  
    
    public function updatePassword(){
         if (null != $this->session->userdata('is_logged')){
             $data = array( "password" => MD5($this->password));
             $this->db->where('id', $this->session->userdata('userid'));
             $result = $this->db->update('users', $data);          
             return ( $this->db->affected_rows() > 0? true: false);
         }else{
             return false;
         }
    }
      
        
    public function checkAccount(){
        $result = 0;
        if ($this->db != null){
            $result = $this->db->query("SELECT * FROM users WHERE username='".
                    $this->username."' OR emailadd='".$this->emailadd."'");
           $result = $result->num_rows();
        }        
        return $result;
    }
    
    public function getCredentials(){
        $this->db->select("password");
        $this->db->where('username', $this->username);
        $query = $this->db->get("users");
        return $query;
    }
    
    public function getUser(){
        $this->db->select("*");
        $this->db->where('username', $this->username);
        $query = $this->db->get("users");
        $data = null;
        foreach ($query->result() as $row)
        {
           $data = array(
               "userid"  => $row->id,
               "username" => $row->username,
               "password" => $row->password,
               "emailadd" => $row->emailadd,
               "lastname" => $row->lastname,
               "firstname" => $row->firstname,
               "group" => $row->group,
               "accessright" => $row->accessright,
               "profilepicfile" => $row->profilepicfile
           );
        }
        return $data;
    }
    
    public function getUserLocation(){
        
        $this->db->select("*");
        $this->db->where('userid', $this->userid);
        $query = $this->db->get("location");
        $data = null;
        foreach ($query->result() as $row)
        {
           $data = array(
               "userid"  => $row->userid,
               "country" => $row->country,
               "region" => $row->region,
               "province" => $row->province,
               "city" => $row->city,
           );
        }
        return $data;
    }
    
    public function updateProfilePic(){
        if (null != $this->session->userdata('is_logged')){
            $data = array(  "profilepicfile" => $this->profileImage);
            $this->db->where('username', $this->username);
            $result = $this->db->update('users', $data);
            if ($result){
                $this->updateUserDate('lastupdate');
            }
            return true;
         }else{
             return false;
         }
    }
    
    public function updateUserDate($field){
        if (null != $this->session->userdata('is_logged')){            
           $result = $this->db->query("UPDATE userlogs SET ".$field." = NOW() WHERE username='".$this->username."'");   
            return true;
         }else{
             return false;
         }
    }
    
    public function searchCustomerByPattern($pattern){
        if (null != $this->session->userdata('is_logged')){           
             $query = $this->db->query("SELECT * FROM users LEFT JOIN userlogs ON users.username "
                                                             . "= userlogs.username WHERE users.username LIKE '".$pattern."%'");
             return $query->result();
        }
    }
    
    // Update user by Admin
    public function updateUserDetails(){
        $data = array( 
                       "firstname" => $this->firstname,
                       "lastname" => $this->lastname,
                        "accessright" =>  $this->accessright);
        $this->db->where('username',  $this->username);
        $result = $this->db->update('users', $data);          
        return ( $this->db->affected_rows() > 0? true: false);
    }     
    
}

?>
