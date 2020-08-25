<?php
/*
UploadiFive
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
*/

include("../../nogo/config.php");
include("../../nogo/funktion.inc");
include("../../nogo/db.php");
dbconnect();

// print_r($_POST);
$pgid = $_POST["pgid"];
$reload = $_POST["reload"];

if(!$pgid) exit();

// Set the uplaod directory
// $uploadDir = '/pdf/';

$uploadDir = getDownloadDirectoy ($pgid, "../../"); // '/secure/dfiles/vxcDfgH/';

// Set the allowed file extensions
// 		$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
$imgTypes = array('jpg', 'jpeg', 'png', 'pdf', 'swf', 'ai', 'eps', 'tif', 'tiff', 'psd'); // Allowed file extensions
$docFiles = array("doc", "docx", "xls", "xlsx", "mov", "pdf", "zip", "rar");
$fileTypes = array_merge($imgTypes, $docFiles);

$verifyToken = md5('pixeld' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile   = $_FILES['Filedata']['tmp_name'];
#	$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
#	$uploadDir  = $uploadDir;
	$file 		= $_FILES['Filedata']['name'];
	echo $targetFile = $uploadDir . $_FILES['Filedata']['name'];

	$filesize = filesize($tempFile);
echo	$filetime = date ("Y-m-d", filectime($tempFile));

	// Validate the filetype
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	// print_r($fileParts);
	if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
		if(!move_uploaded_file($tempFile, $targetFile)) echo ":(";

		if (in_array(strtolower($fileParts['extension']), $fileTypes)) setData ($file, $pgid, strtolower($fileParts['extension']), $pfad, $filesize, $reload, $filetime);
		// if (in_array(strtolower($fileParts['extension']), $imgTypes)) include("convert.php");

		echo "finish";
	} else {

		// The file type wasn't allowed
		echo 'Invalid file type.';

	}
}


function setdata ($file ,$pgid, $extension, $pfad, $filesize, $reload, $date) {
		if(!$date) $date = date(Y ."-" .m ."-" .d);
		$reld = '';

		if(!$reload) {
			$sql  = "SELECT pid FROM pdf WHERE pname='$file'";
			$res = safe_query($sql);
			if(mysql_num_rows($res)>0)  $reld = 1;
		}

		if ($reload) 	$sql = "UPDATE pdf set pname='$file', pdate='$date', psize='$filesize', edit=1 WHERE pid=$reload";
		elseif ($reld) 	$sql = "UPDATE pdf set pdate='$date', psize='$filesize', edit=1 WHERE pname='$file'";
		else 			$sql = "INSERT pdf SET pname='$file', pdate='$date', psize='$filesize', pgid=$pgid";

//		$sql = "INSERT pdf SET pname='$file', pdate='$date', psize='$filesize', pgid=$pgid";
		safe_query($sql);
}

?>