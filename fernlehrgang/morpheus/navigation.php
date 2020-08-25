<?php
session_start();

# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# bj&ouml;rn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

# $sess = print_r($_SESSION,1);

global $sprache;

#if (!session_is_registered('sprache')) 	session_register('sprache');

if ($_REQUEST["sprache"]) {
	$sprache = $_REQUEST["sprache"];
	$_SESSION["sprache"] = $sprache;
}
$sprache = $_SESSION["sprache"];
if (!$sprache) $sprache = "1";

include("cms_include.inc");

# welche ebene und welche subnav wurde ausgewaehlt
$ebene 		= 1;
$parent 	= 0;
$lan_arr 	= $morpheus["lan_arr"];

# print_r($_REQUEST);

foreach($_REQUEST as $key=>$val) {
	$arr = explode("_", $key);

	if ($arr[0] == "p") $parent = $val;		// hier wird der hoechste p(arent)-wert ermittelt

	if ($key == "ebene") $ebene = $val;

	elseif ($arr[0] == "p") {
		$nav  .= "&p_" .$arr[1] ."=" .$val;
		$n_arr[] = $val;
	}

	elseif ($arr[0] == "n") {
		$hist .= "&n_" .$arr[1] ."=" .$val;
		$h_arr[] = $val;
	}
}

if (!$nav) {
	$nav	= "p_0=0";
	$hist	= "n_0=Hauptnavigation";	// history
	$h_arr	= array("Hauptnavigation");
	$n_arr 	= array("0");
}

# print_r($h_arr);
$link   = "navigation.php";

# positionsaenderung
$sortid  = $_REQUEST["sortid"];
$sort 	 = $_REQUEST["sort"];
$az 	 = $_REQUEST["az"];
$gruppe	 = $_REQUEST["gruppe"];


$unvis	 = $_REQUEST["unvis"];
$vis	 = $_REQUEST["vis"];
#
$del 	 = $_REQUEST["del"];
$delete	 = $_REQUEST["delete"];

# hole eine ordnerstruktur auf diese ebene!!! :-) legga feature
$ordnerget	 = $_REQUEST["ordnerget"];

if ($ordnerget) {
	$this_ebene 	= $ebene;
	$this_parent 	= $parent;
	$next_eb1 		= ($ebene+1);
	$next_eb2 		= ($ebene+2);
	$next_eb3 		= ($ebene+3);
	$next_eb4 		= ($ebene+4);

	$sql = "update nav set parent=$this_parent, ebene=$this_ebene, edit=1 WHERE navid=$ordnerget";
	$res = safe_query($sql);

	$tmp_arr = array();
	$query  = "SELECT * FROM nav where parent=$ordnerget";
	$result = safe_query($query);

	while ($row = mysqli_fetch_object($result)) {
		$id = $row->navid;
		$row->parent;
		$row->ebene;
		$tmp_arr[] = $id;
		$sql = "update nav set ebene=$next_eb1, edit=1 WHERE navid=$id";
		$res = safe_query($sql);
	}

	if ($tmp_arr) {
		$tmp_arr2 = array();
		foreach($tmp_arr as $val) {
			$query  = "SELECT * FROM nav where parent=$val";
			$result = safe_query($query);
			while ($row = mysqli_fetch_object($result)) {
				$id = $row->navid;
				$tmp_arr2[] = $id;
				$sql = "update nav set ebene=$next_eb2, edit=1 WHERE navid=$id";
				$res = safe_query($sql);
			}
		}
	}

	if ($tmp_arr2) {
		$tmp_arr3 = array();
		foreach($tmp_arr2 as $val) {
			$query  = "SELECT * FROM nav where parent=$val";
			$result = safe_query($query);
			while ($row = mysqli_fetch_object($result)) {
				$id = $row->navid;
				$tmp_arr3[] = $id;
				$sql = "update nav set ebene=$next_eb3, edit=1 WHERE navid=$id";
				$res = safe_query($sql);
			}
		}
	}

	if ($tmp_arr3) {
		foreach($tmp_arr3 as $val) {
			$query  = "SELECT * FROM nav where parent=$val";
			$result = safe_query($query);
			while ($row = mysqli_fetch_object($result)) {
				$id = $row->navid;
				$sql = "update nav set ebene=$next_eb4, edit=1 WHERE navid=$id";
				$res = safe_query($sql);
			}
		}
	}

	# include("set_nav.php");
	echo "<p>&nbsp;</p>";
}

elseif ($vis || $unvis) {
	if($vis) $sql = "UPDATE nav set sichtbar=1 WHERE navid=".$vis;
	elseif($unvis) $sql = "UPDATE nav set sichtbar=0 WHERE navid=".$unvis;
	echo $sql;
	safe_query($sql);
}

