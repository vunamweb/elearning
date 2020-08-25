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

$oid 	 = $_REQUEST["oid"];
$cust 	 = $_REQUEST["cust"];

$mid 	 = $_REQUEST["mid"];
$wdid 	 = $_REQUEST["wdid"];
$wid 	 = $_REQUEST["wid"];
$pid 	 = $_REQUEST["pid"];

$nid 	 = $_REQUEST["nid"];
$ngid 	 = $_REQUEST["ngid"];
$imgid 	 = $_REQUEST["imgid"];
$news	 = $_REQUEST["news"];

$cedit	= $_REQUEST["cedit"];
$navid	= $_REQUEST["navid"];

# wenn diese parameter per GET uebergeben werden, sollen die images konvertiert werden
$tn 	 = $_REQUEST["tn"];
$full 	 = $_REQUEST["full"];

$folder	 = $_REQUEST["folder"];
$id 	 = $_REQUEST["id"];
$from 	 = $_REQUEST["from"];
$setid 	 = $_REQUEST["setid"];
$tbl 	 = $_REQUEST["tbl"];

$tab 	 = "foto";


// id='.$edit.'&imgid='.$arr[0].'&folder='.$imgfolder.'&from='.$scriptname.'&setid='.$id.'

# ziel-ordner und db bestimmen
if ($folder) {
	$ordner = "images/".$folder;
	$db		= $tbl;
	$cedit	= $id;
	$jumpback = $from.'.php';
	$tab = $imgid;
}
elseif ($navid) {
	$ordner = "images/backg";
	$db		= "content";
	$setid  = "cid";
	$tab 	= "timage";
}
elseif ($wid) {
	if($imgid == "pdf") $ordner = "pdf";
	else  $ordner = "images/produkt";
	$db		= "morp_shop_wg";
	$setid  = "wid";
	$cedit	= $wid;
	$jumpback = 'morp_shop_wg.php';
	$tab = $imgid;
}
elseif ($pid) {
	$ordner = "images/artikel";
	$db		= "morp_produkt";
	$setid  = "pid";
	$cedit	= $pid;
	$jumpback = 'morp_produkt.php';
	$tab = $imgid;
}
elseif ($news) 	{
	$ordner = "images/presse";
	$db		= "news";
	$setid  = "nid";
	$cedit	= $nid;
	$tab = $imgid;
}
elseif ($oid) 	{
	$ordner = "images/objekte";
	$db		= "morp_immo_objekt";
	$setid  = "oid";
	$cedit	= $oid;
	$jumpback = "morp_immo_objekt.php";
}
elseif ($cust) 	{
	$ordner = "secure/dfiles/HgtFGDkjg/";
	$db		= "morp_download";
	$setid  = "benutzer";
	$imgid 	= "datei";
	$jumpback = "customer_kat.php";
}
elseif ($mid) 	{
	$ordner = "images/team";
	$db		= "morp_mitarbeiter";
	$setid  = "mid";
	$cedit	= $mid;
	$jumpback = "morp_mitarbeiter.php";
}
else 	{
	$ordner = "images/aktuell";
	$db		= "news";
}

echo "<div id=content_big class=text>\n\n";
echo $tab;
#die();
if($_FILES) {
	$tmp  = $_FILES['image']['tmp_name'];
	$img  = strtolower(eliminiere($_FILES['image']['name']));

	if ($new) 	{   // wird bei peakom nicht mehr verwendet
		konvert_image ($tmp, $img, $full, "../".$ordner."/");
		konvert_image ($tmp, $img, $tn, "../".$ordner."/tn/");
		$img = substr($img,0,-4).".jpg"; // z.zt. keine png transformierung - werden in jpg gewandelt
	}

	else	{
		if (!move_uploaded_file($tmp, "../$ordner/".$img)) die("upload fehlgeschlagen!");
		chmod("../$ordner/".$img, 0777);
	}

	if ($cust)	$query = "INSERT $db set $imgid='$img', benutzer='$cust'";
	elseif ($db)	$query = "update $db set $tab='$img' where $setid='$cedit'";

//	echo $query;
//	die();

	if ($query) {
		//$result = safe_query($query);
		safe_query($query);
		#unlink($tmp);
	}

	# rueckspruenge zu den ausgangs-tools
	if ($news) 				die("<script language=\"JavaScript\">document.location='news.php?edit=$nid&ngid=$ngid';</script>");
	elseif ($navid)			die("<script language=\"JavaScript\">document.location='content_template.php?edit=$cedit&navid=$navid';</script>");
	else					die("<script language=\"JavaScript\">document.location='".$jumpback."?edit=$cedit';</script>");
}

else {
	echo "<p><b>Bild Upload</b></p>
		<form method=post enctype=\"multipart/form-data\">\n\n";

	echo '	<input name="image" type="file" style="width:500px"><br>
			<input name=ngid type=hidden value='.$ngid.'>
			<input name=wdid type=hidden value='.$wdid.'>
			<input name=wid type=hidden value='.$wid.'>
			<input name=cedit type=hidden value='.$cedit.'>
			<input name=oid type=hidden value='.$oid.'>
			<input name=cust type=hidden value='.$cust.'>
			<input name=nid type=hidden value='.$nid.'>
			<input name=navid type=hidden value='.$navid.'>
			<input name=news type=hidden value='.$news.'>
			<input name=tn type=hidden value='.$tn.'>
			<input name=full type=hidden value='.$full.'>
			<input name=imgid type=hidden value='.$imgid.'>
			<p><input type=submit style="background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;" value="upload starten" style="width:100px;background-color:#BBBBBB"></p>
	</form>
	';
}

#echo '<p><a href="javascript:history.back();">' .backlink() .' zur&uuml;ck</a></p>';
?>

<?
include("footer.php");
?>
