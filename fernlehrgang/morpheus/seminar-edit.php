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


# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# formular pull down # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
function pulldown ($tp, $db, $wname, $wid, $mf=0) {
	if ($db == "termin_liste") 
		$query = "SELECT * FROM $db tl, termin_abt ta WHERE ta.taid=tl.taid ORDER BY ta.abt, $wname";
	elseif ($db == "pdf") 
		$query = "SELECT * FROM $db p, pdf_group pg WHERE p.pgid=pg.pgid ORDER BY pg.pgname, $wname";
	else 
		$query = "SELECT * FROM $db ORDER BY $wname";

	$result = safe_query($query);

	while ($row = mysqli_fetch_object($result)) {
		if ($row->$wid == $tp) $sel = "selected";
		else $sel = "";
		
		$nm = $row->$wname;
		
		if ($db == "termin_liste") 	$nm = $row->abt ." - $nm";
		elseif ($db == "pdf") 		$nm = $row->pgname ." - $nm";
		$pd .= "<option value=\"" .$row->$wid ."\" $sel>$nm</option>\n";
	}
	return $pd;
}

function get_pdf($id) {
	// dbconnect_live();
	$query = "SELECT * FROM pdf WHERE pid=$id";
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
	return $row->pname;	
	dbconnect();
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 

include("cms_include.inc");

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 


$pdfdel = $_GET["pdfdel"];
$delid  = $_GET["delid"];
if ($pdfdel) {
	$sql = "UPDATE ec_seminar SET pdf".$pdfdel." = '' WHERE id=".$delid;
	safe_query($sql);
}

$order 		= $_GET["order"];
$rf  		= $_GET["rf"];
if($order) 	$_SESSION["order"] = $order;
if($rf) 	$_SESSION["rf"] = $rf;
if(!$order) $order = $_SESSION["order"];
if(!$rf) 	$rf = $_SESSION["rf"];
if(!$order) $order = "rNr";
if(!$rf) 	$rf = "DESC";



echo '<div id=vorschau class=text><script type="text/javascript">
<!--
function chkFormular()
  {
   	document.edit.bereich.value = document.edit.rNr.value.charAt(0);
   	document.edit.rWert.value = document.edit.rNr.value.charAt(0)+document.edit.rNr.value.charAt(4)+document.edit.rNr.value.charAt(5);
  }

//-->
</script>';
?>

<form action="seminar-save.php" method="post" name="edit">

<p>&nbsp;</p><p>&nbsp;</p>

<table cellpadding=5 cellspacing=4 border=0 class=text>
	<tr>
		<td>RechNr</td>
		<td>Datum Start</td>
		<td>Datum Ende</td>
		<td>Aktiv/Sichtbar</td>
	</tr>
		

<?php
$neu 		= $_GET["new"];
$rNr 		= $_GET["bearbeiten"];
$bereich 	= $_REQUEST["bereich"];
$pdf	 	= $_REQUEST["pdf"];
$pfad	 	= $_REQUEST["pfad"];
$pfad	 	= str_replace("pdf/", "", $pfad);
//$pfad	 	= $pfad[1];
$lastprior 	= $_GET["lastprior"];
$feld		= $_GET["feld"];

if ($pdf && $feld) {
	if ($pfad) $pdf = $pfad ."/" .$pdf;
	$query 		= "update ec_seminar set $feld='$pdf' where rNr=$rNr";		
	$ergebnis 	= safe_query($query);
}

if ($neu == 1) $ergebnis = 1;
else {
	$sql 		= "SELECT * FROM ec_seminar WHERE rNr=$rNr";
	$ergebnis 	= safe_query($sql);
}

if ($ergebnis) {
	if ($neu == 1) $row = "";
	else $row = mysqli_fetch_array($ergebnis);	

	$start = euro_dat($row['start']);
	$ende  = euro_dat($row['ende']);
	
	echo "<tr>
			<td valign=top><input type=hidden name='neu' value=$neu>
				<input type=hidden name='lastprior' value='$lastprior'>
				<input type=hidden name='rf' value='$rf'>
				<input type=hidden name='order' value='$order'>
				<input type=hidden name='bereich' value='$bereich'>
				<input type=hidden name='rNrOrg' value='" .$row['rNr'] ."'>
				<input type=hidden name='rWert' value='" .$row['rWert'] ."'>
				<input type=Text name='rNr' size=7 value='" .$row['rNr'] ."' onBlur=\"return chkFormular()\"></td>
			<td valign=top><input type=Text name='start' size=10 value='$start'></td>
			<td valign=top><input type=Text name='ende' size=10 value='$ende'></td>
			<td align=middle valign=top>";
			
	if ($row['aktiv'] == "on" || $row['aktiv'] == "1") echo "<input type=Checkbox name='aktiv' checked>";
	else echo "<input type=Checkbox name='aktiv'>";
	
	echo "</td>
		</tr>
		<tr>
			<td colspan=6><p>&nbsp;</p>"
			.liste_orte($row['ort'], "ort") ."<p>
			<textarea name='beschreibung' rows=5 cols=60>" .$row['beschreibung'] ."</textarea></td>
		</tr>";
}
	
	echo "<tr>
			<td colspan=3><a href=\"pdf_dir.php?feld=pdf&bereich=$bereich&rWert=" .$row['rWert'] ."&bearbeiten=" .$row['rNr'] ."\">" .ilink() ." wähle PDF</a></td>
			<td colspan=3><a href=\"pdf_dir.php?feld=pdf2&bereich=$bereich&rWert=" .$row['rWert'] ."&bearbeiten=" .$row['rNr'] ."\">" .ilink() ." wähle ICS</a></td>
		</tr>
	";
	echo '<tr>
			<td colspan=3><a href="?pdfdel=1&delid='.$row['id'].'&bereich='.$row['bereich'].'&rWert='.$row['rWert'].'&bearbeiten='.$row['rNr'].'&rf='.$rf.'&order='.$order.'"><img src="images/delete.gif" alt="" width="9" height="10" border="0"> &nbsp; &nbsp; </a>' .$row['pdf'] .'</td>
			<td colspan=3><a href="?pdfdel=2&delid='.$row['id'].'&bereich='.$row['bereich'].'&rWert='.$row['rWert'].'&bearbeiten='.$row['rNr'].'&rf='.$rf.'&order='.$order.'"><img src="images/delete.gif" alt="" width="9" height="10" border="0"> &nbsp; &nbsp; </a>' .$row['pdf2'] .'</td>
		</tr>
	';

?>
 
 </table>
 
&nbsp;<p><input type="Submit" value="datensatz speichern">
 
 <p>&nbsp;</p>
</font>

</div>
<?php
include("footer.php");
?>