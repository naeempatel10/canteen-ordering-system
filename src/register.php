<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location:home.php');
}
if(isset($_POST['register'])){
      include("../includes/config.php");
      $_SESSION['fname']=$_POST['fname'];
      $_SESSION['lname']=$_POST['lname'];
      $_SESSION['email']=$_POST['email'];
      $_SESSION['password']= password_hash($_POST['password'], PASSWORD_DEFAULT);
      $_SESSION['phno']=$_POST['phno'];
      if(empty($_SESSION['fname'])||empty($_SESSION['lname'])||empty($_SESSION['email'])||empty($_SESSION['password'])||empty($_SESSION['phno'])){
      $error= '<b>All Fields Must Be Filled.</b>';
      }//start of mobile number validation. if not a number
    elseif(is_nan($_POST['phno'])){
      $error= '<b>Enter A Valid number.</b>';
    }
    elseif(($_POST['phno'][0]) != 9 && ($_POST['phno'][0]) != 8 && ($_POST['phno'][0]) != 7){//if the 1st number is not 9 or 8 or 7
      $error= '<b>Enter A Valid number.</b>';
    }
    elseif(strlen($_POST['phno']) != 10){//if length !=10
      error_reporting(0);// I was getting the notice "Notice: A non well formed numeric value encountered" error. Hence disabled it.
      $error= '<b>Enter A Valid number.</b>';
    }//end of phno validation
    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){//email validation
      $error= '<b>Enter A Valid email.</b>';
    }
    elseif(!ctype_alpha($_POST['fname']) || !ctype_alpha($_POST['lname'])){//fname,lname validation
      $error= '<b>Enter A Valid name.</b>';
    }

    else{
             $username=$_SESSION['email'];
             $password=$_SESSION['password'];
             $result=mysqli_query($db,"SELECT * FROM user WHERE email='$username';");
             $row=mysqli_fetch_assoc($result);
             $count=mysqli_num_rows($result);
             if($count==1){
                 $error='<b>Email id Already Registered.</b>';
             }
            else{
            header('Location: ../includes/phpmail/mailS.php');
            }
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
     <div class="row h-100 mx-auto justify-content-center align-items-center text-center" style="margin-top:180px;">
        <form action="" method="POST">
            <img src="../images/logo.png" alt="Sign In To Continue To Fast Shop">
            <h1 style="font-size:40px;margin-bottom:20px; text-align:center;">Register</h1>
                <div class="row" style="margin-bottom:20px;">
                    <div class="col">
                      <input type="text" class="form-control" placeholder="First name" name="fname">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Last name" name="lname">
                    </div>
              </div>
              <div class="row" style="margin-bottom:20px;">
                    <div class="col">
                      <input type="text" class="email form-control" placeholder="Enter Email*" name="email">
                    </div>
                    <div class="col">
                      <input type="password" class="pass form-control" placeholder="Enter Password" name="password">
                    </div>
              </div>
            <div class="row" style="margin-bottom:20px;">
                    <div class="col">
                      <input type="text" class="email form-control" placeholder="Enter Phone Number" name="phno">
                    </div>
              </div>
              
       	    <input type="submit" name="register" class="btn btn-info " value="Send OTP" style="margin-top: 20px;">
            <?php if(isset($error)){ echo "<br><br><p style='color:lightcoral'>".$error."</p>"; }?>
        </form>
    </div>
     <p style="text-align:center; margin-top:10px;">*An OTP Would Be Send To Your Email Address.</p>
</div>
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>   
  </body>
</html>