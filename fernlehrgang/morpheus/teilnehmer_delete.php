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

$data   = $_POST["data"];
$delete = $_GET["delete"];
$nname 	= $_POST["nname"];
$usr 	= $_POST["usr"];
$id 	= $_POST["id"];

if ($data) {
	$delete = implode("|", $data);
	echo "Sind Sie sich sicher, dass Sie die Teilnehmer l&ouml;schen m&ouml;chten?<p>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"teilnehmer_delete.php?delete=$delete\">Ja</a>
		&nbsp; &nbsp; &nbsp; &nbsp; <a href=\"teilnehmer_delete.php\">Nein</a>";
}
elseif ($delete) {
	$data = explode("|", $delete);
	foreach ($data as $id) {
		if ($id) {
			$query = "delete FROM teilnehmer where id=$id";
			safe_query($query);
		}
	}		
	$delete = 0;
	$id = 0;
}

if (!$delete) getTeilnehmer ($nname, $usr, $id, "Teilnehmer l&ouml;schen");


echo "<p><a href=\"index.php\">" .backlink() ." zur&uuml;ck</a>";

?>

<?
include("footer.php");
?>