
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1.0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>rxFinder</title>

    <!-- Bootstrap core CSS -->
     <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/mycss.css" rel="stylesheet">
  </head>
  
  <?php 
        $this->load->helper('url'); 
        $this->load->helper('rxHelperFunctions');
        $this->load->library('session');
        $user = $this->session->userdata('activeuser');
        $location = $this->session->userdata('userlocation');
        $country = '';
        $region = 0;
        $province = 0;
        $city = 0;
        if ($location != null){
                $country = $location['country'];
                $region = $location['region'];
                $province = $location['province'];
                $city = $location['city'];
        }
        
    ?>

  <body>
    <script src="../../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>    
    <script src="../../assets/js/location.js"></script>
    <div class="container-fluid"> 
    <div class="row ">  
                <div class="row">
                    <div class="form-group col-md-12" id="proflocation">
                       
                        <div class="form-group col-md-6">
                                <label>Country</label>
                                 <select name='country' id='country' class='form-control'>
                                <?php  echo country_dropdown($country);?>
                                </select>
                        </div>

                        <div class="form-group col-md-6">
                                <label>Region</label>
                                <select name='region' id='region' class='form-control' 
                                        onchange='onRegionChange(this)'>
                                <?php  echo region_dropdown($region,  '');?>
                                </select>
                        </div>

                        <div class="form-group col-md-6">
                                <label>Province</label>
                                <select name='province' id='province' class='form-control'
                                        onchange='onProvinceChange(this)'>
                                <?php  echo province_dropdown($province, $region, null);?>
                                 </select>
                        </div>

                        <div class="form-group col-md-6">
                                <label>City</label>
                                 <select name='city' id='city' class='form-control'>
                                 <?php  echo city_dropdown( $city, $province, null);?>
                                  </select>
                        </div>
                    </div>            
                </div>            
    </div>
    </div> <!-- /container -->
  </body>
</html>
