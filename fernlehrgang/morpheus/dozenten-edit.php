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

$neu 	 = $_REQUEST["new"];
$bereich = $_REQUEST["bereich"];

echo '<script type="text/javascript">
<!--
function chkFormular()
  {
   	document.edit.ort.value = document.edit.rNr.value.charAt(1);
   	document.edit.bereich.value = document.edit.rNr.value.charAt(0);
   	document.edit.rWert.value = document.edit.rNr.value.charAt(4)+document.edit.rNr.value.charAt(5);
  }

//-->
</script>

<form action="dozenten-save.php" method="post" name="edit">

<div id=content_big class=text><a href="admin-dozenten.php?bereich=' .$bereich .'">' .backlink() .' zurück</a><table cellpadding=5 cellspacing=0 border=0 class=text>';


if ($neu == 1) {
	$sql 		= "SELECT * FROM ec_dozenten order by dozentID";
	$ergebnis 	= safe_query($sql);
	
	while ($row = mysqli_fetch_array($ergebnis))	$lastID = $row["dozentID"];	
	
	$lastID 	= $lastID + 1;
	$ergebnis 	= 1;
}
else {
	$id 		= $_REQUEST["bearbeiten"];
	$sql 		= "SELECT * FROM ec_dozenten where dozentID=$id";
	$ergebnis 	= safe_query($sql);
}

if ($ergebnis) {

	if ($neu == 1) $row = "";
	else $row = mysqli_fetch_array($ergebnis);	
	
	echo "<tr>
		<td valign=top><input type=hidden name='neu' value=$neu><input type=hidden name='bereich' value=$bereich>";
	
	if ($neu == 1) 	echo "<input type=hidden name='dozentID' size=5 value='$lastID'></td>\n";
	else 			echo "<input type=hidden name='dozentID' size=5 value='" .$row['dozentID'] ."'></td>\n";
	$aktiv 	  = $row['aktiv'];
	
	echo "\n\t<td>
		<table>
			<tr>
				<td width=90>anrede</td><td><input type=Text name='anrede' size=60 value='" .$row['anrede'] ."'></td>
			</tr>
			<tr>
				<td>titel 1</td><td><input type=Text name='titel1' size=60 value='" .$row['titel1'] ."'></td>
			</tr>
			<tr>
				<td>titel 2</td><td><input type=Text name='titel2' size=60 value='" .$row['titel2'] ."'></td>
			</tr>
			<tr>
				<td>vorname</td><td><input type=Text name='vorname' size=60 value='" .$row['vorname'] ."'></td>
			</tr>
			<tr>
				<td>name</td><td><input type=Text name='name' size=60 value='" .$row['name'] ."'></td>
			</tr>
			<tr>
				<td valign=top>beschreibung</td><td><textarea name='text' rows=5 cols=60>" .repl("<br>", "\n", $row['text']) ."</textarea></td>
			</tr>
			<tr>
				<td colspan=2>";
		
		if ($aktiv == "2") echo "<p><b>aktiv</b> <input type=Checkbox name=aktiv>";
		else echo "<p><b>aktiv</b> <input type=Checkbox name=aktiv checked>";
		
	echo "</td>
			</tr>
			</table>
				<td></td>\n</tr>";
}
 
echo '</table>
'; 

if ($ergebnis && $id) {
	echo "<div>\n";
	$df_arr = array();
	
	$query = "SELECT * FROM ec_doz_fb where dozentID=$id AND aktiv=1";
	$result = safe_query($query);

	while ($row = mysqli_fetch_object($result)) {
		$id = $row->fbid;
		$ak = $row->aktiv;
		if ($ak === "1") $df_arr[] = $id;
	}
		
	$query = "SELECT * FROM ec_rechnungnr r, ec_fachbereiche f WHERE r.rWert=f.rWert order by f.rWert, f.fb";
	$result = safe_query($query);
	$tmp = "";
	
	while ($row = mysqli_fetch_object($result)) {
		$fb 	= $row->fb;
		$art 	= $row->art;
		$rw 	= $row->rWert;
		$fbid	= $row->fbid;
		if (in_array($fbid, $df_arr)) $checked = "checked";
		else unset ($checked);
		
		if ($tmp != $art) { echo "</div>\n\n".'<div style="float:left; width: 120px;"><p style="color:#FF0000;">'."<b>$art</b></p>\n"; $tmp = $art; }
		
		echo "<p><input type=\"checkbox\" name=\"fbid-$fbid\" value=\"$fbid\" $checked> $fb $fbid</p>\n";
	}
	
	echo "</div>\n";
}

?>

<p style="clear:left;">&nbsp;</p><p><input type="Submit" value="datensatz speichern" style="border: solid 1px #7B1B1B;color:#7B1B1B;"></p>
<p><b>Änderungen werden auf dem Redaktions- und Liverserver vorgenommen!</b></p>

</form>
</div>

</font>
<?
include("footer.php");
?>