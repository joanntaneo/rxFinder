
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
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
  </head>
  
   
<style type="text/css">  
    html { height: 50% }  
    body { height: 60%; margin: 0; padding: 0 }  
    #map-canvas { height: 80% }  
</style> 
  <?php 
  $this->load->helper('rxHelperFunctions');
  ?>

  <body>
    <script src="../../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/pagination.js"></script>
    <script src="../../assets/js/location.js"></script>    
   <script src="../../assets/js/googlemap.js"></script>
    <script src="../../assets/js/product.js"></script>
    <div class="container-fluid"> 
    <div class="row ">  
        <div class="col-md-offset-2 col-md-8" > 
            <div >
                <form action="">
                    <div class="row">
                        <label class="boxHeader"> Please provide product details to search</label>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            
                            <div class="form-group col-md-6">
                                    <label>Generic Name</label>
                                    <input type="text" name="generic" class="form-control" id="generic" value="Paracetamol">
                            </div>

                            <div class="form-group col-md-6">
                                    <label>Brand</label>
                                    <input type="text" name="brand" class="form-control" id="brand" >
                            </div>

                            <div class="form-group col-md-6">
                                    <label>Volume</label>
                                    <input type="text" name="volume" class="form-control" id="volume" >
                            </div>

                            <div class="form-group col-md-6">
                                    <label>Unit</label>
                                    <select  name="unit" class="form-control" id="unit">
                                        <?php  echo config_dropdown("product_units", "Unit");?>
                                    </select>
                            </div>
                            
                        </div>
                    </div>
                    
                     <div class="row">
                        <label class="boxHeader"> Please select current location</label>
                        <!--<input type="checkbox" name="location" value="self" checked="true">  Use Profile Location-->
                        <br><br>
                    </div>
                    <?php $this->load->view('GenericLocationUI'); ?>               
                    
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">                 
                            <input class=" btn-sm btn-block btn-rx" type="button"
                                   id="addBranch" onclick="onFindProduct(false)" value="Search"> 
                        </div>
                    </div><br></br>
                    <div class="row"> 
                        <input type='hidden' id='current_page' />
                        <input type='hidden' id='show_per_page' />
                        <div class="table-responsive" id="searchTable">                            
                        </div>
                    </div>                    
                   <div class="row">
                        <div class="col-md-12 right" id="page_navigation">  
                        </div>    
                   </div>            
                   <br>
                     <div id="map-canvas" style="display:none"></div>       
                   <br>
                </form>
            </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>
