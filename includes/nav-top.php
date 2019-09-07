<?php
ob_start(); // https://stackoverflow.com/questions/1912029/warning-cannot-modify-header-information-headers-already-sent-by-error
session_start();
include('../includes/config.php');
$result1=mysqli_query($db,"SELECT * FROM `category`;");?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
       <!--font awesome-->
    <link rel="stylesheet" href="../css/fawesome/css/all.css">
    <link rel="icon" href="https://png.icons8.com/color/50/2c3e50/chef-hat.png">
    <title>Fast-Fries</title>
  </head>
  <style>
  
      .bg-black{
        background-color: #242323;
      }
      
  </style>
  <body>
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
   <a class="nav-link" href="../src/home.php"><img src="../images/logo2.png" style="width:50px;"></a>
    <div class="container">
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
       </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="nav navbar-nav pull-sm-left">
                      <ul class="navbar-nav mr-right mt-2 mt-lg-0">
                          <li class="nav-item dropdown bg-primary">
                            <a class="nav-link dropdown-toggle bg-black" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Our Menu</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="../src/menu.php">View All</a>
                                <div class="dropdown-divider"></div>
                             <?php if($result1->num_rows>0){
                                 while($row=$result1->fetch_assoc()){?>
                              <a class="dropdown-item" href="../src/menu.php?type=<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; ?></a>
                                <div class="dropdown-divider"></div>
                                 <?php }}?>
                            </div>
                          </li>
                    </ul>
                </ul>
                <ul class="nav navbar-nav navbar-logo mx-auto">
                  <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" action="" method="post">
                            <input class="form-control mr-sm-2" name="searchx" type="text" placeholder="Search" aria-label="Search">
                            <input class="btn btn-outline-info my-2 my-sm-0" type="submit" value="search" name="searchc">
                        </form>
                        <!--php for search -->
                        <?php
                          if(isset($_POST['searchc'])){
                              $_SESSION['searchquery']=$_POST['searchx'];
                              header('location:search.php');
                          }
                          ?>
                  </li>
                </ul>
                <ul class="nav navbar-nav pull-sm-right">
                      <ul class="navbar-nav mr-right mt-2 mt-lg-0">
                          <li class="nav-item dropdown bg-primary">
                            <a class="nav-link dropdown-toggle bg-black" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?></a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="../src/cart.php">My Cart</a>
                                <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="../src/view-pending.php">Pending Orders</a>
                                <div class="dropdown-divider"></div>
                               <a class="dropdown-item" href="../src/notif.php">Notifications</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../src/history.php">Order History</a>
                                <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="../src/logout.php">Logout</a>
                            </div>
                          </li>
                    </ul>
                </ul>
          </div>
    </div>
</nav>
