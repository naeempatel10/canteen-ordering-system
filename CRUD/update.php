<?php
//change quantity to the original quantity, delete item from cart
ob_start();
session_start();
include('../includes/config.php');
if(!isset($_SESSION['id'])){
    header('Location: ../src/index.php');
}
else{
    if(isset($_GET['id']) && isset($_GET['q'])){
        $foodid= $_GET['id'];
        $userid= $_SESSION['id'];
        $fquantity= $_GET['q'];
        $result=mysqli_query($db,"UPDATE `food` SET `quantity`= quantity + $fquantity WHERE id=$foodid;");
        $result1=mysqli_query($db,"DELETE FROM `cart` WHERE food_id=$foodid AND user_id=$userid;");
        header('Location: ../src/cart.php');
    }
}
?>