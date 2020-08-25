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

include("../nogo/config.php");

include("cms_header.php");
include("../nogo/db.php");
dbconnect();

include("funktion.inc");
include("cms_navigation.php");

# navid auslesen. welcher navid wird content zugeordnet
$navid  = $_REQUEST["navid"];
$stelle = $_REQUEST["stelle"];
$content= $_REQUEST["content"];
$del	= $_REQUEST["del"];
$save	= $_REQUEST["save"];
$ebene  = $_REQUEST["ebene"];  if (!$ebene)  $ebene = 1;
$parent = $_REQUEST["parent"]; if (!$parent) $parent = 0;

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# save
if ($save) {
	$cont_arr  = array();
	$x = 1;
	
	foreach($_POST as $key=>$val) {
		#echo "$key - $val<br>";
		$chk = explode("_", $key);
		if ($chk[0] == "block") {
			if ($stelle == $x && $content) $cont_arr[]  = $content;			
			$cont_arr[]  = $val;
			$x++;
		}
	}
	if ($stelle == $x && $content) $cont_arr[]  = $content;			

	for($i=0; $i<count($cont_arr); $i++) {
		$cid   = $cont_arr[$i];

		// tabelle cont_select updaten/save
		$query  = "SELECT * FROM cont_select where cid=$cid and navid=$navid";
		$result = safe_query($query);
		$x = mysqli_num_rows($result);
		if ($x > 0) $query = "update ";
		else $query = "insert ";
		$query .= "cont_select set cid=$cid, navid=$navid, edit=1, `sort`=" .($i+1);
		if ($x > 0) $query .= " where cid=$cid and navid=$navid";
		$result = safe_query($query);
		if ($x > 0) protokoll($uid, "cont_select", $cid, "edit");
		else {
			$c = mysqli_insert_id($mylink);
			protokoll($uid, "cont_select", $c, "neu");
		}
	}	
}
elseif ($del) {
	$query = "delete from cont_select where navid=$navid and cid=$del";
	$result = safe_query($query);
	protokoll($uid, "cont_select", $del, "del");
}
# _save
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# select mit den contents zusammenstellen
if (!$cont_arr) {
	$query = "SELECT * FROM cont_select where navid=$navid";
	$result = safe_query($query);
	while ($row=mysqli_fetch_object($result)) {
		$cont_arr[] = $row->cid;
	}
}
if (!$cont_arr) $cont_arr= array();

$query  = "SELECT * FROM content order by descr";
$result = safe_query($query);
$select_content = select("content", "width:380px") .option('', "Bitte Content wählen");
while($row = mysqli_fetch_object($result)) {
	$id 	= $row->cid;
	if (!in_array($id, $cont_arr)) {
		$text 	= $row->descr;
		$text  .= $row->text;
		$text 	= get_text($text);
		$text 	= substr($text, 0, 60) ."...";
		$select_content .= option($id, $text);
	}
}
$select_content .= "</select>\n\n";
# _select
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

echo "<div id=content class=text>\n<p><b>Content einer Seite/Link zuordnen</b></p>
<form action=\"nav_content.php?log=$log\" method=post>
<input type=hidden value=1 name=save>
<input type=hidden value=$ebene name=ebene>
<input type=hidden value=$parent name=parent>
<input type=hidden value=$navid name=navid>";

$query  = "SELECT * FROM cont_select cs, content c where cs.navid=$navid and cs.cid=c.cid order by cs.sort";
$result = safe_query($query);
$x = 0;
unset($text);

$link = "ebene=$ebene&parent=$parent";

while($row = mysqli_fetch_object($result)) {
	$id = $row->cid;
	$nm = $row->descr;
	
	$tx = $row->text;
	$tx = get_text($tx);
	
	if ($nm) {
		$x++;
		$text .= "Textblock $x: <b>$nm</b> &nbsp; &nbsp; <a href=\"nav_content.php?$link&del=$id&navid=$navid\">" .ilink() ." löschen</a><input type=hidden value=$id name=\"block_" .$x ."\"><hr width=500 size=1 align=left>";
		$text .= "<p>$tx</p>";
	}
}

$x++;
$select_stelle  = select("stelle", "width:40px") .option($x, $x);
for($i=1; $i<$x; $i++) {
	$select_stelle .= option($i, $i);
}
$select_stelle .= "</select>\n\n";	

echo $select_content ." " . $select_stelle ."<input type=submit style=\"background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;\" name=erstellen value=einfügen style=\"width:56;background-color:#BBBBBB;\">";

echo "<p>$text</p>";

echo "<p><a href=\"navigation.php?$link\" title=\"zurück\">" .backlink() ." zurück</a></p>";
?>

</form>
</div>

</body>
</html>
