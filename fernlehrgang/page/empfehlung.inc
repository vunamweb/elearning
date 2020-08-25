<?php

$arr_form = array("mitteilung", "nmsender", "emsender", "nmempf", "emempf");

$fertig = 1;

foreach($arr_form as $val) {
	$$val = $_POST[$val];
	if (!$$val) $fertig = 0;
}

if ($fertig) {
	// senden
	$output .= '<h1>Vielen Dank f&uuml;r Ihre Empfehlung</h1>';

	$mail_txt = '
<style Type="text/css">
<!--
* {
	margin:0px;
	padding:0px;
	font-family:Arial, Geneva, sans-serif;
	font-size:12px;
	line-height:20px;
	color:#656565;
}
p {
	margin:5px 0px 5px 0px;
}
a {
	text-decoration:none;
}
a:hover {
	color:#ca3372;
}
//-->
</style>
<p><strong>Unsere Seite wurde Ihnen empfohlen!</strong><br>
<br>
<a href="http://www.screening-mainz.de">http://www.screening-mainz.de</a>
<br><br>
Name: '.$nmsender.'<br>
E-Mail: '.$emsender.'<br><br>
Mitteilung: '.nl2br($mitteilung).'<br><br><br>
Ihr Screening-Zentrum Mainz
</p>
';
	$Empfaenger = $emempf;
	$bcc 		= 'xacffm@gmx.de';
	$name 		= "Screening-Zentrum Mainz";
	$kundemail 	= "info@screening-mainz.de";
	$Betreff 	= 'Screening-Zentrum Mainz Empfehlung durch '.$nmsender;

	include("mail.php");
}

else	$output .= '
<h3>Ich m&ouml;chte diese Seite Weiter empfehlen</h3>
<form action="#" method="post">
	<p class="formhead"><strong>Mitteilung für den Empfänger</strong></p>
	<textarea class="formtext" name="mitteilung">'.$mitteilung.'</textarea>

	<h2>Absender</h2>

	<p class="form1">Name<br/>
	<input class="form3" name="nmsender" type="text" size="30" maxlength="40" value="'.$nmsender.'" /></p>

	<p class="form1">E-Mail Adresse<br/>
	<input class="form2" name="emsender" type="text" size="30" maxlength="40" value="'.$emsender.'" /></p>

	<h2>Empf&auml;nger</h2>
	<p class="form1">Name<br/>
	<input class="form3" name="nmempf" type="text" size="30" maxlength="40" value="'.$nmempf.'" /></p>

	<p class="form1">E-Mail Adresse<br/>
	<input class="form2" name="emempf" type="text" size="30" maxlength="40" value="'.$emempf.'" /></p>

	<br style="clear:left;" />

	<!-- <input class="form4" type="reset" /> -->

	<input class="form4" type="submit" />

</form>

';

?>