elseif ($_REQUEST["repair"]) {
	$arr 		= array();
	$ebene 		= $_REQUEST["ebene"];
	$parent	 	= $_REQUEST["parent"];
	$xx 		= 0;

	if($az) $sql  		= "SELECT * FROM nav WHERE ebene=$ebene AND parent=$parent AND lang=$sprache order by name";
	else	$sql  		= "SELECT * FROM nav WHERE ebene=$ebene AND parent=$parent AND lang=$sprache order by sort";
	$res 		= safe_query($sql);

	while ($rw = mysqli_fetch_object($res)) $arr[] = $rw->navid;

	foreach ($arr as $val) {
		$xx++;
		$sql  = "update nav set sort = $xx where navid=$val";
		$res = safe_query($sql);
	}

	$back	= $_REQUEST["back"];
	$bck 	= str_replace(array(";;", ";:;"), array("&", "="), $back);

}
# echo "ebene: $ebene<br>parent: $parent<br>";

# wenn sortierung geaendert wurde, jetzt in db schreiben
elseif ($sort) {
	$ebene 	 = $_REQUEST["ebene"];
	$parent	 = $_REQUEST["parent"];

	if ($sort == "up") $s2 = $sortid - 1;
	else $s2 = $sortid + 1;

	$sort_    = array($sortid, $s2);
	$sort_new = array($s2, $sortid);
	$sort_arr = array();

	for($i=0; $i<=1; $i++) {
		$query  = "SELECT * FROM nav WHERE ebene=$ebene AND parent=$parent AND lang=$sprache AND sort=$sort_[$i]";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
		$sort_arr[] = $row->navid;
	}

	for($i=0; $i<=1; $i++) {
		$query  = "update nav set sort=$sort_new[$i], edit=1 where navid=$sort_arr[$i]";
		safe_query($query);
	}

	# include("set_nav.php");
}

# navigationspunkt l&ouml;schen????
elseif ($del) {
	$back	= $_REQUEST["back"];
	$back 	= repl(";;", "&", $back);
	$back 	= repl(";:;", "=", $back);

	$link  = "navigation.php?$back&sprache=$sprache";

	$warnung = "<p><font color=#ff0000><b>Wollen Sie den Link mit all seinen Inhalten wirklich l&ouml;schen?</b><br>
				Denken Sie daran, dass Sie Links auch unsichtbar schalten k&ouml;nnen!</font></p>
				<a href=\"$link&delete=$del\" title=\"Link mit allen Inhalten l&ouml;schen! Denken Sie daran, dass Sie Links auch unsichtbar schalten k&ouml;nnen!\">" .ilink() ." endg&uuml;ltig l&ouml;schen</a>";
}

