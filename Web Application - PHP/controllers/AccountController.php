<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountController extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User', 'user');
        $this->load->model('Location', 'location');
        $this->load->helper('url'); 
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
        $this->load->library("pagination");
    }
    
    public function index(){
        $this->load->view('Login');
    }
    
    public function showRegister(){
        $data = array ("message" =>  "");
        $this->load->view('UserRegistrationUI', $data);
    }
    
    public function onRegistration(){   
        $addedby = $this->input->post('addedby');
        $currpage = $this->input->post('currpage');
        $nextpage = $this->input->post('nextpage');
        $accessright = $addedby;
        if ($addedby == 'C'){
            $this->setRegistrationFormValidation();
        }else{
            $this->setAdminFormValidation();
            $accessright = $this->input->post('accessright');
        }
        if ($this->form_validation->run() == FALSE) {
            $data = array ("message" =>  validation_errors());
            if ($addedby == 'C'){
                $this->load->view($currpage, $data);
            }else{                
                 echo json_encode($data);    
            }
        }else{
            $this->user->username = $this->input->post('username');
            $this->user->emailadd =  $this->input->post('emailAdd');
            if ($this->user->checkAccount() == 0){         
                $this->user->group =  0;
                $this->user->accessright = $accessright;
                $this->user->password = $this->input->post('password');
                $this->user->firstname = $this->input->post('firstname');
                $this->user->lastname = $this->input->post('lastname');
                if($this->user->addUserAccount($accessright)){
                    if ($addedby == "C"){
                        $data = array ("message" => "You have successfully registered. You may now log-in.");
                        $this->load->view($nextpage, $data);
                    }else{
                        $data = array ("message" =>  "User successfully added.");
                        echo json_encode($data);    
                    }                        
                }                
            }else{
                $data = array ("message" => "Username and Email address not valid.");
               if ($addedby == "C"){                        
                        $this->load->view($currpage, $data);
                }else{
                    echo json_encode($data);    
                }      
            }
        }
    }
    
    public function onUpdateProfile(){
        $this->user->username = $this->session->userdata('login_user');
        $this->user->firstname = $this->input->post('firstname');
        $this->user->lastname = $this->input->post('lastname');
        $updated = $this->user->updateUserAccount();
        if ($updated){                        
            $data = $this->user->getUser();        
            $activeuser = $this->session->userdata['activeuser'];
            $activeuser['firstname'] = $data['firstname'];
            $activeuser['lastname'] = $data['lastname'];
            $this->session->set_userdata('activeuser', $activeuser);
        }
        $this->location->country =  $this->input->post('country');
        $this->location->regionloc =  $this->input->post('region');
        $this->location->provinceloc =  $this->input->post('province');
        $this->location->cityloc =  $this->input->post('city');
        $updated = $this->location->updateLocation($this->session->userdata('userid'));
        if ($updated){
            $locationarr =  $this->user->getUserLocation($this->session->userdata('userid')); 
            $this->session->set_userdata('userlocation', $locationarr);
            $rows = array('message' => 'Profile successfully updated.');
            echo json_encode($rows);    
        }else{
            $rows = array('message' => 'Profile not updated');
            echo json_encode($rows);    
        }       
    }
    
    public function validateCredentials(){
        $exists = false;
        $this->user->username = $this->input->post('username');
        $data = $this->user->getCredentials();
        if ($data->num_rows() > 0){
            foreach ($data->result() as $row)
            {
                if (strcmp(trim(MD5($this->input->post('password'))), trim($row->password)) == 0){
                    $exists = true;
                }
                break;
            }
        }
        
        if( $exists ){
            $this->showProfile();
        }else{
             $data = array ("message" => "Invalid credentials.");
             $this->load->view('Login', $data);
        }
    }
        
    public function showProfile($message = null){
        $username = "";
        $data_user = null;
        if (null != $this->session->userdata('is_logged')){
            $username =  $this->session->userdata('login_user');        
            $data_user =  $this->session->userdata('activeuser');
        }else{
            $this->user->username =  $this->input->post('username');     
            $data_user = $this->user->getUser();        
            $this->user->userid = $data_user['userid'];
            $data_location = $this->user->getUserLocation();
            $this->registerSession($data_user, $data_location);
            $this->user->updateUserDate('lastlogin');
        }
         $filename =  $data_user['profilepicfile'];
        if (empty($filename)){
           $filename = 'assets/images/blank-profile.png';
        }else{
            $filename = FCPATH."upload\\profilepictures\\".$data_user['profilepicfile'];
            if(file_exists($filename)){
                $filename = "upload/profilepictures/".$data_user['profilepicfile'];
            }else{
                $filename = 'assets/images/blank-profile.png';
            }
        }       
         $data_header = array("headimage" => "/".base_url()."assets/images/rxProfile.jpg",
                                                "username" => $this->session->userdata('login_user'),
                                                "profilepic" => $filename,
                                                "message" => $message);
         $this->load->view('header', $data_header);
         $this->load->view('ProfileUI');         
    }
    
    private function registerSession($data_user, $data_location){                
        if ($data_user!=null){
            $newdata = array('login_user' => $data_user['username'],
                                             'userid' => $data_user['userid'],
                                             'activeuser' => $data_user,
                                             'userlocation' => $data_location,
                                             'is_logged' => TRUE);
            $this->session->set_userdata($newdata);
        }
     }
     
     private function setRegistrationFormValidation(){
         $this->form_validation->set_rules('password', 'Password', 'required');
         $this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|matches[password]');
         $this->form_validation->set_rules('emailAdd', 'Email Address', 'required');
         $this->form_validation->set_rules('reemailAdd', 'Email Address', 'valid_email|matches[emailAdd]');
     }
        
     private function setAdminFormValidation(){
         $this->form_validation->set_rules('password', 'Password', 'required');
         $this->form_validation->set_rules('emailAdd', 'Email Address', 'required');
         $this->form_validation->set_rules('emailAdd', 'Email Address', 'valid_email');
     }
     
     private function setChangePassFormValidation(){
         $this->form_validation->set_rules('password', 'Password', 'required');
         $this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|matches[password]');
     }
    
    private function unregisterSession(){
       if(isset($_SESSION['login_user']))
           session_destroy ();
    }
    
    public function onLogout(){
        $this->unregisterSession();
        $this->load->view('Login');
    }
    
    public function onUploadPic(){
        $config['upload_path']      = FCPATH.'upload\profilepictures';
        $config['allowed_types']   = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']          = 1024;
        $config['max_height']         = 768;
        $config['overwrite']             = TRUE;
        $config['file_name']           = $this->session->userdata('login_user');
        $this->load->library('upload',$config);
        if ( ! $this->upload->do_upload('pic')){
                $error = array('message' => $this->upload->display_errors());
                $this->showProfile( $this->upload->display_errors());       
        }else{
                $data = array('upload_data' => $this->upload->data());
                $filename = $data['upload_data']['orig_name'];
                $data_user =  $this->session->userdata('activeuser');
                $data_user['profilepicfile'] = $filename;
                $this->session->set_userdata('activeuser', $data_user);
                $this->user->username =   $this->session->userdata('login_user');
                $this->user->profileImage = $filename;
                $this->user->updateProfilePic();
                $this->showProfile("Profile picture successfully uploaded.");       
        }
        
    }    
    
    public function onShowManageUser(){
        $data_header = array("headimage" =>  "/".base_url()."assets/images/manageUsers.jpg" ,
                                               "username" => $this->session->userdata('login_user'),
                                                "message" => "");
        $this->load->view('header', $data_header);
        $this->load->view('AdminUserUI');
    }
    
    private function toJson($data){
         $rows = array();
         foreach($data as $row) {
           $rows[] = $row;
         }
         echo json_encode((array)$rows);  
    }
    
    public function onSearchCustomers(){
        $pattern =  $this->input->get("username");
        $result = $this->user->searchCustomerByPattern($pattern);
        $this->toJson($result);
    }
    
    public function onFindCustomer(){
        $username =  $this->input->get("username");
        $this->user->username = $username;
        $result = $this->user->getUser();
        echo json_encode($result);         
    }
    
    public function onAdminUserUpdate(){
         $this->user->firstname = $this->input->post('firstname');
         $this->user->lastname = $this->input->post('lastname');
         $this->user->accessright =  $this->input->post('accessright');
         $this->user->username =  $this->input->post('username');
        if($this->user->updateUserDetails()){
             $rows = array('message' => 'User details successfully updated.');
        }else{
             $rows = array('message' => 'User details not updated.');
        }        
         echo json_encode($rows);    
    }
    
    public function onChangePassword(){
        $this->setChangePassFormValidation();
        $message ="";
        if ($this->form_validation->run() == FALSE) {        
            $message =   validation_errors();  
        }else{
            $this->user->password = $this->input->post('password');
            if($this->user->updatePassword()){
               $message = "Password successfully changed" ;
            }else{
                $message = "Error encountered when changing password. Please try again";
            }
        }
        $this->showProfile($message);     
    }
}

?>

