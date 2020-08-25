<?php
/**
* Project........: HTML Mime Mail class
* Last Modified..: 15 July 2002
*/
        error_reporting(none);
        include_once('htmlMimeMail.php');

        $mail = new htmlMimeMail();
        $mail->setHtml($mail_txt, $raw);

#		$mail->setReturnPath($kundemail);
#		$mail->setSMTPParams('mail.apothekerkammer.de', 25, 'apothekerkammer.de', 1, 'Info-Postfach', 'info');
		$mail->setFrom($kundemail);
#		$mail->setBcc($bcc);
		$mail->setSubject($Betreff);
		$mail->setHeader('X-Mailer', 'HTML Mime mail class (http://www.phpguru.org)');
		/**
        * Send it using SMTP. If you're using Windows you should *always* use
		* the smtp method of sending, as the mail() function is buggy.
        */
				
#		echo "<br>Mail: $Empfaenger<br>";
		$post = "post@pixel-dusche.de";
		$result = $mail->send(array($Empfaenger, $post));
		// print_r($result);		
		// These errors are only set if you're using SMTP to send the message
		if (!$result) {
			 echo 'Mail PROBLEM!';
#			print_r($mail->errors);
		} else {
		//	 echo 'Mail was sent!';
		}
		
?>