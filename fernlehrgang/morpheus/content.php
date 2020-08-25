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

# # # # # # # # # # # # # # # # # # # # # # # # # # #
# formular pull down # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # #
function pulldown ($id) {
	$query = "SELECT vorl_name, cid FROM content WHERE vorlage=1 ORDER BY vorl_name";
	$result = safe_query($query);

	while ($row = mysqli_fetch_object($result)) {
		if ($row->cid == $id) $sel = "selected";
		else $sel = "";

		$nm = $row->vorl_name;
		$pd .= "<option value=\"" .$row->cid ."\" $sel>$nm</option>\n";
	}
	return $pd;
}

function repair($navid) {
	$arr 		= array();
	$xx 		= 0;
	$sql  		= "SELECT * FROM content WHERE navid=$navid ORDER BY tpos";
	$res 		= safe_query($sql);

	while ($rw = mysqli_fetch_object($res)) $arr[] = $rw->cid;

	foreach ($arr as $val) {
		$xx++;
		$sql  = "UPDATE content set tpos=$xx WHERE cid=$val";
		$res = safe_query($sql);
	}
//	repairall();
}

function repairall() {
	for($i=1; $i<=200; $i++) {
		$arr 		= array();
		$xx 		= 0;
		$sql  		= "SELECT * FROM content WHERE navid=$i ORDER BY tpos";
		$res 		= safe_query($sql);

		while ($rw = mysqli_fetch_object($res)) $arr[] = $rw->cid;

		foreach ($arr as $val) {
			$xx++;
			$sql  = "UPDATE content set tpos=$xx WHERE cid=$val";
			$res = safe_query($sql);
		}
	}
}


$del 	 = $_REQUEST["del"];
$delete	 = $_REQUEST["delete"];
$neu	 = $_REQUEST["neu"];
$sort	 = $_REQUEST["sort"];
$sortid	 = $_REQUEST["sortid"];
$id	 	 = $_REQUEST["id"];
$cid	 = $_REQUEST["cid"];
$copy 	 = $_REQUEST["copy"];
$pos 	 = $_REQUEST["pos"];
$sichtbar= $_REQUEST["sichtbar"];
$vorlage= $_REQUEST["vorlage"];
$gruppe = $_REQUEST["gruppe"];

if ($_REQUEST["sprache"]) {
	$sprache = $_REQUEST["sprache"];
	$_SESSION["sprache"] = $sprache;
}
$sprache = $_SESSION["sprache"];

///////////////////////////////////////////////////////////////////////////
if ($_GET["back"]) { $back = $_GET["back"].'&gruppe='.$gruppe; $_SESSION["back"] = $back; }
else $back = $_SESSION["back"];
$bck 	= str_replace(array(";;", ";:;"), array("&", "="), $back);
$zuruck = '<a href="navigation.php?'.$bck.'"><i class="fa fa-chevron-left small"></i> zur&uuml;ck</a>';
///////////////////////////////////////////////////////////////////////////

