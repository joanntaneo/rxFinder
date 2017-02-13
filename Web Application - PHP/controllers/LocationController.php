<?php

class LocationController extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('rxHelperFunctions');
         $this->load->model('Location', 'location');
    }
    
    public function onRegionChange(){
        if ($this->input->get('region') != NULL){           
            $data =  $this->location->getProvince($this->input->get('region'));
            echo province_dropdown( '', $this->input->get('region'), $data);
        }else{
            echo  "<option value=''>---Select Province---</option>";
        }
    }
    
    public function onProvinceChange(){
        if ($this->input->get('province') != NULL){
            $data = $this->location->getCity($this->input->get('province'));   
            echo city_dropdown('',  
                                                 array( "region" => $this->input->get('region'),
                                                            "province" => $this->input->get('province')),
                                                $data);
        }else{
            echo  "<option value=''>---Select City---</option>";
        }
    }
}

?>