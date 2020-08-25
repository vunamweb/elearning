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

include("cms_include.inc");

$lan_arr = array(1=>"de", 2=>"en");
$sprache = $_REQUEST["sprache"];

# welche ebene und welche subnav wurde ausgewaehlt
$ebene  = $_REQUEST["ebene"];
$parent = $_REQUEST["parent"];
$edit	= $_REQUEST["edit"];
$cid	= $_REQUEST["cid"];
$save	= $_REQUEST["save"];
$back	= $_REQUEST["back"];
$gruppe	= $_REQUEST["gruppe"];
$back 	= repl(";;", "&", $back);
$back 	= repl(";:;", "=", $back);
$blink  = "navigation.php?$back&sprache=$sprache&gruppe=$gruppe";

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

if ($cid) {
	$query 	= "UPDATE nav set lnk=$cid WHERE navid=$edit";
	$result = safe_query($query);
}

$name 	= $_POST["name"];

if ($save && !$name) $warn = "<p><font color=#ff0000><b>Der Name eines Navigation-Elementes darf nicht leer sein</b></font></p>";

elseif ($save && $name) {
	$title 		= $_POST["title"];
	$desc 		= $_POST["desc"];
	$keyw 		= $_POST["keyw"];
	$sichtbar 	= $_POST["sichtbar"];
	$lock 		= $_POST["lock"];
	if (!$bereich = $_POST["bereich"]) $bereich=1;
	$button		= $_POST["button"];
	$link		= $_POST["lnk"];
	$design		= $_POST["design"];
	$anker		= $_POST["anker"];

	if (!$parent) $parent = 0;
	if (!$design) $design = $morpheus["standard_des"];
	if (!$sichtbar) $sichtbar = 0;
	else $sichtbar = 1;

	if (!$edit)	{
		$query  = "SELECT * FROM nav WHERE ebene=$ebene AND parent=$parent ORDER BY `sort` DESC";
		$result = safe_query($query);
		$sort = mysqli_num_rows($result);
		$sort++;
	}

	$set = "set name='$name', title='$title', anker='$anker', keyw='$keyw', lnk='$link', `desc`='$desc', design='$design', sichtbar=$sichtbar, bereich=$bereich, button='$button', lang=$sprache, edit=1, `lock`=".($lock ? 1 : 0);

	# print_r($_REQUEST);
	# die($set);

	if ($edit) {
		$query 	= "UPDATE nav " .$set ." WHERE navid=$edit";
		$result = safe_query($query);
//die($result);
		protokoll($uid, "nav", $edit, "edit");

		# url's werden nicht mehr aufgrund von id's gefunden. also muss nach umbenennung, auch die alte url fuer einen redirect gespeichert werden
		# alte urls werden mit einem tool gepflegt. jede erzeugte url, wird hier festgehalten
		# art = 1     =>    content-seiten

		$url	= eliminiere($name);

		if ($parent > 0) {
			$query  = "SELECT * FROM nav WHERE navid=$parent";
			$result = safe_query($query);
			$row 	= mysqli_fetch_object($result);
			$url 	= $row->name."/".$url;
		}
		$url   .= "/";
		$sql 	= "SELECT * FROM pfad WHERE url='$url'";
		$res 	= safe_query($sql);
		$x		= mysqli_num_rows($res);
		if ($x < 1) {
			$sql 	= "INSERT pfad SET navid=$edit, parent='$parent', url='$url'";
			$res 	= safe_query($sql);
		}
	}

	else {
		$query 	= "INSERT nav " .$set .", ebene=$ebene, parent=$parent, sort=$sort";
		$result = safe_query($query);
		$cid	= mysqli_insert_id($mylink);
		$x = 1;

		foreach($morpheus["standard_tid"] as $tid) {
			$query 	= "INSERT content SET navid=$cid, tpos=".$x.", tid=".$tid;
			$result = safe_query($query);
			$c 		= mysqli_insert_id($mylink);
			protokoll($uid, "nav", $c, "neu");
			$x++;
		}
	}
//die($query);
	# # # # #
	# # # # #
	# # # # # array fuer interne links schreiben
	$query  = "SELECT * FROM nav WHERE lang=$sprache";
	$result = safe_query($query);

	$nav_arr 	= '<?php
$navarray = array("0"=>""';
	$nav_arrF 	= '<?php
$navarrayFULL = array("0"=>""';

	while ($row = mysqli_fetch_object($result)) {
		$id		= $row->navid;
		$name	= $row->name;
		$nnm 	= strtolower(eliminiere($name));

		if ($nnm) {
			$nav_arr .= ', "'.$id.'"=>"'.utf8_decode($nnm).'"';
			$nav_arrF .= ', "'.$id.'"=>"'.utf8_decode($name).'"';
		}
	}

	$nav_arr .= ');
?>'.
	$nav_arrF .= ');
?>';

	save_data("../nogo/navarray_".$morpheus["lan_arr"][$sprache].".php",$nav_arr,"w");

	include("quickbar.php");
	include("sitemap_create.php");
	include("sitemap_create_footer.php");
	include("set_nav.php");
	# # # # #
	# # # # #
	# # # # #
	// die();
	echo "<script language='javascript'>
		document.location = '$blink';
	</script>";

}

elseif ($edit) {
	$query  	= "SELECT * FROM nav n WHERE n.navid=$edit";
	$result 	= safe_query($query);
	$row 		= mysqli_fetch_object($result);
	$sort 		= $row->sort;
	$ebene 		= $row->ebene;
	$parent 	= $row->parent;
	$name 		= $row->name;
	$title 		= $row->title;
	$desc 		= $row->desc;
	$design		= $row->design;
	$keyw 		= $row->keyw;
	$anker 		= $row->anker;

	$sichtbar 	= $row->sichtbar;
	$lock 		= $row->lock;
	$bereich 	= $row->bereich; // hier kann zw 2 haupt-navigationsebenen gewaehlt werden
	$link 		= $row->lnk;
	$button		= $row->button;
}

# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # bereich zuweisung, falls es 2 unterschiedliche hauptnavigationen gibt
$bereich_bez = $morpheus["navpos"];
$bereich_anz = count($bereich_bez);
if (!$bereich) $bereich = 1;

foreach($bereich_bez as $key=>$val) {
	$radio .= '<p><input type="radio" name="bereich" value="'.$key.'"';
	if ($bereich == $key) $radio .= ' checked';
	$radio .= '> &nbsp; '.$val.'</p>';
}
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
$templ 	= $morpheus["design"];
$i 		= 0;
if (!$tid) $tid = 1;

foreach($templ as $key=>$val) {
	if ($val) $template .= '<p><input type="radio" name="design" value="'.$key.'"'. ($design == $key ? ' checked' : '') .'> &nbsp; '. $val .'</p>';
}
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #

echo "\n\n<div id=content_big class=text>

<h2>Struktur - Navigationselement anlegen</h2>";

echo $warn;

if ($sichtbar || !$edit) $s_chk = "checked";

echo "<form method=post name=nav_edit>
	<input type=hidden name=save value=1>
	<input type=hidden name=edit value=$edit>
	<input type=hidden name=ebene value=$ebene>
	<input type=hidden name=sprache value=$sprache>
	<input type=hidden name=parent value=$parent>\n"
	."<p><b>Name, der in der Navigation als Link angezeigt wird.</b></p>
	<p><input type=text name=name value='$name' class=\"long\"><br>&nbsp;<br>".'<input type=text name=lnk value="'.$link.'"> &nbsp; <a href="link.php?navLink='.$edit.'&sprache='.$sprache.'">'  .$bittew .''."&raquo; Verlinkung auf eine andere Seite</a>

	<br>&nbsp;<br>".'<input type=text name=anker value="'.$anker.'"> &nbsp; Anker setzen</p>';

// echo " <input type=text name=button value='".$button."' class=\"long\"> &nbsp; CSS Klasse";

echo "</p>
<p>&nbsp;</p>
";

echo "	<div class=\"nav_art\">";
if ($ebene < 2) echo $radio."<hr style=\"height: 1px;\">";
echo '<p><input type="checkbox" name="sichtbar" value="sichtbar" '.$s_chk.'> &nbsp; Link in Navigaton sichtbar</p>

	<p><input type="checkbox" name="lock" value="1" '.($lock ? ' checked' : '').'> &nbsp; Nur mit Login sichtbar</p></div>
';

echo '	<div class="nav_aufb"><p><strong>Seiten Design / Aufbau</strong></p>'.$template.'
<br style="clear:left;">&nbsp;</div>';

// if ($lock) echo "<strong>Diese Seite geh&ouml;rt zu einem gesch&uuml;tzten Kundenaccount</strong>";
echo "</p>

	<p>&nbsp;</p>
	<h4>Suchmaschinen / Meta Tags</h4>
	<p><i>Achten Sie vor allem bei Beschreibung und Schl&uuml;sselw&ouml;rtern auf das Vorkommen der Begriffe in der Seite!</i></p>
	<p><b>Titel der Seite</b>
	<input type=text name=title value='$title' style=\"width:450px;\" size=62 maxlength=255></p>

	<p><b>Kurze Beschreibung dieser Seite</b>
	<input type=text name=desc value='$desc' style=\"width:700px;\" size=255 maxlength=255></p>

	<p><b>Schl&uuml;sselbegriffe dieser Seite</b>
	<input type=text name=keyw value='$keyw' style=\"width:700px;\" size=255 maxlength=255></p>
";

echo "<p>&nbsp;</p>
	<p><input type=submit style=\"background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;\" name=erstellen value=speichern style=\"width:70;background-color:#BBBBBB;\"></p>

	</form>
		";

echo "<p><a href=\"$blink\" title=\"zur&uuml;ck\" class=\"zurueck\">" .backlink() ." zur&uuml;ck</a></p>
	<!-- <p><b>Content dieser Seite</b>. Holen Sie sich die Begriffe per copy/paste => kopieren/einf&uuml;gen</p>
	<div style=\"background-color:silver; width: 700px; padding: 6px; margin: 10px 0px 0px 0px;\">";

$text  = "<u>INHALT:</u><br>".$row->content;

$raus  = array("/ilink/", "/<fett>/", "/<\/fett>/", "/<kursiv>/", "/<\/kursiv>/");
$rein  = array("", "", "", "", "");
$suche = repl("/", "", implode("|", $raus));

$text = preg_replace($raus, $rein, $text);

$text  = explode("##", $text);

foreach($text as $val) {
	$tx = explode("@@", $val);
	echo "<p style=\"margin: 10 0 0 0;\">".nl2br($tx[1])."</p>";
}

echo " --></div>";
?>

</div>

<?
include("footer.php");
?>