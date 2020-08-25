<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

include("cms_include.inc");

$arr = array( 4=>"Kein Zugang Morpheus", 2=>"Redakteur", 1=>"Administrator");

$uid	= $_REQUEST["uid"];
$neu	= $_REQUEST["neu"];
$save	= $_REQUEST["save"];
$unm	= $_REQUEST["unm"];
$pwd	= $_REQUEST["pwd"];
$adm	= $_REQUEST["adm"];
$ber	= $_REQUEST["ber"];
$newpass= $_REQUEST["newpass"];

echo "<div id=content_big>";

if ($save) {
	$ct = count($arr);

	$pwd = md5($pwd);
	$set .= "uname='$unm'".($neu || $newpass ? ", pw='$pwd'" : '').", admin='$adm', berechtigung='$ber'";

	if ($neu) 	$query = "insert user ";
	else 		$query = "update user ";

	$query .= "set " .$set;

	if (!$neu) $query .= " WHERE uid=$uid";
	safe_query($query);

	unset($neu);
	unset($uid);
}

if ($uid || $neu) {
	echo "<p><b>Verwaltung User</b></p>";

	if (!$neu) {
		$query  = "SELECT * FROM user where uid=$uid";
		$result = safe_query($query);
		$row 	= mysql_fetch_object($result);
	}

	foreach ($arr as $val) {
		if ($row->$val == 1) $$val = "checked";
	}

	$admin = $row->admin || $row->berechtigung == 1 ? " checked" : '';
	$bere = $neu ? " checked" : '';

	echo '<p><a href="user.php">' .backlink().' zur&uuml;ck</a></p><p>&nbsp;</p>';
	echo '<form method="post">
		<input type="hidden" name="neu" value="'.$neu.'">
		<input type="hidden" name="uid" value="'.$uid.'">
		<input type="hidden" name="save" value="1">
		<p><span style="display:block; float:left; width:140px;">Name</span><input type="text" name="unm" value="'.$row->uname.'" style="width:200px;height:21px;"></p>
		<p><span style="display:block; float:left; width:140px;">Passwort</span><input type="text" name="pwd" value="'.$row->pw.'" style="width:200px;height:21px;"></p>
		<p><span style="display:block; float:left; width:140px;">&nbsp;</span><input type="checkbox" name="newpass" value="1" style="border: 0;" '.$bere .'> <b>Passwort speichern</b></p>
		<p><span style="display:block; float:left; width:140px;">Berechtigung</span><select name="ber" style="width:160px;height:21px;">';

	foreach ($arr as $key=>$val) {
		if ($key == $row->berechtigung) $sel = " selected";
		else 							$sel = "";
		echo '<option value="'.$key.'"'.$sel.'>'.$val.'</option>';
	}

	echo '</select></p>
		<p>&nbsp;</p>
		<p><input type="submit" class="button" name="speichern" value="speichern"></p>
		<p>&nbsp;</p>
		<br><img src="images/leer.gif" alt="" width="1" height="1" border="0"><br>
		<p><input type="checkbox" name="adm" value="1" style="border: 0;" '.$admin .'> Administrator</p>
		<!-- <p><input type="checkbox" name="news" value="1" style="border: 0;" '.$news .'> <b>Newsletter</b> erstellen</p>
		<p><input type="checkbox" name="live" value="1" style="border: 0;" '.$live .'> darf <b>veröffentlichen</b></p> -->
		<br><img src="images/leer.gif" alt="" width="1" height="1" border="0"><br>
';
}

elseif ($admin) {
	echo "<p><b>Liste berechtigter Mitarbeiter f&uuml;r CMS</b></p><p>&nbsp;</p>";

	$query  = "SELECT * FROM user WHERE uname != 'morpheus' order by uname";
	$result = safe_query($query);
	$ct 	= mysql_num_rows($result);
	$change = $ct / 3;

	while ($row = mysql_fetch_object($result)) {
		$c++;
		if ($c == 1) {echo '<div style="float:left; width:160px;">'; $xx++; }
		echo '<p><a href="user.php?uid='.$row->uid.'">' .ilink().' '.$row->uname.'</a></p>';
		if ($c > $change) { echo "</div>"; $c = 0; $x++;}
	}
	if ($x < $xx) echo "</div>";
	echo '<div style="clear:left;"><p>&nbsp;</p>
		<p><a href="user.php?neu=1">' .ilink().' <b>NEU</b></a></p></div>';
}

else die('<p><strong>Keine Berechtigung</strong></p>');
?>

</div>

<?
include("footer.php");
?>