$edit	= $_REQUEST["edit"];
$sql  	= "SELECT * FROM nav WHERE navid=$edit";
$res	= safe_query($sql);
$row 	= mysqli_fetch_object($res);
$titel	= $row->name;

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
if ($neu) {
	$sql  	= "SELECT * FROM content WHERE navid=$edit ORDER BY tpos";
	$res 	= safe_query($sql);
	$y		= mysqli_num_rows($res);
	$y++;
	$tid 	= $morpheus["standard_tid"][0];

	if ($vorlage) 	$sql = "insert content set navid=$edit, vid=1, tpos=$y";
	else			$sql = "insert content set navid=$edit, tpos=$y, tid='$tid'";
	$res	= safe_query($sql);
}
elseif ($cid && $vorlage) {
	$sql	= "UPDATE content set vid=$vorlage WHERE cid=$cid";
	$res	= safe_query($sql);
}
elseif ($copy) {
	$y 		= $pos++;
	if(!$y) {
		$sql  	= "SELECT * FROM content WHERE navid=$edit ORDER BY tpos";
		$res 	= safe_query($sql);
		$y		= mysqli_num_rows($res);
		$y++;
	}
	$sql  	= "SELECT * FROM content WHERE cid=$copy";
	$res 	= safe_query($sql);
	$row 	= mysqli_fetch_object($res);
	$tid 	= $row->tid;
	$th 	= $row->theadl;
	$de 	= $row->content;
	$tlink  = $row->tlink;
	$tb		= $row->tb;
	$timage	= $row->timage;

	$sql	= "insert content set navid=$edit, tpos=$y, theadl='$th', content='$de', tid='$tid', tlink='$tlink', tbackground='$tb', timage='$timage', theight='$theight', twidth='$twidth'";
	$res	= safe_query($sql);

	repair($edit);
}
elseif ($del) {
	$warnung = "<p>&nbsp;</p>
		<p><font color=#ff0000><b>Wollen Sie das Template wirklich l&ouml;schen?</b></font></p>
		<p>&nbsp;</p>
		<p><a href=\"?delete=$del&edit=$edit\" title=\"Content l&ouml;schen!\">" .ilink() ." Template endg&uuml;ltig l&ouml;schen</a><br>&nbsp;<br>
		<a href=\"?edit=$edit\" title=\"\">" .ilink() ." NEIN</a></p>";
}
elseif ($delete) {
	$sql = "DELETE FROM content WHERE cid=$delete";
	safe_query($sql);
	repair($edit);
	protokoll($uid, "content", $delete, "del");
}
elseif ($_REQUEST["repair"]) {
	repair($edit);
}
elseif ($sichtbar) {
	$query  = "UPDATE content SET ton=$sichtbar WHERE cid=$id";
	safe_query($query);
}

// wenn sortierung geaendert wurde, jetzt in db schreiben
elseif ($sort) {
	if ($sort == "up") $s2 = $sortid - 1;
	else $s2 = $sortid + 1;

	$sort_    = array($sortid, $s2);
	$sort_new = array($s2, $sortid);
	$sort_arr = array();

	for($i=0; $i<=1; $i++) {
		$query  = "SELECT * FROM content WHERE navid=$edit AND tpos=$sort_[$i]";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
		$sort_arr[] = $row->cid;
	}

	for($i=0; $i<=1; $i++) {
		$query  = "UPDATE content SET tpos=$sort_new[$i], edit=1 WHERE cid=$sort_arr[$i]";
		safe_query($query);
	}
}

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

echo "
<div id=\"content\" class=\"no_preview\">
		<h2>
			Inhalt: <strong>$titel</strong> &nbsp; <img src=\"images/".$morpheus["lan_arr"][$sprache].".gif\"> &nbsp; &nbsp; &nbsp; &nbsp;
			<a href=\"../index.php?vs=1&cid=$edit&navid=$edit&lan=$sprache\" rel=\"gb_page_center[1240]\" target=\"_blank\">vorschau " .ilink() ."</a>
		</h2>


	". ($warnung ? $warnung : "<p>$zuruck &nbsp; &nbsp; | &nbsp; &nbsp; <a href=\"?repair=1&edit=$edit\"><i class=\"fa fa-refresh\"></i> repariere Sortierung</a> &nbsp; &nbsp;".' | &nbsp; &nbsp; <a href="?neu=1&edit='.$edit.'&navid='.$edit.'"><i class="fa fa-plus"></i> Neues leeres Template erzeugen</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="link.php?edit='.$edit.'&navid='.$edit.'"><i class="fa fa-copy"></i> Template kopieren</a>&nbsp; &nbsp;<!-- |&nbsp; <a href="link.php?edit='.$edit.'&navid='.$edit.'&de=1"> DE Template copy</a>-->') ."


";

if ($warnung) die();

$sql	= "SELECT * FROM content WHERE navid=$edit ORDER BY tpos";
$res	= safe_query($sql);
$y		= mysqli_num_rows($res);
$x		= 0;

