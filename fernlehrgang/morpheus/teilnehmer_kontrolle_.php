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


$query = "SELECT * FROM teilnehmer order by id";
$result = safe_query($query);
while ($row = mysqli_fetch_object($result)) {
	$id = $row->id;
	$nm = $row->vname ." ". $row->nname;
	$us	= $row->usr;
	$pw = $row->pwd;
	if (!isin($id, $pw)) $show .= $id."\t".$nm."\t".$us."\t".trim($pw)."\n";
	
}
	
echo '<form action="" method="post"><textarea cols="100" rows="30" name="import">'.$show.'</textarea>
';


?>

<?
include("footer.php");
?>