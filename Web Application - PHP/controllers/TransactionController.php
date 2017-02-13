<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TransactionController extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');         
        $this->load->library('session');        
        $this->load->model('Location','location');
        $this->load->model("Branch","branch");
    }
    
    public function index(){
        $this->load->view('FindProductUI');
    }
    
    public function onSearchBranch(){
         $data_header = array("headimage" =>  "/".base_url()."assets/images/locatePharmacy.jpg",
                                               "username" => $this->session->userdata('login_user'));
         $this->load->view('header', $data_header);
         $this->load->view('FindBranchUI');
    }
    
    public function onProductSearch(){
         $data_header = array("headimage" => "/".base_url()."assets/images/searchProduct.jpg" ,
                                                "username" => $this->session->userdata('login_user'));
         $this->load->view('header', $data_header);
         $this->load->view('FindProductUI');
    }
    
    public function findBranch(){
        $data = $this->getBranches();
        $count = 0;
         foreach($data as $row) {
              $row->city = Location::getCityName($row->city);
              $row->province = Location::getProvinceName($row->province);
              $data[$count] = $row;
              $count++;
         }
        $this->toJson($data);            
    }
    
    public function findProduct(){
        $branches = $this->getBranches();
        
        $rows = array();
         foreach($branches as $branch) {
             if(!empty($branch->wsurl) && $branch->status === 'Y'){
                // echo $branch->name." ".$branch->wsurl;
                $products = $this->getProduct($branch);
                if($products != null && !empty($products)){
                    $count = 0;
                    foreach ($products as $prod){
                        $prod->branchname = $branch->name;
                        $address = $branch->name.", ".$this->location->getCityName($branch->city).",  ".
                                $this->location->getProvinceName($branch->province);
                        $prod->address = $address;
                        $products[$count] = $prod;                        
                        $count++;
                    }
                    $rows = array_merge($rows, $products);
                }
             }
         }
          $this->toJson($rows);
    }
    
    private function getProduct($branch){
         @set_time_limit(-1);
         $generic = $this->input->post("generic") <> null ?  $this->input->post("generic") : "*";
         $brand = $this->input->post("brand") <> null ?  $this->input->post("brand") : "*";
         $unit = $this->input->post("unit") <> null ?  $this->input->post("unit") : "*";
         $vol = $this->input->post("volume") <> null ?  $this->input->post("volume") : "0";
         $rows = array(); 
         ini_set('soap.wsdl_cache_enabled', 0);
         $options = array('features' =>  SOAP_USE_XSI_ARRAY_TYPE + SOAP_SINGLE_ELEMENT_ARRAYS,
                                         'exceptions'=>1, 'trace' =>0 );
         try{
            $client = new SoapClient($branch->wsurl, $options);         
            $response = null;
            if ($client){
            $response = $client->getProductAvailability(array('username'=>'wsuser',
                                               'password' => 'WsUser123',
                                               'genericName'=> $generic,
                                               'brandName'=> $brand,
                                               'unit'=> $unit,
                                               'volume'=> $vol ));
            }
                   
            if ($response != null && is_object($response) && (count(get_object_vars($response)) > 0)){
               foreach($response->return as $row){
                   $rows[] = $row;
               }
            }
         }catch(SoapFault  $e){
             return;
         }
         return $rows;
    }
    
    private function toJson($data){
         $rows = array();
         foreach($data as $row) {
           $rows[] = $row;
         }
         echo json_encode((array)$rows);  
    }
    
    private function getBranches(){
        $country = "= '".$this->input->post("country")."'";
        $region = $this->input->post("region") == 0? "" : " = ".$this->input->post("region");
        $province = $this->input->post("province") == 0? "": " = ".$this->input->post("province");
        $city = $this->input->post("city") == 0? "": " = ".$this->input->post("city");
        $filter = $this->branch->constructFilter(array(  "country" => $country, 
                                                                                           "region" => $region, 
                                                                                           "province" => $province, 
                                                                                           "city" => $city
                                                                                ));
        $data = $this->branch->getBranches($filter);
        return $data;
    }
    
    
    
}

?>