# ein navigationspunkt wird endg&uuml;ltig gel&ouml;scht
elseif ($delete) {
	$query = "SELECT * from nav where navid=$delete";
	$res = safe_query($query);
	$row = mysqli_fetch_object($res);
	$descr = htmlspecialchars($row->name);

	$query = "delete from nav where navid=$delete or parent=$delete";
	safe_query($query);

	$query_ = "insert `delete` set descr='Seiten und Navigation von: $descr', `query`='$query'";
	safe_query($query_);

	// include("set_nav.php");
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# navigations historie wird zusammengestellt
$x = 0;

for ($i=0; $i<$ebene; $i++) {
	$x++;
	$h_nm .= "&n_" .$i . "=" .$h_arr[$i];
	$h_pa .= "&p_" .$i . "=" .$n_arr[$i];

	if ($x < $ebene) {
		$fotoback  = $h_arr[$i];
		// hier wird zurueck definiert
		$back = "<a href=\"navigation.php?ebene=" .($i+1) .$h_pa .$h_nm ."&sprache=$sprache\" title=\"Sprung zu Navigationspunkt $h_arr[$i]\">";
		$echo .= $back."$h_arr[$i]</a> &nbsp; <i class=\"fa fa-angle-right\"></i> &nbsp; ";
	}
	else {
		$fotoback  .= " <i class=\"fa fa-angle-right\"></i> " .$h_arr[$i];
		$echo .= "<b>$h_arr[$i]</b>";
		$edit_back = "ebene=" .($i+1) .$h_pa .$h_nm;
		$edit_back = repl("&", ";;", $edit_back);
		$edit_back = "gruppe=$gruppe&back=".repl("=", ";:;", $edit_back);
	}
}

echo "<div id=content_big class=text>$sess
	<span class=\"sp200\"><h2>Seitenverwaltung</h2></span>
	<span class=\"sp200\"><a href=\"?$edit_back&repair=1&ebene=$ebene&parent=$parent&sprache=$sprache\"><i class=\"fa fa-refresh\"></i> sortierung aktualisieren</a></span>
<!--	<span class=\"sp200\"><a href=\"?$edit_back&repair=1&az=1&ebene=$ebene&parent=$parent&sprache=$sprache\">&raquo; sortierung nach A-Z &auml;ndern</a></span> -->
".'	<span class="lang">';

foreach ($morpheus["lan_arr"] as $key=>$lan) {
	echo '<a href="?sprache='.$key.'"><img src="images/'.$lan.'.gif" alt="" width="16" height="9" border="0"></a> &nbsp; &nbsp; ';
}

echo '</span>

<br style="clear: both;" />
';

echo $echo;

// print_r($_REQUEST);

if ($warnung) die ($warnung ."</div></body></html>");

echo "&nbsp;<p>";
# _historie
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# zurueck
if ($ebene > 1) echo "<p>$back" .backlink() ." zur&uuml;ck</a></p>
<!-- <p><a href=\"navigation.php?ebene=1&parent=0&sprache=$sprache\" title=\"zur&uuml;ck zum Hauptverzeichnis\">" .backlink() ." zur&uuml;ck zum Hauptverzeichnis</a></p> -->";
#else echo "<p>&nbsp;</p>";
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #


# jetzt wird subnav ausgewertet und entsprechend query zusammengestellt

if($parent == 1 && $ebene == 2 && $gruppe && $gruppe != "all")  $query  = "SELECT * FROM nav WHERE ebene=$ebene AND parent=$parent AND lang=$sprache AND button='$gruppe' ORDER BY button, name, `sort`";
elseif($parent == 1 && $ebene == 2) $query  = "SELECT * FROM nav WHERE ebene=$ebene AND parent=$parent AND lang=$sprache ORDER BY button, name, `sort`";
else $query  = "SELECT * FROM nav WHERE ebene=$ebene AND parent=$parent AND lang=$sprache ORDER BY `sort`";

$result = safe_query($query);

if($ebene == 200) echo '
<a href="navigation.php?'.$nav.'&'.$hist.'&'.$edit_back.'&ebene='.$ebene.'&parent='.$parent.'&sprache='.$sprache.'&gruppe=all">ALLE</a> &nbsp; &nbsp; &nbsp;
<a href="navigation.php?'.$nav.'&'.$hist.'&'.$edit_back.'&ebene='.$ebene.'&parent='.$parent.'&sprache='.$sprache.'&gruppe=agentur">AGENTUR</a> &nbsp; &nbsp; &nbsp;
<a href="navigation.php?'.$nav.'&'.$hist.'&'.$edit_back.'&ebene='.$ebene.'&parent='.$parent.'&sprache='.$sprache.'&gruppe=branchen">BRANCHEN</a> &nbsp; &nbsp; &nbsp;
<a href="navigation.php?'.$nav.'&'.$hist.'&'.$edit_back.'&ebene='.$ebene.'&parent='.$parent.'&sprache='.$sprache.'&gruppe=digital">DIGITAL</a> &nbsp; &nbsp; &nbsp;
<a href="navigation.php?'.$nav.'&'.$hist.'&'.$edit_back.'&ebene='.$ebene.'&parent='.$parent.'&sprache='.$sprache.'&gruppe=print">PRINT</a> &nbsp; &nbsp; &nbsp;
<a href="navigation.php?'.$nav.'&'.$hist.'&'.$edit_back.'&ebene='.$ebene.'&parent='.$parent.'&sprache='.$sprache.'&gruppe=service">SERVICE</a>
';
echo '
<table border="0" cellspacing="0" cellpadding="4" id="sverw">
<tr>
	<th colspan="5">&nbsp;</th>
	<th class="trenn gray">Struktur</th>
	<th class="trenn gray"></th>
	<th class="trenn gray">ID</th>
	<th class="trenn gray">Einstellungen</th>
	<th>Content</th>
	<th>&nbsp;</th>
</tr>';

$x = 0;
$y = mysqli_num_rows($result);

$ct  = 0;

while ($row = mysqli_fetch_object($result)) {
	$id 	= $row->navid;
	$nm 	= $row->name;
	$but 	= $row->button;
	$so 	= $row->sort;
	$si 	= $row->sichtbar;
	$meta 	= $row->bereich;

	$ti		= $row->title;
	$ke		= $row->keyw;
	$des	= $row->desc;

	$oldlnk	= $row->oldlnk;

	$setting = '';
	$setting .= $ti ? "T | " : "&nbsp;|&nbsp;";
	$setting .= $des ? "D | " : "&nbsp;|&nbsp;";
	$setting .= $ke ? "K" : "";

	if ($si == 1) 	$si = '<a href="?'.$nav.'&'.$hist.'&'.$edit_back."&parent=$parent&sprache=$sprache&ebene=$ebene&unvis=$id".'"><i class="fa fa-eye"></i></a>';
	else			$si = '<a href="?'.$nav.'&'.$hist.'&'.$edit_back."&parent=$parent&sprache=$sprache&ebene=$ebene&vis=$id".'"><i class="gray fa fa-eye-slash"></i></a>';

	if ($nm) {
		$x++;
//		if ($meta > 1) $ct = 2;
		$ct = $meta;
//		echo "<tr style=\"background:".$morpheus["col"][$ct]."\">
		echo "<tr class=\"backg".$ct."\">
			<td class=\"trenn c1\"><a>$so</a></td>
";

		if ($x > 1) echo "<td  class=\" c2\">&nbsp; <a href=\"navigation.php?$nav&$hist&sort=up&sortid=$so&$edit_back&ebene=$ebene&parent=$parent&sprache=$sprache\" title=\"eine Position nach oben\"><i class=\"fa fa-chevron-up small\"></i></a></td>\n";
		else echo "<td class=\" c2\"></td>\n";

		if ($x < $y) echo "<td class=\" c2\"><a href=\"navigation.php?$nav&$hist&sort=down&sortid=$so&$edit_back&ebene=$ebene&parent=$parent&sprache=$sprache\" title=\"eine Position nach unten\"><i class=\"fa fa-chevron-down small\"></i></a></td>\n";
		else echo "<td  class=\" c2\"></td>\n";

		$edit_lnk = "<a href=\"nav_edit.php?edit=$id&$edit_back&sprache=$sprache\" title=\"Link editieren, Sichtbarkeiten setzen\">";

		echo "
			<td class=\"trenn c2\"><a href=\"navigation.php?ebene=" .($ebene+1) ."&$nav&p_" .($parent+1) ."=$id&$hist&n_" .($parent+1) ."=$nm&sprache=$sprache\" title=\"Subnavigation aufrufen\"><i class=\"fa fa-level-down\"></i></a></td>

			<td class=\"c7\" nowrap>$setting</a></td>
			<td class=\"trenn c4\"><a href=\"content.php?edit=$id&db=content&$edit_back&sprache=$sprache\" title=\"Content/Inhalt bearbeiten\"></a> &nbsp; ".$edit_lnk.($parent == 1 && $ebene == 2 ? '<i style="text-transform:uppercase;">'.$but.'</i> | ' : '')."$nm | <u style=\"color:red;\">$oldlnk</u></a></td>

			<td class=\"c7\">$si</td>
			<td class=\"trenn c5\">$id</td>
			<td class=\"trenn c6\">".$edit_lnk."<i class=\"fa fa-cogs\"></i></a></td>

			<td class=\"c8\"><a href=\"content.php?edit=$id&db=content&$edit_back&sprache=$sprache\" title=\"Content/Inhalt bearbeiten\"><i class=\"fa fa-pencil-square-o\"></i></a></td>

			<td class=\"c9 trenn\"><a href=\"navigation.php?del=$id&$edit_back&sprache=$sprache\" title=\"Link mit allen Inhalten l&ouml;schen! Denken Sie daran, dass Sie Links auch unsichtbar schalten k&ouml;nnen!\"><i class=\"fa fa-trash-o\"></i></td>

		</tr>
";

		if ($ct == 0) $ct = 1;		//farbendefenition
		else $ct = 0;
	}
}
echo "</table><p>&nbsp;</p>";

echo "<p><a href=\"nav_edit.php?ebene=$ebene&parent=$parent&$edit_back&sprache=$sprache\" title=\"Neuen Link erstellen\">" .ilink() ." NEU</a></p>";
echo "<p><a href=\"link.php?ebenenew=1&$edit_back&sprache=$sprache&amp;copy=1\" title=\"Ordnerstruktur hieher verschieben\">" .ilink() ." Ordnerstruktur hierher verschieben</a></p>";
?>

	<p>&nbsp;</p>
	<p><b><u>Symbole</u></b></p>
	<p><i class="fa fa-trash-o"></i> &nbsp; l&ouml;schen</p>
	<p><i class="fa fa-pencil-square-o"></i> &nbsp; den inhalt/content des links editieren</p>
	<p><i class="fa fa-level-down"></i> &nbsp; in der navigation eine ebene tiefer gehen</p>
	<p><i class="fa fa-cogs"></i> &nbsp; den link-namen editieren, Meta Tags setzen</p>

</div>

<?
include("footer.php");
?>