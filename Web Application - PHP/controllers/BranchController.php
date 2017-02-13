<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BranchController extends CI_Controller{
    public function __construct() {
            parent::__construct();
            $this->load->helper('url');         
            $this->load->library('session');
            $this->load->model('Location', 'location');
             $this->load->model('Branch', 'branch');
    }
    
    public function onShowManageBranch(){
         $data_header = array("headimage" =>  "/".base_url()."assets/images/manageBranch.jpg",
                                                "username" => $this->session->userdata('login_user'));
         $this->load->view('header', $data_header);
         $this->load->view('BranchConfigurationUI');
    }
    
    public function addBranch(){
        if (null != $this->session->userdata('is_logged')){
            $this->branch->name = $this->input->post('branchname');
            $this->branch->wsurl =$this->input->post('url');
            $this->branch->status = ($this->input->post('status') == "true" ? 'Y' : 'N');
            $this->branch->contactno =  $this->input->post('contactno');
           $id = $this->branch->addBranch();
           if ($id > 0){
                $this->location->country =  $this->input->post('country');
                $this->location->regionloc =  $this->input->post('region');
                $this->location->provinceloc =  $this->input->post('province');
                $this->location->cityloc =  $this->input->post('city');
                $result = $this->location->addBranchLocation($id);               
                $data = $this->branch->getBranches("");
                $rows = array();
                $count = 0;
                foreach($data as $row) {
                     $row->city = Location::getCityName($row->city);
                     $row->province = Location::getProvinceName($row->province);
                     $rows[] = $row;
                 }
                 echo json_encode($rows);       
            }
         }
     }
    
     public function getBranched(){
          if (null != $this->session->userdata('is_logged')){
           if ($id > 0){
                $data = $this->branch->getBranches("");
                $rows = array();
                foreach($data as $row) {
                   $rows[] = $row;
                 }
                 echo json_encode($rows);       
            }
         }
     }
     
     public function onGetBranch(){
          if (null != $this->session->userdata('is_logged')){
            $id = "= ".$this->input->post("id");
            $filter = $this->branch->constructFilter(array(  "branch.id" => $id));
            $data = $this->branch->getBranches($filter);            
            $rows = array();
            foreach($data as $row) {
               $rows[] = $row;
             }
             echo json_encode($rows);                   
         }
     }
     
     public function deleteBranch(){
          if (null != $this->session->userdata('is_logged')){
            $id = $this->input->post("id");
            $this->branch->deleteBranch($id);                      
            $data = $this->branch->getBranches("");
            $rows = array();
            foreach($data as $row) {
               $rows[] = $row;
             }
             echo json_encode($rows);       
         }
     }
     
     public function updateBranch(){
          if (null != $this->session->userdata('is_logged')){
           $id = $this->input->post("id");
           $this->branch->name = $this->input->post('branchname');
           $this->branch->wsurl =$this->input->post('url');
           $this->branch->status = ($this->input->post('status') == "true" ? 'Y' : 'N');
           $this->branch->contactNo =  $this->input->post('contactno');
           $this->branch->updateBranch($id);
           $this->location->country =  $this->input->post('country');
           $this->location->regionloc =  $this->input->post('region');
           $this->location->provinceloc =  $this->input->post('province');
           $this->location->cityloc =  $this->input->post('city');
           $this->location->updateBranchLocation($id);               
           $data = $this->branch->getBranches("");    
           $rows = array();
           $count = 0;
         foreach($data as $row) {
              $row->city = Location::getCityName($row->city);
              $row->province = Location::getProvinceName($row->province);
              $rows[] = $row;
           }
           echo json_encode($rows);       
         }
     }
}
