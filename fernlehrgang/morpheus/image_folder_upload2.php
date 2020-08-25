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

$folder	 = $_REQUEST["folder"];
$id 	 = $_REQUEST["id"];
$from 	 = $_REQUEST["from"];
$setid 	 = $_REQUEST["setid"];
$feld 	 = $_REQUEST["feld"];
$tbl 	 = $_REQUEST["tbl"];


$ordner = "images/".$folder;
$db		= $tbl;
$id		= $id;
$jumpback = $from.'.php';
$tab 	= $imgid;


echo "<div id=content_big class=text>\n\n";
echo $tab;
#die();
if($_FILES) {
	$tmp  = $_FILES['image']['tmp_name'];
	$img  = strtolower(eliminiere($_FILES['image']['name']));

	// echo "../$ordner/".$img;
	if (!move_uploaded_file($tmp, "../$ordner/".$img)) die("upload fehlgeschlagen!");
	chmod("../$ordner/".$img, 0777);

	$sql = "UPDATE $db SET $feld='$img' WHERE $setid='$id'";
	safe_query($sql);

	die("<script language=\"JavaScript\">document.location='".$jumpback."?edit=$id';</script>");
}

else {
	echo "<p><b>Bild Upload</b></p>
		<form method=post enctype=\"multipart/form-data\">\n\n";

	echo '	<input name="image" type="file" style="width:500px"><br>
			<input name="id" type=hidden value="'.$id.'">
			<input name="folder" type=hidden value="'.$folder.'">
			<input name="from" type=hidden value="'.$from.'">
			<input name="setid" type=hidden value="'.$setid.'">
			<input name="feld" type=hidden value="'.$feld.'">
			<input name="tbl" type=hidden value="'.$tbl.'">

			<p><input type=submit style="background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;" value="upload starten" style="width:100px;background-color:#BBBBBB"></p>
	</form>
	';
}


#echo '<p><a href="javascript:history.back();">' .backlink() .' zur&uuml;ck</a></p>';
?>

<?
include("footer.php");
?>
