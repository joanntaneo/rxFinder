
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
            <div >
                <form action="" method="POST">
                    <div class="row">
                        <div class="form-group col-md-12">
                        <div class="row">                            
                             <input type="hidden" name="branchno" class="form-control" id="branchno" value ="">
                                
                             <div class="form-group col-md-4 ">
                                <label>Branch Name</label>
                                <input type="text" name="branchname" class="form-control" id="branchname" 
                                       value="" required='true'>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label>Contact Number</label>
                                <input type="text" name="contactno" class="form-control" id="contactno" 
                                       value="" required="true">
                            </div>

                            <div class="checkbox col-md-4">
                                <br>
                                <label>
                                  <input type="checkbox" name="status" id="status"> Activate
                                </label>
                                <br>
                             </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                    <label>Web Service's URL</label>
                                    <input type="url" name="url" class="form-control" id="url"
                                           value="" >
                            </div>
                        </div>
                        
                         <div class="row">
                            <label class="boxHeader"> Please select branch location</label>
                            <!--<input type="checkbox" name="profileloc" value="self" checked="true">  Use Profile Location-->
                            <br><br>
                            <?php $this->load->view('GenericLocationUI'); ?>     
                        </div>
                            
                        <div id="map-canvas" style="display:none">
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">
                        </div>       
                        <br>

                        <div class="col-md-3 col-md-3">                  
                            <input class="btn btn-sm  btn-block btn-rx" type="button"
                                   id="addBranch" onclick="onAddBranch()" value="Add ">   
                        </div>     
                         <div class="col-md-3">                  
                            <input class="btn btn-sm  btn-block btn-rx" type="button"
                                   id="updateBranch" onclick="onUpdateBranch()" value="Update ">   
                        </div>   
                       <div class="col-md-3">                  
                            <input class="btn btn-sm btn-block btn-rx" type="button"
                                   id="searchBranch" onclick="onFindBranch(true)" value="Search ">   
                        </div>        
                        <div class="col-md-3">                  
                            <input class="btn-sm btn-block btn-rx" type="button"
                                   id="deleteBranch" onclick="onGeocode()" value="Geocode ">   
                        </div>    
                            
                        </div>
                    </div>
                   </form>
                     <div class="row"> 
                          <input type='hidden' id='current_page' />
                        <input type='hidden' id='show_per_page' />
                        <div class="table-responsive"  id="searchTable">                           
                        </div>
                    </div>                    
                    <div class="row">
                           <div class="col-md-12 right" id="page_navigation">  
                           </div>    
                   </div>   
            </div>
        </div>
    </div> <!-- /container -->
  </body>

  <script type="text/javascript">
    window.onload = function () { 
        onFindBranch(true);
    }
  </script>
</html>
