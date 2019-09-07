<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location:home.php');
}
if(isset($_POST['login'])){
      include("../includes/config.php");
      $username=$_POST['email'];
      $password=$_POST['pass'];
      if(empty($username)||empty($password)){
      $error= '<b>Username/password left blank.</b>';
      }else{
     $result=mysqli_query($db,"SELECT * FROM user WHERE email='$username';");
    $row=mysqli_fetch_assoc($result);
     $count=mysqli_num_rows($result);
     if($count==1){
         $hashpwd= password_verify($password,$row['password']);
         if($hashpwd==true){
         $_SESSION['id'] = $row['id'];
         $_SESSION['fname'] = $row['fname'];
         $_SESSION['lname'] = $row['lname'];
         if($row['role']==0){ //if non-admin
            header('Location: home.php');
         }
         else{
             $_SESSION['sadmin']= 'sadmin'; //make a session variable so that we can prevent a student from manually entering a page which belongs to admin.
             header('Location: admin/ad-pending.php');
         }
         }
     }else{
     $error='<b>Invalid Username/password.</b>';
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
   <title>Home Page</title>
</head>
<style>

    body{
        background-image: url(../images/hero.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
    }
    #register{
        text-decoration:none; 
        color: white;
    }
    #register:hover{
        color: lightblue;
    }
}
    
</style>
  <body>
<div class="container">
     <div class="row h-100 mx-auto justify-content-center align-items-center text-center" style="margin-top:180px;">
        <form action="" method="POST">
            <img src="../images/logo.png" alt="Sign In To Continue To Fast Shop">
            <h1 style="font-size:40px;margin-bottom:20px; text-align:center;">Sign In</h1>
            <input type="text" class="email form-control" name="email" placeholder=" Email or phone" style="width: 300px;"><br>
			<input type="password" class="pass form-control" name="pass" placeholder=" Password" style="width: 300px;"><br>
       	    <input type="submit" name="login" class="btn btn-info " value="Login" style="margin-top: 20px;">
            <?php if(isset($error)){ echo "<br><br><p style='color:lightcoral'>".$error."</p>"; }?>
        </form>
     </div>
     <a href="register.php" id="register"><p style="text-align:center; margin-top:5px;">New Student? Register Now.</p></a>
     <a href="register.php" id="register"><p style="text-align:center; margin-top:5px;">Forgot Password?</p></a>
</div>
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>   
  </body>
</html>