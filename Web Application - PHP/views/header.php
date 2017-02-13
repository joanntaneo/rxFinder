

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
    <?php 
        $this->load->helper('url'); 
        $this->load->library('session');
   ?>

    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/mycss.css" rel="stylesheet">
  </head>
   
  <body>
     <script src="../../assets/js/jquery-2.1.4.min.js"></script>
     <script src="../../assets/jquery-ui/jquery-ui.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
   
    <div class="container-fluid"> 
        <div class="row ">  
            <div class="col-md-offset-2 col-md-8" > 
                <div >
                    <div class="row">
                        <img src="<?php echo $headimage?>" class="img-responsive center-block" >
                    </div>
                   <div class="row">
                        <nav id="myNavbar" class="navbar navbar-default " role="navigation">
                            <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" 
                                        data-target="#navbarCollapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand">Welcome <?php echo  $username;?>!</a>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <ul class="nav navbar-nav navbar-right ">
                                    <li><a href="/<?php echo site_url();?>/AccountController/showProfile">
                                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                                Profile</a></li>
                                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" 
                                               href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                               <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                Search<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/<?php echo site_url();?>/TransactionController/onSearchBranch">
                                                    Nearest Branch</a></li> 
                                            <li><a href="/<?php echo site_url();?>/TransactionController/onProductSearch">
                                                    Product</a></li>
                                        </ul>
                                    </li>
                                    <?php 
                                    $user = $this->session->userdata('activeuser');
                                    if (strcmp($user['accessright'],"A") == 0) { ?>
                                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" 
                                            href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> 
                                            Admin<span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/<?php echo site_url();?>/BranchController/onShowManageBranch">
                                                        Manage Branch</a></li>
                                                <li><a href="/<?php echo site_url();?>/AccountController/onShowManageUser">
                                                        Manage Users</a></li>
                                            </ul>
                                    </li>
                                    <?php } ?>
                                    <li><a href="/<?php echo site_url();?>/AccountController/onLogout">
                                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                                            Logout</a></li>
                                </ul>
                            </div>
                        </div>
                        </nav>
                   </div>
                </div>
            </div>
        </div>
    </div>
 </body>
</html>