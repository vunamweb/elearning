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

include("cms_header.php");
include("funktion.php");
include("cms_navigation.php");
include("db.php");
include("db_live.php");
dbconnect_live();

echo '<div id=content_big class=text>';


$query = "SELECT * FROM teilnehmer order by id";
$result = safe_query($query);
while ($row = mysqli_fetch_object($result)) {
	$id = $row->id;
	$nm = $row->nname .", ". $row->vname;
	$us	= $row->usr;
	$pw = $row->pwd;
	
	$show = $id."\t".$nm."\t".$us."\t".trim($pw)."\t";
	
	$que = "SELECT * FROM projekt_user where user=$id";
	$res = safe_query($que);
	while ($rw = mysqli_fetch_object($res)) {
		$show .= trim($rw->projekt) ."\t";
	}
	$tmp .= repl("\n", "", $show) ."\n";
}
	
echo '<form action="" method="post"><textarea cols="100" rows="30" name="import">'.$tmp.'</textarea>
	<p><input type="submit" name="senden" value="senden"></p>';


?>

<?
include("footer.php");
?>