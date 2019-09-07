<?php 
include('../../includes/config.php');
session_start();
$result=mysqli_query($db,"SELECT * FROM `category`;");
$result2=mysqli_query($db,"SELECT COUNT(*) FROM pending_order;");
//$result2=mysqli_query($db,"SELECT COUNT(*) FROM pending_order;");
if($result2->num_rows>0){
    if($row=$result2->fetch_assoc()){
        $count = $row['COUNT(*)'];
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <a href="../c"></a>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
       <!--font awesome-->
    <link rel="stylesheet" href="../../css/fawesome/css/all.css">
    <link rel="icon" href="https://png.icons8.com/color/50/2c3e50/chef-hat.png">
    <title>Fast Shop</title>
  </head>
  <style>
  
      .bg-black{
        background-color: #242323;
      }
      
  </style>
  <body>
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container">
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
       </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="nav navbar-nav pull-sm-left">
                  <li class="nav-item">
                    <a class="nav-link" href="../../src/admin/ad-pending.php">Pending Orders(<b><?php echo $count; ?></b>)</a>
                  </li>
                </ul>
                <ul class="nav navbar-nav pull-sm-left">
                  <li class="nav-item">
                    <a class="nav-link" href="../../src/admin/ad-food.php">Food</a>
                  </li>
                </ul>
                <ul class="nav navbar-nav pull-sm-left">
                  <li class="nav-item">
                    <a class="nav-link" href="../../src/admin/ad-hero.php">Banner</a>
                  </li>
                </ul>
                <ul class="nav navbar-nav pull-sm-left">
                  <li class="nav-item">
                    <a class="nav-link" href="../../src/admin/ad-category.php">Category</a>
                  </li>
                </ul>
                <ul class="nav navbar-nav navbar-logo mx-auto">
                </ul>
                <ul class="nav navbar-nav pull-sm-right">
                      <ul class="navbar-nav mr-right mt-2 mt-lg-0">
                          <li class="nav-item dropdown bg-primary">
                            <a class="nav-link dropdown-toggle bg-black" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?></a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="../../src/admin/ad-order-history.php">Order History</a>
                              <a class="dropdown-item" href="../../src/logout.php">Logout</a>
                            </div>
                          </li>

                    </ul>
                    
                </ul>
          </div>
    </div>
</nav>
