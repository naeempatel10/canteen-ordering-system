<?php
class sendMailD
{	
	private $conn;
	function sendMail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email); 
		$mail->Username="pbl.groupvi@gmail.com";  
		$mail->Password="pblxgroup6x";     
		$mail->SetFrom('pbl.groupvi@gmail.com','Root User');
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		if(!$mail->send()) {
			  return "FAIL";
		} else {
  				return "OK";
		}
	}	
}
?>
