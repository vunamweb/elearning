<?php
session_start();

include("cms_include.inc");


echo '<div id="content_big" class="text">';

$db = "content"; #$_GET["db"];
$id = "cid";



$dir = opendir ("../bricks_alt");
$arr = array();

while (false !== ($tmp = readdir($dir))) {
	if ($tmp != "." && $tmp != "..") {
#		echo $tmp.' ##<br>';
		$tmp1 = explode("_", $tmp);
		$ct = count($tmp1);

		$new1 = array();

		for($i=1; $i<$ct; $i++) { $new1[] = $tmp1[$i]; }
		$new = "t1__".implode("_", $new1);
#		echo "<br>";

		$arr[$tmp]=$new;
	}
}


$raus = array();
$rein = array();

foreach($arr as $key=>$val) {
	echo $key .' ==== '. $val. "<br>";
	$key = explode(".", $key);
	$key = $key[0];
	$val = explode(".", $val);
	$val = $val[0];
	$raus[] = "/".$key."/";
	$rein[] = $val;
}

// print_r($raus);

$query  = "SELECT * FROM $db";
$result = safe_query($query);
$cnt_arr = array();

while ($row = mysqli_fetch_object($result)) {
	$cnt_arr[] = $row->$id;
}

#print_r($cnt_arr);
# print_r($raus);

foreach($cnt_arr as $val) {
	$query  = "SELECT * FROM $db WHERE $id=$val";
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);

 	$cont = $row->content;
echo	$cont = preg_replace($raus, $rein, $cont);

	$query  = "UPDATE $db SET content='$cont' WHERE $id=$val";
	$result = safe_query($query);
echo "<br><br><br><br>";
}

?>
fertig!
<?
include("footer.php");
?>