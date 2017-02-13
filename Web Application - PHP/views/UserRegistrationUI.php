
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
    <link href="/<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/<?php echo base_url();?>assets/css/mycss.css" rel="stylesheet">
  </head>
  
  

  <body>
    <script src="/<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
    <script src="/<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <div class="container-fluid"> 
    <div class="row vertical-center">  
        <div class="col-md-4" > 
            <div class="box">
                <div class="col-md-12">
                    <img src="/<?php echo base_url();?>assets/images/rxRegistration.jpg" 
                         class="img-responsive center-block" 
                         alt="Rx Inventory System">
                </div>
                 
                <div style="color:#cc0000">
                    <?php echo $message; ?>                   
                </div>         
                <form action="/<?php echo site_url();?>/AccountController/onRegistration" method="POST">
                    <input type="hidden" name='addedby' value='C'>
                    <input type="hidden" name='currpage' value='UserRegistrationUI'>
                    <input type="hidden" name='nextpage' value='Login'>
                    <div class="form-group col-md-12 ">
                        <label>Username</label>
                        <input type="" name="username" class="form-control" 
                            id="username" value="<?php echo set_value('username'); ?>"
                            required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" 
                            id="password" value="<?php echo set_value('password'); ?>"
                            required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Confirm Password</label>
                        <input type="password" name="repassword" class="form-control" 
                               id="repassword" value="<?php echo set_value('repassword'); ?>"
                               required>
                    </div>
                    
                     <h4>Contact Details</h4>
                    <div class="form-group col-md-6">                       
                        <label>Email Address</label>
                        <input type="text" name="emailAdd" class="form-control" 
                            id="emailAdd"  value="<?php echo set_value('emailAdd'); ?>"
                            required>
                    </div>
                     
                     <div class="form-group col-md-6">
                        <label>Confirm Email Address</label>
                        <input type="text" name="reemailAdd" class="form-control" 
                            id="reemailAdd" value="<?php echo set_value('reemailAdd'); ?>" 
                            required>
                </div>	
                                
                <div class="form-group col-md-6">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control" 
                            id="firstname" value="<?php echo set_value('firstname'); ?>"   
                            required>
                </div>

                <div class="form-group col-md-6">
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control" 
                            id="lastname"  value="<?php echo set_value('lastname'); ?>" 
                            required>
                </div>                 
                    <button class="btn btn-sm btn-block btn-rx" 
                            type="submit">Register Me</button>   
                </form>
            </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>
