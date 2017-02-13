<?php

class Location extends CI_Model{
    public static $countries;
    public static $region;
    public static $province;
    public static $city;
    private static $locationretrieved;
    
    public $country;
    public $regionloc;
    public $provinceloc;
    public $cityloc;
    
    public function __construct() {
        parent::__construct();
        $this->load->database('rxdb',true);
        $this->load->library('session');
        $this->getAllLocations();
    }
    
    public function updateLocation($userid){
         if (null != $this->session->userdata('is_logged')){
            $data = array(
               'userid' => $userid,
               'country' => $this->country,
               'region' => $this->regionloc,
               'province' => $this->provinceloc,
               'city' => $this->cityloc);
            if ($this->session->userdata('userlocation') == null){
                $this->db->insert('location', $data);
            }else{
                $this->db->where('userid', $userid);
                $this->db->update('location', $data);     
            }
            return ( $this->db->affected_rows() > 0? true: false);
         }else{
             return false;
         }
    }
    
    public function addBranchLocation($branchid){
         if (null != $this->session->userdata('is_logged')){
            $data = array(
               'branchid' => $branchid,
               'country' => $this->country,
               'region' => $this->regionloc,
               'province' => $this->provinceloc,
               'city' => $this->cityloc);
            $this->db->insert('branchlocation', $data);
            return ( $this->db->affected_rows() > 0? TRUE: FALSE);
         }else{
             return FALSE;
         }
    }
    
    public function updateBranchLocation($branchid){
         if (null != $this->session->userdata('is_logged')){
            $data = array(
               'country' => $this->country,
               'region' => $this->regionloc,
               'province' => $this->provinceloc,
               'city' => $this->cityloc);
            $this->db->where('branchid', $branchid);
            $this->db->update('branchlocation', $data);
            return ( $this->db->affected_rows() > 0? TRUE: FALSE);
         }else{
             return FALSE;
         }
    }
    
    public function getProvince($region){
         $this->db->where('regionid', $region);
         $this->db->order_by("regionid", "asc");
         $this->db->order_by("id", "asc");
         return $this->db->get('province')->result();         
    }
    
    
    public function getCity($province){  
         $this->db->where('provinceid', $province);
         $this->db->order_by("regionid", "asc");
         $this->db->order_by("provinceid", "asc");
         $this->db->order_by("name", "asc");
         print_r( $this->db->get('city')->result());
    }
    
    private function getAllLocations(){
        if (!self::$locationretrieved){
            $this->getAllCountry();
            $this->getAllRegion();
            $this->getAllProvince();
            $this->getAllCity();
            $locationretrieved = TRUE;
        }
    }
    
    private function getAllCountry(){
          if (empty(self::$countries)) {
             self::$countries = $this->db->get('country')->result();
          }
          return self::$countries;
    }
    
    private function getAllRegion(){
         if (empty(self::$region)){
             $this->db->order_by("countryid", "asc");
             $this->db->order_by("id", "asc");
             self::$region = $this->db->get('region')->result();
          }
          return self::$region;
    }
    
    private function getAllProvince(){
         if (empty(self::$province)){
             $this->db->order_by("regionid", "asc");
             $this->db->order_by("id", "asc");
             self::$province = $this->db->get('province')->result();
          }
          return self::$province;
    }
    
    private function getAllCity(){
         if (empty(self::$city)){
             $this->db->order_by("regionid", "asc");
             $this->db->order_by("provinceid", "asc");
             $this->db->order_by("name", "asc");
             self::$city = $this->db->get('city')->result();
          }
          return self::$city;
    }
    
    public static function getCityName($key){
        $name=null;
        foreach(self::$city as $city ){
            if ($city->id == $key){
                $name = $city->name;
                break;
            }
        }
        return $name;
    }
    
     public static function getProvinceName($key){
         $name=null;
        foreach(self::$province as $prov ){
            if ($prov->id == $key){
                $name = $prov->name;
                break;
            }
        }
        return $name;
    }
}

?>

