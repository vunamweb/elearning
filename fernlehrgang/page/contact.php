<?php
global $morpheus, $projID, $pageText, $lan, $navID, $subDetail, $gmap, $dir, $contact, $form, $cid;

// $contact = 1;

$na = $_POST["message"];
$nm = $_POST["name"];
$be = $_POST["betreff"];
$fi = $_POST["firma"];
$st = $_POST["street"];
$pl = $_POST["plz"];
$or = $_POST["ort"];
$fo = $_POST["fon"];
$em = trim($_POST["email"]);

//print_r($_POST);

if ($nm) {
	$mbody = '
<style Type="text/css">
<!--
p, h1 {
font-family:Arial;
font-size:11px;
line-height:16px;
}
//-->
</style>

<p><strong>Name</strong>: '.$nm.'</p>
<p><strong>Unternehmen</strong>: '.$fi.'</p>
<p><strong>Telefon</strong>: '.$fo.'</p>
<p><strong>E-Mail</strong>: '.$em.'</p>

<p>----------------------------------------------------------------------------</p>
<p><strong>Nachricht</strong>:<br>
'.nl2br($na).'</p>
';
	$mbody = utf8_decode($mbody);
	// $Empfaenger = $morpheus["email"];
	// $Empfaenger = 'info@sauerproduct.com';
	$Empfaenger = 'post@pixel-dusche.de';
	$name 		= 'sauer products';
	// $bcc 		= 'post@pixel-dusche.de';
	$sender 	= 'info@sauerproduct.com';
	$sendername	= 'sauer products';

	$Betreff 	= $be ? utf8_decode($be) : "Kontaktanfrage aus dem Internet";

	$today = date("Y-m-d H:i:s");
	$sql = "insert morp_email set betreff='$Betreff', mail='$em', datum='$today', text='$mbody', `to`='$Empfaenger'";
		safe_query($sql);

	include("phpmailer.php");

	/* ------------------------------------------------------  */
	/* ------------------------------------------------------  */
	/* ------------------------------------------------------  */

$mbody = '
<style Type="text/css">
<!--
p, h1 {
font-family:Arial;
font-size:11px;
line-height:16px;
}
//-->
</style>

<p>Vielen Dank für Ihre Nachricht</p>
';

	$Empfaenger = $em;
	$name 		= $nm;

	// include("phpmailer.php");

	/* ------------------------------------------------------  */
	/* ------------------------------------------------------  */
	/* ------------------------------------------------------  */

	$form = '<h2>Vielen Dank f&uuml;r Ihre Nachricht. </h2>

	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	';

}

else {
	if($buchen) {
		$sql = "SELECT reise FROM  `morp_reisen` WHERE oid=$buchen";
		$res = safe_query($sql);
		$row = mysqli_fetch_object($res);
		$buchen = $row->reise;
	}

	$form .= '
							<div class="box success_box widgetinfo" style="">
								<table>
									<tr>
										<td>&nbsp;</td>
										<td>Vielen Dank f&uuml;r Ihre Nachricht!<br></td>
									</tr>
								</table>
							</div>
							<script type="text/javascript">
								jQuery(document).ready(function () {
									jQuery(\'#form\').validationEngine(\'init\');

									jQuery(\'#form a#formsend\').click(function () {
										var form_builder_url = jQuery(\'#contact_form_widget_001_wurl\').val();

										jQuery(\'#form .loading\').animate( {
											opacity : 1
										} , 250);

										if (jQuery(\'#form\').validationEngine(\'validate\')) {
											jQuery.post(form_builder_url, {
												name : jQuery(\'#name\').val(),
												email : jQuery(\'#email\').val(),
												fon : jQuery(\'#fon\').val(),
												message : jQuery(\'#message\').val(),
												formname : \'contact_form_widget_001\',
												formtype : \'screening\'
											}, function () {
												jQuery(\'#form .loading\').animate( { opacity : 0 }, 250);
												document.getElementById(\'form\').reset();
												jQuery(\'#form\').parent().find(\'.widgetinfo\').hide();
												jQuery(\'#form\').parent().find(\'.widgetinfo\').fadeIn(\'fast\');
												jQuery(\'html, body\').animate( { scrollTop : (jQuery(\'#form\').offset().top - 100) }, \'slow\');
												jQuery(\'#form\').parent().find(\'.widgetinfo\').delay(5000).fadeOut(1000);
											} );

											return false;
										} else {
											jQuery(\'#form .loading\').animate( { opacity : 0 }, 250);

											return false;
										}
									} );
								} );
							</script>


		<h2>Kontakt</h2>
		<form action="" id="form" class="pcss3f pcss3f-type-col pcss3f-vm" method="POST">

			<div class="loading"></div>

			<div class="form-group">
				<input type="text" name="name" id="name" placeholder="NAME *" class="validate[required]" />
			</div>

			<div class="form-group">
				<input type="text" name="email" id="email" placeholder="EMAIL *" class="validate[required,custom[email]]" />
			</div>

			<div class="form-group">
				<input type="text" name="fon" id="fon" placeholder="TELEFON" />
			</div>

			<div class="form-group">
				<textarea cols="20" rows="6" name="message" id="message"  placeholder="NACHRICHT *" class="validate[required]" /></textarea>
			</div>

			<div>
				<a href="#" id="formsend" class="button_small"><span>Absenden</span></a>
				<input type="hidden" name="contact_form_widget_001_wurl" id="contact_form_widget_001_wurl" value="'.($cid < 2 ? '' : '../').'php/sendmail.php" />
			</div>

		</form>
';
}
$pageText = '';

?>