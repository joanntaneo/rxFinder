
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
  

  <body>
    <script src="../../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>    
    <script src="../../assets/js/pagination.js"></script>
    <script src="../../assets/js/location.js"></script>
   <script src="../../assets/js/googlemap.js"></script>
    <script src="../../assets/js/branch.js"></script>
    <div class="container-fluid"> 
    <div class="row ">  
        <div class="col-md-offset-2 col-md-8" > 
            <!--<div >-->
                 <div class="row">
                    <form action="">
                       <div >
                            <label class="boxHeader"> Please select current location</label>
                            <!--<input type="checkbox" name="location" value="self" checked="true">  Use Profile Location-->
                            <br><br>
                        </div>
                        <?php $this->load->view('GenericLocationUI'); ?>                            
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">        
                                <input class="btn-sm btn-block btn-rx" type="button"
                                       id="addBranch" onclick="onFindBranch()" value="Search">
                            </div>
                        </div>
                        <br>
                        <div id="map-canvas" style="display:none"></div>       
                        <br>
                    </form>
                </div>
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
        </div>
    </div> <!-- /container -->
  </body>
</html>
