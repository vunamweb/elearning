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

echo '<script type="text/javascript">
<!--
function chkFormular()
  {
    	document.edit.name.value = document.edit.pdf_liste.value;
  }

//-->
</script>';

$newdata = $_REQUEST["new"];
$bereich = $_REQUEST["bereich"];
$pdf	 = $_REQUEST["pdf"];
$pfad	 = $_REQUEST["pfad"];
$pfad	 = explode("/", $pfad);
$pfad	 = $pfad[1];
if ($pdf && $pfad) $pdf = $pfad ."/" .$pdf;

if (!$newdata) {
	$id 		= $_REQUEST["bearbeiten"];
	if (!$id) 	$id	= $_REQUEST["id"];
	if ($id) {
		$sql 		= "SELECT * FROM ec_dokumente where id=$id";
		$ergebnis 	= mysqli_query($sql) or die(mysqli_error());
	}
}

echo '<div id=content_big class=text><a href="admin-download.php?bereich=' .$bereich .'">' .backlink() .' zur&uuml;ck zur &uuml;bersicht</a><p>
<form action="download-save.php" method="post" name="edit">';

if ($ergebnis) {
	$row = mysqli_fetch_array($ergebnis);	
	$id 	  = $row['id'];
	$aktiv 	  = $row['aktiv'];
	$newdok   = $row['neu'];
	$name 	  = $_GET["name"];
	$bereich  = $row['bereich'];
	$headline = $row['headline'];
	if ($pdf) $name = $pdf;
	elseif (empty($name)) $name = $row['name'];	
}	

if (!$headline) $headline = "Bitte zuerst die Überschrift vergeben und speichern";
echo '<table>
	<tr>
		<td width="500">'."<input type=hidden name='newdata' value=$newdata>
			<input type=hidden name='id' value='$id'>
		fachbereich <img src=\"images/leer.gif\" width=110 height=1> dokumenten-name<br><input type=text name='bereich' value='$bereich'>
		<img src=\"images/leer.gif\" width=44 height=1>";

if ($id) echo '<input type=text name="name" value="'.$name.'">'." &nbsp; <a href=upload.php?id=$id&bereich=$bereich&new=$new>" .ilink() ." upload pdf</a> &nbsp; <a href=pdf_dir.php?id=$id&bereich=$bereich&new=$new>" .ilink() ." wähle pdf</a>";

echo "<p>überschrift<br>"
			.'<input type=tex name="headline" value="'.$headline.'">'."<p>			
		beschreibung<br>
			<textarea name='text' rows=5 cols=60>" .$row['text'] ."</textarea><p>			
		dokumenten-gr&ouml;&szlig;e<br>"
			.'<input type=text name="size" value="'.$row['size'].'">'."<p>
		art des dokumentes<br>[antrag, skript, leseprobe, klausur,...]<br>"
			.'<input type=text name="art" value="'.$row['art'].'">'."<br>";
	
	if ($newdok == "2") echo "<p><input type=Checkbox name=neu> Im Internet mit <b>NEU</b> kennzeichnen";
	else echo "<p><input type=Checkbox name=neu checked> Im Internet mit <b>NEU</b> kennzeichnen";

	if ($aktiv == "2") echo "<p><input type=Checkbox name=aktiv> <b>aktiv</b> ";
	else echo "<p><input type=Checkbox name=aktiv checked> <b>aktiv</b> ";

echo '</td>
	</tr>

 </table>
 
<input type="Submit" value="datensatz speichern"> &nbsp; &nbsp; ';

if ($pdf) echo "<font color=#ff0000><b>Bitte Speichern!!!</b></font>";
 
?>

<p><b>Änderungen werden auf dem Redaktions- und Liverserver vorgenommen!</b></p>

</div>
</font>
<?
include("footer.php");
?>