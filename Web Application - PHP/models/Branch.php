<?php

class Branch extends CI_Model{
    
    public $wsurl;
    public $name;
    public $status;
    public $contactNo;
    
    public function __construct() {
        parent::__construct();
        $this->load->database('rxdb',true);
        $this->load->library('session');
    }
    
    public function addBranch(){        
         if (null != $this->session->userdata('is_logged')){
              $data = array( "name" => $this->name,
                                        "wsurl" => $this->wsurl,
                                        "status" => $this->status,
                                        "contactno" =>  $this->contactNo);
             $this->db->insert("branch", $data);
             return $this->db->insert_id();
         }else{
             return false;
         }
    }   
    
    public function getBranches($filter){
         $query = $this->db->query("SELECT *,  branch.id as branchid FROM `branch` left join branchlocation "
                 . "on branchlocation.branchid = branch.id ".$filter." ORDER BY branch.id DESC");
         return $query->result();         
    }
    
    public function constructFilter($data){
        $filter = "";
        foreach ($data as $key => $value){          
            if (!empty($value)){
                if (empty($filter)){
                    $filter = "WHERE ";
                }else{
                    $filter .= " AND ";
                }
                $filter .= $key.$value;
            }
        }
        return $filter;
    }
    
    public function deleteBranch($id){
        $this->db->where('branchid', $id);
        $this->db->delete('branchlocation'); 
        
        $this->db->where('id', $id);
        $this->db->delete('branch'); 
    }
    
    public function updatebranch($id){
         if (null != $this->session->userdata('is_logged')){
              $data = array( "name" => $this->name,
                                        "wsurl" => $this->wsurl,
                                        "status" => $this->status,
                                        "contactno" =>  $this->contactNo);
             $this->db->where('id', $id);
             return $this->db->update("branch", $data);
         }else{
             return false;
         }
    }
}
