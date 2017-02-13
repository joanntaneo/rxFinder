
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
    ?>

  <body>
    <script src="../../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>   
    <script src="../../assets/js/profile.js"></script>
    <script src="../../assets/js/location.js"></script>
    <div class="container-fluid"> 
    <div class="row ">  
        <div class="col-md-offset-2 col-md-8" > 
            <div >                    
                    <div class="row">                        
                        <div class="col-md-12 error" id="message">                           
                           <p align='center' class='error'><?php echo $message ?></p>
                        </div>                        
                        <div class="col-md-4">
                            <img src="/<?php echo base_url();?><?php echo $profilepic?>"
                                 class="img-responsive center-block">
                        </div>
                        
                        <div class="col-md-8" style ="vertical-align: middle; ">
                            <div class="form-group ">
                                <label>Action</label>
                                <select name="actionprof" id="actionprof" 
                                        class='form-control' onchange="onActionChange()">
                                    <option value="uprof" selected="true">Update Profile </option>
                                      <option value="cpwd">Change Password </option>
                                      <option value="cprof">Upload Profile Picture</option>
                                      <!--<option value="rprof">Remove Profile Picture</option>-->
                                </select>
                            </div>
                            
                           
                            <form name="frmProfileData" action="/<?php echo site_url();?>/AccountController/onChangePassword" 
                                method="POST">
                                 <div id="changePassword"  style="display: none">
                                    <div class="form-group col-md-4">
                                     <input type="password" name="password" id="password" class="form-control"
                                            placeholder='New Password'>           
                                    </div>
                                    <div class="form-group col-md-4">
                                    <input type="password" name="repassword" id="password"  class="form-control"
                                           placeholder='Confirm Password'>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="submit" value='Change Password'>
                                    </div>                                         
                                </div>
                            </form>
                            <br />
                           <form name="frmProfileData" action="/<?php echo site_url();?>/AccountController/onUploadPic" 
                                  method="POST" enctype="multipart/form-data">      
                            <div id="profilepicture" style="display: none">
                                 <div class="form-group col-md-6">
                                 <input type="file" name="pic" size="20" />
                                 </div>
                                <div class="form-group col-md-6">
                                 <input type="submit" value="upload" />
                                 </div>
                             </div>
                             </form>
                            <br />
                    <form name="frmProfileData" action="/<?php echo site_url();?>/AccountController/onUpdateProfile" method="POST">        
                            <div class="form-group ">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" id="username" 
                                       value="<?php echo $this->session->userdata('login_user'); ?>"  disabled>
                            </div>
                            
                            <div class="form-group ">
                                <label>Email Address</label>
                                <input type="text" name="email" class="form-control" id="email" 
                                       value="<?php echo $user['emailadd']; ?>" disabled>
                            </div>                            
                        </div>
                    </div>
                    <div class="row" id="profName">
                         <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" 
                                   value="<?php echo $user['firstname']; ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" 
                                   value="<?php echo $user['lastname']; ?>" required>
                        </div>
                    </div>
                     <h3>Location</h3>
                    <div class="row">
                        <?php $this->load->view('GenericLocationUI'); ?>    
              </form>
                        <div class="col-md-offset-4 col-md-4" id="profbutton" style="display: block">                  
                            <input class="btn-sm  btn-rx btn-block" type="button"
                                    value="Update Profile" onclick="onUpdateProfile()">
                        </div>               
                 </div>
            <!--</form>-->
        </div>
    </div> <!-- /container -->
    
    
 
  </body>
</html>