while ($row = mysqli_fetch_object($res)) {
	$x++;
	$id = $row->cid;
	$tid = $row->tid;
	$vid = $row->vid;
	$tl = $row->tlink;
	$th = $row->theadl;
	$po = $row->tpos;
	$on = $row->ton;
	$de = $row->content;
	$en = $row->c_en;

	# $txt = substr(get_raw_text($de),0,100) ."...";
	$txt = get_raw_text_morp($de);

	echo '
	<table class="templ_vors">
		<tr>
			<td class="tab_header"> &nbsp;
				<div class="fest">
					<a>'.$po.'</a>
				</div>
				<div style="text-align:left;" class="fest"> ';

	if ($x > 1) echo '&nbsp; <a href="content.php?edit='.$edit.'&cid='.$id.'&sort=up&sortid='.$x.'" title="eine Position nach oben"><i class="fa fa-chevron-up small"></i></a>';
	else echo "&nbsp; \n";

	if ($x < $y && $y > 1) echo '&nbsp; <a href="content.php?edit='.$edit.'&cid='.$id.'&sort=down&sortid='.$x.'" title="eine Position nach oben"><i class="fa fa-chevron-down small"></i></a>';
	else echo "&nbsp; \n";

	echo '
				</div>
	';
	if ($vid) {
		echo '			<table style="float:left;"><tr>
					<td><h2 style="color:#000;">*** VORLAGE *** </h2></td>
					<td><form name="form'.$vid.'"><input type="hidden" name="edit" value="'.$edit.'"><input type="hidden" name="cid" value="'.$id.'">
						<select name="vorlage" style="float:left;"><option>bitte w&auml;hlen</option>'.pulldown ($vid).'</select></td>
					<td><input type="submit" name="speichern" value="speichern"></form></td>
					<td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="?del='.$id.'&edit='.$edit.'" title="Content l&ouml;schen"><i class="fa fa-trash-o"></i></a></td>
					</tr>
				</table>
';
	}

	else echo '

				<div style="width:120px;" class="fest">
					<a href="content_edit.php?edit='.$id.'&navid='.$edit.'" title="Content editieren" class="weiss"><i class="fa fa-pencil-square-o "></i> edit</a>
				</div>
				<div style="" class="fest">
					<a href="?del='.$id.'&edit='.$edit.'" title="Content l&ouml;schen"><i class="fa fa-trash-o"></i></a>
						&nbsp; &nbsp; &nbsp;
					<a href="?copy='.$id.'&edit='.$edit.'&pos='.$po.'" title="Content duplizieren"><i class="fa fa-copy"></i></a>
				</div>
				<div style="" class="fest">
					<a href="?sichtbar='. ($on == 1 ? "2" : "1") .'&id='.$id.'&edit='.$edit.'"><i class="fa fa-eye'. ($on == 1 ? "" : "-slash gray") .'"></i></a>
				</div>
				<div style="text-align: right;width:160px;" class="fest">
					<a href="content_template.php?edit='.$id.'&navid='.$edit.'"><i class="fa fa-cogs"></i> Einstellungen</a>
				</div>
				<div style="text-align: right;width:160px;" class="fest">
					'.($tl ? 'Anker: '.$tl : '').'
				</div>
				<div class="templ_titel">
					 <a href="content_template.php?edit='.$id.'&navid='.$edit.'" class="">'. $morpheus["template"][$tid].'</a>'. ($th ? ' - <strong style="color:#000;font-size:18px;">'.$th."</strong>" : "") .'
				</div>
';
	echo '			</td>
		</tr>
		<tr>
			<td bgcolor="#eeeeee">'.substr($txt, 0, 1000).'</td>
		</tr>
	</table>';
}

echo '<p><a href="?neu=1&edit='.$edit.'&navid='.$edit.'"><i class="fa fa-plus"></i> Neues leeres Template erzeugen</a></p>';
echo '<p><a href="?neu=1&vorlage=1&edit='.$edit.'&navid='.$edit.'"><i class="fa fa-plus"></i> Neue <strong>VORLAGE</strong> platzieren</a></p>';
?>

</div>

<?php
include("footer.php");
?>