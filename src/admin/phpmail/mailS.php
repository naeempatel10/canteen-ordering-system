<?php
ob_start();
require_once 'sendMailD.php';
$mailF = new sendMailD();
    try
    {
		$userEmail = $_SESSION['email'];//email id of recevr
		$food_name = $_SESSION['food_name'];//email id of recevr
		$food_quantity = $_SESSION['food_quantity'];//email id of recevr
		$food_subtotal = $_SESSION['food_subtotal'];//email id of recevr
		$xuser_id = $_SESSION['xuser_id'];//email id of recevr
        $firstname= $_SESSION['fname'];
        $lastname= $_SESSION['lname'];
        echo $userEmail;
            	$message= "
                           Hello , $firstname $lastname
                           <br /><br />
                           Your Order Of $food_name ($food_quantity quantity) Has Been Completed.
                           <br /><br />
                           Thank you, 
                           <br />
                           Fast Fries Canteen 
                           ";
                        $subject = "Your Order Has Been Prepared.";
                        $retv = $mailF->sendMail($userEmail,$message,$subject);

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }


?>

