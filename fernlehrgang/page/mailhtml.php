<?php
/**
* Filename.......: example.1.php
* Project........: HTML Mime Mail class
* Last Modified..: 15 July 2002
*/

//        error_reporting(E_ALL);
        include_once('../../page/htmlMimeMail.php');

        $mail = new htmlMimeMail();
        $mail->setHtml($mail_txt, $raw);
        #$mail->setText($mbody);
		#$mail->addHtmlImage($background, 'background.gif', 'image/gif');
		$mail->addAttachment('../../nldownloads/20130503-test_1.pdf','20130503-test_1.pdf');

		$mail->setReturnPath($Empfaenger);

		/**
        * Set some headers
        */
		 //echo "<br>".('"' .$name .'" ---- <' .$kundemail .'>')."-$kundemail-<br>empf.: ";
		 //print_r($Empfaenger);
		 
		$mail->setFrom('"' .$name .'" <' .$kundemail .'>');
		// if ($bcc) $mail->setBcc( $bcc.' <'.$bcc.'>' ); 
		// $mail->setReply($em);
		$mail->setSubject($Betreff);
		$mail->setHeader('X-Mailer', 'HTML Mime mail class (http://www.phpguru.org)');
		
		/**
        * Send it using SMTP. If you're using Windows you should *always* use
		* the smtp method of sending, as the mail() function is buggy.
        */
		# $result = $mail->send(array($Empfaenger), 'smtp');
		$result = $mail->send($Empfaenger);

		// These errors are only set if you're using SMTP to send the message
		if (!$result) {
			// echo 'Mail NOT sent!';
			//print_r($mail->errors);
		} else {
  			// echo 'Mail sent!';
		}
		
		echo 'ANHAENGE !!!';

?>