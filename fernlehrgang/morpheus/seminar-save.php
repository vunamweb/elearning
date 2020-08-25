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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<head>
		<title>ECONECT Administration</title>
	</head> 

	<link rel="stylesheet" href="../font.css" type="text/css">

<body> 

<?
include("cms_include.inc");

$bereich 	= $_POST["bereich"];
$neu 		= $_POST["neu"];
$lastprior 	= $_POST["lastprior"];	// reihenfolge wird ueber diese var gesteuert
$lastprior 	= $lastprior + 1;
$delete		= $_GET["delete"];
if (!$bereich) $bereich = $_GET["bereich"];

if (!$delete) {
	if ($neu) $save = "";
	else $save = "edit='1',aktiv='0',";

	while (list($key, $value) = each($_POST))
	{	
		if ($key == "start" || $key == "ende") $value = us_dat($value);
		# echo $key ."   -   " .$value ."<br>";
		
		if ($key == "rNrOrg") $rNr = $value;
		//else $save .= $key ."='" .$value ."',";
		elseif ($key != "neu" && $key != "lastprior" && $key != "rf" && $key != "order") $save .= "`".$key."`"."='" .$value ."',";
	}
	$save = substr($save,0,-1);
}

if ($delete) 	{
	$query  = "delete from ec_seminar where rNr=$delete";
	# $query_ = "insert `delete` set descr='Seminar mit rNr: $delete', `query`='$query'";
#	dbconnect();
	safe_query($query);
#	dbconnect_live();
#	safe_query($query);
	# echo $query  = "delete from ec_seminar_detail where rNr=$delete";
	# $query_ = "insert `delete` set descr='Seminar mit rNr: $delete', `query`='$query'";
#	dbconnect();
	# safe_query($query);
#	dbconnect_live();
#	safe_query($query);
}
elseif ($neu) 	$query = "insert ec_seminar set $save, prior='$lastprior'";		
else 			$query = "update ec_seminar set $save where rNr=$rNr";		

safe_query($query);

// nach dem löschen müssen die positionen neu vergeben werden, bei 1 startend
if ($delete) {
	$query 		= "SELECT * FROM ec_seminar where bereich=$bereich order by prior";
	$ergebnis 	= mysqli_query($query)or die(mysqli_error());
	$ct = 0;
	$arr = array();
	
	while ($row = mysqli_fetch_array($ergebnis)) {
		$arr[] = $row["id"];
	}		
	
	for ($i=0; $i<=count($arr); $i++) {
		$id = $arr[$i];
		if ($id) {			
			$ct = $ct + 1;
			$q  = "update ec_seminar set prior='$ct' where id='$id'";
			mysqli_query($q)or die(mysqli_error());
		}

	}
}

echo "<a href='admin-seminar.php?bereich=$bereich'>liste</a>";

echo "<script language='javascript'>\ndocument.location = 'admin-seminar.php?bereich=$bereich'\n</script>";
 
?>
 

</font>
<?
include("footer.php");
?>