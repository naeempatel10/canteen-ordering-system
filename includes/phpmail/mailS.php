<?php
session_start();
ob_start();
require_once 'sendMailD.php';
$mailF = new sendMailD();
    try
    {
		$userOtpRCode = rand (10000,99999); //5 digit random number
        $_SESSION['otp']= $userOtpRCode;
		$userEmail = $_SESSION['email'];//email id of recevr
            	$message= "
                           Hello , $userEmail
                           <br /><br />
                           Your OTP(One Time Password) is $userOtpRCode.
                           <br /><br />
                           
                           <br /><br />
                           Thank you 
                           <br /><br />
                           Fast Fries Canteen 
                           ";
                        $subject = "User verification";
                
                        $retv = $mailF->sendMail($userEmail,$message,$subject);

                        if($retv == "OK"){
                           
				header('Location: ../../src/otp.php');

                        }
                        else {
                            echo "Mail not sent!";
                        }
            

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }


?>

