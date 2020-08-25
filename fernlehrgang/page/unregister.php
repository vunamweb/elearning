<?php 

# $email = isset($_GET["email"]) ? $_GET["email"] : '';
$ur = isset($_POST["ur"]) ? trim($_POST["ur"]) : '';

// print_r($_POST);

if ($ur) {
	$sql = "SELECT * FROM morp_register WHERE email='$ur'";
	$res = safe_query($sql);			
	
	if(mysqli_num_rows($res)>0) {
		$row = mysqli_fetch_object($res);
		$vid = $row->vid;
		
		$sql = "DELETE FROM morp_register WHERE vid='$vid'";
		safe_query($sql);			
		
		$output .= utf8_encode(nl2br(get_text(10)));
	}
	else $output .= utf8_encode(nl2br(get_text(11)));
} 
else {
	$output .= '	
	
	<form method="post" name="abmelden" id="kontakt_formular">
			<p class="cl_left">
				<span style="width:160px;display:block;float:left;">Ihre E-Mail Adresse</span>
				<input type="text" name="ur" value="'.$email.'" style="width:50%;" />
			</p>

			<p class="cl_left">
				<span style="width:160px;display:block;float:left;">&nbsp;</span>
				<input type="submit" name="abmelden" value="abmelden" style="" />
			</p>
	
	</form>
';

}

?>