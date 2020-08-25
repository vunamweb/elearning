<?php
require_once 'class.phpmailer.php';

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
	
try {
	// $mail->AddReplyTo($reply, $replyNM);
	$mail->SetFrom($sender, $sendername);
	$mail->Subject = $Betreff;
	$mail->AltBody = $mbody;
	$mail->MsgHTML($mbody);
	// $mail->Sender = $reply;
	# $mail->MsgHTML(file_get_contents(strip_tags($mail_txt)));
  
	if ($upload) {
		foreach ($upload as $upl) {
			$pfad 		= '../../uploads/';
			$attachment = $pfad.$upl;
			$mail->AddAttachment($attachment);      // attachment
		}
	}
		
//	$mail->AddAddress($bcc, $name);
	$mail->AddAddress($Empfaenger, $name);
	$mail->Send();
  	// echo "Message Sent OK</p>\n";
  	
} catch (phpmailerException $e) {
	 echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
	 echo $e->getMessage(); //Boring error messages from anything else!
}

# echo "$reply, $replyNM - $sender, $sendername - $Empfaenger, $name #### $bcc, $name";
# echo "<p>$Empfaenger, $name</p>";
# die();
?>
