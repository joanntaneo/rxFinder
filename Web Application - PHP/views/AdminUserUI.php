
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
  
    <body>
    <script src="../../assets/js/jquery-2.1.4.min.js"></script>
    <!--<script src="../../assets/js/bootstrap.min.js"></script>-->
     <script src="../../assets/js/pagination.js"></script>
    <script src="../../assets/js/location.js"></script>
    <script src="../../assets/js/user.js"></script>
    <div class="container-fluid"> 
    <div class="row ">  
        <div class="col-md-offset-2 col-md-8" > 
            <div >
                <form action="">
                    <div class="row">
                            <div class="col-md-12 error" id="message">                           
                               <p align='center' class='error'><?php echo $message ?></p>
                            </div> 
                            <div class="form-group col-md-12">
                                <div class="row">       
                                    <div class="form-group col-md-6 ">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" id="username">
                                    </div>

                                    <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" name="pass" class="form-control" id="pass" >
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="form-group col-md-6">
                                            <label>Email Address</label>
                                            <input type="text" name="email" class="form-control" id="email" >
                                    </div>
                                    <div class="checkbox col-md-6">
                                        <br>  <input type="checkbox" id="SA" name="SA"><label> System Administrator? </label><br>
                                     </div>
                                </div>
                                <div class="row">                            
                                    <div class="form-group col-md-6">
                                            <label>First Name</label>
                                            <input type="text" name="fname" class="form-control" id="fname">
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" class="form-control" id="lname">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-offset-3 col-md-3">                                   
                                <label >Action</label>
                            </div>   
                            <div class="col-md-3"> 
                                 <select name='action' id='action' class='form-control' onchange="onUserActionChange()">
                                     <option value="search" selected="true">Search User </option>
                                     <option value="add">Add User</option>                                     
                                     <option value="update" disabled="true">Update User</option>                                     
                                 </select>
                              </div>   
                            <div class="col-md-3">         
                                <input class="btn btn-sm  btn-block btn-rx" type="button"
                                       id="addUser" onclick="onApplyClick()" value="Apply ">   
                            </div>
                        
<!--                             <div class="col-md-4">                  
                                <input class="btn btn-sm  btn-block btn-rx" type="button"
                                       id="updateUser" onclick="onAddUser()" value="Add ">   
                            </div>   
                           <div class="col-md-4">                  
                                <input class="btn btn-sm btn-block btn-rx" type="button"
                                       id="searchUser" onclick="onUpdateUser()" value="Update">   
                            </div>                                -->
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
    </div>
    </div> <!-- /container -->
  </body>
</html>

  <script type="text/javascript">
    window.onload = function () { 
        onUserActionChange();
    }
</script>
