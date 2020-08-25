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

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 

echo '<div id=content_big class=text>';

$data = $_POST["data"];

if (!$data) {
	echo '<b>Teilnehmer zur Datenbank hinzuf&uuml;gen</b><p>
	Der Datensatz muss folgende Form haben:<br>
	<font color=#000000>name;vorname;username;passwort</font><p>
	
	<form action="" method="post">
		<textarea cols=50 rows=20 name="data"></textarea><p>
		<input type=submit name="senden" value="Teilnehmer einfügen">
	</form>';
}
else {
	$arr = explode("\n", $data);
	foreach ($arr as $val) {
		if ($val) {
			$dat = explode(";", $val);
			$nm = $dat[0];
			$vn = $dat[1];
			$us = $dat[2];
			$pw = $dat[3];
			$query = "insert teilnehmer set vname='$vn', nname='$nm', usr='$us', pwd='$pw'";						
			$result = safe_query($query);
			echo $vn ." id: " .mysqli_insert_id($mylink) ."<br>";
			
		}
	}	
	echo "&nbsp;<br>Alle Teilnehmer wurden eingetragen<p>
		<a href=\"index.php\">" .ilink() ." ende</a>";
}

?>

<?
include("footer.php");
?>