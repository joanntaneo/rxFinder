


<!--DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1.0">
     The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags 
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>rxFinder</title>

     Bootstrap core CSS 
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/mycss.css" rel="stylesheet">
  </head>

  <body>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>-->
<?php
echo '<nav id="myNavbar" class="navbar navbar-default " role="navigation">
        <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Welcome !</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav navbar-right ">
                <li><a href="" <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="FindBranchUI.php">Nearest Branch</a></li>
                        <li><a href="FindProductUI.php">Product</a></li>
                    </ul>
                </li>                
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Admin<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="BranchConfigurationUI.php">Manage Branch</a></li>
                            <li><a href="AdminUserUI.php">Manage Users</a></li>
                        </ul>
                </li>
                <li><a href="../../index.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout</a></li>
            </ul>
        </div>
    </div>
    </nav>'; 
?>
 <!-- /body>
</html-->