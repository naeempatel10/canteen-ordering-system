<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location:home.php');
}
if(isset($_POST['register'])){
      include("../includes/config.php");
      $otp = $_POST['otp'];
      $sentotp = $_SESSION['otp'];
    //echo $sentotp;
    if(empty($_POST['otp'])){
      $error= '<b>OTP cannot be empty.</b>';
      }
    if($otp==$sentotp){
      $fname=$_SESSION['fname'];
      $lname=$_SESSION['lname'];
      $email=$_SESSION['email'];
      $pwd=$_SESSION['password'];
      $phno=$_SESSION['phno'];
      //$result2=mysqli_query($db,"INSERT INTO `user`(`fname`, `lname`, `email`, `password`, `phno`) VALUES ($fname,$lname,$email,$pwd,$phno);");
      $result2=mysqli_query($db,"INSERT INTO `user`(`fname`, `lname`,`password`, `phno`,`email`) VALUES ('$fname','$lname','$pwd',$phno,'$email');");
      unset($_SESSION['fname']);
      unset($_SESSION['lname']);
      unset($_SESSION['email']);
      unset($_SESSION['password']);
      unset($_SESSION['phno']);
      echo "<script>alert('Account Registerd Successfully')</script>";
      //header('Location: ../src/index.php');
      header("Refresh:2; url= ../src/index.php");
        //header('Refresh:0');
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="icon" href="https://png.icons8.com/color/50/2c3e50/chef-hat.png">
   <link rel="stylesheet" href="../fawesome/css/all.css">
   <title>Registration Page</title>
</head>
<style>

    body{
        background-image: url(../images/hero.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
    }
}
    
</style>
  <body>
<div class="container">
     <div class="row h-100 mx-auto justify-content-center align-items-center text-center" style="margin-top:200px;">
        <form action="" method="POST">
            <img src="../images/logo.png" alt="Sign In To Continue To Fast Shop">
            <h1 style="font-size:40px;margin-bottom:20px; text-align:center;">Register</h1>
            <input type="text" class="email form-control" placeholder="Enter OTP" name="otp">
       	    <input type="submit" name="register" class="btn btn-info " value="Register" style="margin-top: 20px;">
            <?php if(isset($error)){ echo "<br><br><p style='color:lightcoral'>".$error."</p>"; }?>
        </form>
    </div>
</div>
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>   
  </body>
</html>