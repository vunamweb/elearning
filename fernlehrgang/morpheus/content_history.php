<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# www.pixel-dusche.de                               #
# bjoern t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 

include("cms_include.php");

global $history;
$history = '../';

$edit	= $_REQUEST["edit"];
$auswahl	= $_REQUEST["ausw"];
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# formular pull down # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
function pulldown ($cid) {
	$query = "SELECT id, datum, cid FROM content_history WHERE cid=$edit ORDER BY datum";
	$result = safe_query($query);

	while ($row = mysqli_fetch_object($result)) {
		if ($row->id == $id) $sel = "selected";
		else $sel = "";
		
		$nm = $row->vorl_name;		
		$pd .= "<option value=\"" .$row->datum ."\" $sel>$nm</option>\n";
	}
	return $pd;
}

if ($_REQUEST["sprache"]) {
	$sprache = $_REQUEST["sprache"];
	$_SESSION["sprache"] = $sprache;
}
$sprache = $_SESSION["sprache"];

///////////////////////////////////////////////////////////////////////////
if ($_GET["back"]) { $back = $_GET["back"]; $_SESSION["back"] = $back; }
else $back = $_SESSION["back"];
$bck 	= str_replace(array(";;", ";:;"), array("&", "="), $back);
$zuruck = '<a href="navigation.php?'.$bck.'">&laquo; zur&uuml;ck</a>';
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

echo '<div id=vorschau class=text>\n
		<p>
			Histrorie: <strong>'.$titel.'</strong> &nbsp; 
		</p>
	</div>
	<div id=content class=text>
';

$edit	= $_REQUEST["edit"];




#echo '<table style="width:710px; border:1px solid #cococo;">';

$x = 0;
$sql	= "SELECT * FROM content_history WHERE cid=$edit";
$res	= safe_query($sql);
$y		= mysqli_num_rows($res);
while ($row = mysqli_fetch_object($res)) {
	$cid 	= $row->cid;
	$id 	= $row->id;
	$text 	= $row->content;
	$datum 	= $row->datum;
	#$test 	= $row->content;
	#$text	= get_cms_text ($texta, $lang="", "", $video_page="");
	#$text = (get_cms_text($test, $lang, $dir));
	#$text   = get_cms_text($test);
	$get = (get_cms_text($text));
	$tx = explode("##", $text);

	
	if ($x <= $y) $x++;


	
	
	echo '

<OPTION VALUE="anzeige"><a href="content_history.php?ausw='.$id.'">'.$datum.'</a></OPTION>       


';
	}
		
#echo '</table>';
echo '	</SELECT>';	

echo '<hr>';
echo 	  'anzahl der Eintr&auml;ge .....: '.$y;
echo '<br> cid .........................: '.$cid;
echo '<br> letzte id ...................: '.$id;
echo '<br> (id ist fortlaufende Nr. in der Tabelle content_history)';


echo '<hr>';

if ($auswahl){
	
	echo '<table>';
$sql	= "SELECT * FROM content_history WHERE id=$auswahl";
$res	= safe_query($sql);

while ($row = mysqli_fetch_object($res)) {
	$cid 	= $row->cid;
	$id 	= $row->id;
	$text 	= $row->content;
	$datum 	= $row->datum;
	#$test 	= $row->content;
	#$text	= get_cms_text ($texta, $lang="", "", $video_page="");
	#$text = (get_cms_text($test, $lang, $dir));
	#$text   = get_cms_text($test);
	$get = (get_cms_text($text));
	$tx = explode("##", $text);

	
	if ($x <= $y) {
		$x++;
	
	
 echo '<tr><td bgcolor="#f1f0f0">'.$x.'</td><td>'.$id.'</td><td bgcolor="#f1f0f0">'.$cid.'</td><td>'.$datum.'</td><td bgcolor="#f1f0f0" width="500">'.$get.'</td></tr><tr><td colspan="5"><hr></td></tr>';	
	
}
}
}
echo '</table>

</div>';


include("footer.php");
?>