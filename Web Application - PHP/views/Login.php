
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
    <?php $this->load->helper('url');   ?>
    <!-- Bootstrap core CSS -->
    <link href="/<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/<?php echo base_url();?>assets/css/mycss.css" rel="stylesheet">
  </head>

  <body>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="/<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <div class="container-fluid"> 
    <div class="row vertical-center">  
        <div class="col-md-4" > 
            <div class="box">
                <img src="/<?php echo base_url();?>assets/images/rxLogIn.jpg" class="img-responsive center-block" 
                     alt="Rx Inventory System">
                <div style="color:#cc0000">
                    <?php if (isset($message)) { ?>
                    <p><center><?php echo $message;?></center></p>
                    <?php } ?>
                </div>
                <form action="/<?php echo site_url();?>/AccountController/validateCredentials" method="POST">
                    <div class="padding-rx">
                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="input" name="username" id="username" class="form-control" 
                        placeholder="Username"  autofocus required="true">
                    </div >
                    <div class="padding-rx">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" 
                        placeholder="Password" required="true">
                    </div>
                    <div class="padding-rx">
                    <button class="btn-rx btn btn-sm   btn-block  " 
                        type="submit">Sign in</button>   
                    </div>
                </form>
                <form action="/<?php echo site_url();?>/AccountController/showRegister" method="POST">
                <div align="center" >
                    <button class=" btn-rx btn btn-sm btn-block" type="submit">Register Me</button>  
                    <!--<a class="a-rx" href="/<?php //echo site_url();?>/AccountController/showRegister"><span>Register Me</span></a>-->
                    <!--<a class="a-rx" href="resetPassword.php" align="right" >Forgot Password </a>-->
                </div>
                </form>
            </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>
