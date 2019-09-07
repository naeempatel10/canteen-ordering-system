<?php
//change quantity to the original quantity, delete item from cart
//bugs: if the quantity of 2 same product is same, then both are deleted. fix: pass cart_id
ob_start();
session_start();
include('../includes/config.php');
if(empty($_GET['id']) && empty($_GET['q']) && empty($_GET['c'])){
    header('Location: ../src/home.php');
}
else{
    if(isset($_GET['id']) && isset($_GET['q']) && isset($_GET['c'])){
        $foodid= $_GET['id'];
        $userid= $_SESSION['id'];
        $fquantity= $_GET['q'];
        $cart_id= $_GET['c'];
        $result=mysqli_query($db,"UPDATE `food` SET `quantity`= quantity + $fquantity WHERE id=$foodid;");
        $result1=mysqli_query($db,"DELETE FROM `cart` WHERE food_id=$foodid AND user_id=$userid AND food_quantity=$fquantity AND cart_id=$cart_id;");
        header('Location: ../src/cart.php');
        header('Location: ../src/cart.php');
    }
}
?>