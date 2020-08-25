<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
# edit 27.11.2006                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 

session_start();
#$box = 1;
include("cms_include.inc");

# print_r($_REQUEST);

global $arr_form, $art;

$edit 	= $_REQUEST["edit"];
$neu	= $_REQUEST["neu"];
$save	= $_REQUEST["save"];
$del	= $_REQUEST["del"];
$id		= $_REQUEST["id"];
$art	= $_REQUEST["art"];
$parent	= $_REQUEST["parent"];
$parent2= $_REQUEST["parent2"];
$newpar = $_REQUEST["newpar"];

if ($parent) 	$_SESSION["pdfpar"] 	= $parent;
if ($parent2) 	$_SESSION["pdfpar2"] 	= $parent2;
if ($art) 		$_SESSION["pdfart"] 	= $art;

echo '<div id=vorschau>
	<h2>Dokumenten / Download Verwaltung</h2>

	'. ($edit || $neu ? '<p><a href="?pid='.$pid.'">&laquo; zur&uuml;ck</a></p>' : '') .'	
	<form action="" onsubmit="" name="verwaltung" method="post">
';

$new = '<p>&nbsp;</p><p><a href="?neu=1">&raquo; NEUER Ordner erste Ebene</a></p>';

$arr_form = array(
	array("pgname", "Ordner-Name",'<input type="Text" value="#v#" name="#n#" style="#s#">'),
);


/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function liste($par=0, $par2=0) {
	global $art;
	
	$db = "pdf_group";
	$id = "pgid";
	$ord = "pgname";
	$anz = "pgname";
	
	$echo .= '<table>';

	$sql = "SELECT * FROM $db WHERE parent=0 ORDER BY pgart, ".$ord."";
	$res = safe_query($sql); 
	
	while ($row = mysqli_fetch_object($res)) {	
		$th_id = $row->$id;
		$pgart = $row->pgart;
		
		$cp = check_par($th_id);
		
		$echo .= '<tr'.($pgart == 2 ? ' style="background:#f2f2f2"' : '').'>
			<td width="450">
					'. ($cp ? set_lnk($th_id, 0, $row->pgart).set_image($th_id, 0, 10).'</a>' : '<img src="images/nosub.gif" alt="" width="9" height="9" border="0" style="margin:0 20px 0 10px;">') .'
					'. ($th_id != 9 ? '<a href="pdf.php?pgid='.$th_id.'"><strong>'.$row->$anz.'</strong>&nbsp; <img src="images/verschieben.gif" title="Ordner &ouml;ffnen" width="14" height="9" border="0"></a>' : '<strong>'.$row->$anz.'</strong>') .'
			</td>
			<td width="250">
				<a href="?edit='.$th_id.'&parent='.$par.'&parent2='.$par2.'">Eigenschaft</a> &nbsp; | &nbsp; 
				<a href="?neu=1&art='.$art.'&me='.$th_id.'&newpar='.$th_id.'&parent='.$par.'&parent2='.$par2.'">Unterordner erstellen</a><!-- &nbsp; | &nbsp; 
				<a href="pdf.php?pgid='.$th_id.'"><img src="images/verschieben.gif" title="Ordner &ouml;ffnen" width="14" height="9" border="0"></a> -->
			</td>
			<!-- <td vwidth="50"><a href="?del='.$th_id.'"><img src="images/delete.gif" alt="" width="9" height="10" border="0"></a></td> -->
		</tr>
		<!-- split'.$th_id.' -->';

		$echo .= $cp ?  ebene($db, $id, $th_id, $par2, $ord, $anz) : '';

	}
	
	// 1. ebene oeffnen
	/*
	if ($par) {
		$tmp = ebene($db, $id, $par, $par2, $ord, $anz);
		$echo = str_replace("<!-- split".$par." -->", $tmp, $echo);
	}
	*/
	// 2. ebene oeffnen

	if ($par2) {
		$sql = "SELECT * FROM $db WHERE parent=$par2 ORDER BY ".$ord."";
		$res = safe_query($sql); 
		unset($tmp);
		
		while ($row = mysqli_fetch_object($res)) {	
			$th_id = $row->$id;
			$pgart = $row->pgart;
			$tmp .= '<tr'.($pgart == 2 ? ' style="background:#f2f2f2"' : '').'>
			<td>
				<a href="pdf.php?pgid='.$th_id.'" style="margin:0 0px 0 90px;"><strong>- '.$row->$anz.'</strong>&nbsp; <img src="images/verschieben.gif" title="Ordner &ouml;ffnen" width="14" height="9" border="0"></a>
			</td>
			<td width="250">
				<a href="?edit='.$th_id.'&noart=1&parent='.$par.'&parent2='.$par2.'">Eigenschaft</a> 
			</td>
			<!-- <td width="50"><a href="?del='.$th_id.'"><img src="images/delete.gif" alt="" width="9" height="10" border="0"></a></td> -->
		</tr>
			<!-- split'.$th_id.' -->';
		}
		$echo = str_replace("<!-- split".$par2." -->", $tmp, $echo);
	}

	$echo .= '</table><p>&nbsp;</p>';

	return $echo;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
function ebene($db, $id, $par, $par2, $ord, $anz) {
		$sql = "SELECT * FROM $db WHERE parent=$par ORDER BY ".$ord."";
		$res = safe_query($sql); 
		$tmp = '';

		while ($row = mysqli_fetch_object($res)) {	
			$th_id = $row->$id;
			$pgart = $row->pgart;

			$tmp .= '<tr'.($pgart == 2 ? ' style="background:#f2f2f2"' : '').'>
			<td>
					'. (check_par($th_id) ? set_lnk($par, $th_id, $row->pgart).set_image(0, $th_id, 40).'</a>' : '<img src="images/nosub.gif" alt="" width="9" height="9" border="0" style="margin:0 20px 0 40px;">') .'
					<a href="pdf.php?pgid='.$th_id.'"><strong>'.$row->$anz.'</strong>&nbsp; <img src="images/verschieben.gif" title="Ordner &ouml;ffnen" width="14" height="9" border="0"></a>
			</td>
			<td width="250">
				<a href="?edit='.$th_id.'&noart=1&parent='.$par.'&parent2='.$par2.'">Eigenschaft</a> <!-- &nbsp; | &nbsp;  -->
				<!-- <a href="?neu=1&art='.$art.'&me='.$th_id.'&newpar='.$th_id.'&parent='.$par.'&parent2='.$par2.'">Unterordner erstellen</a> --><!-- &nbsp; | &nbsp; 
				<a href="pdf.php?edit='.$th_id.'"><img src="images/verschieben.gif" title="Ordner &ouml;ffnen" width="14" height="9" border="0"></a> -->
			</td>
			<!-- <td width="50"><a href="?del='.$th_id.'"><img src="images/delete.gif" alt="" width="9" height="10" border="0"></a></td> -->
		</tr>
			<!-- split'.$th_id.' -->';
		}
		return $tmp;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////

function check_par($par) {
	$db = "pdf_group";
	$id = "pgid";
	$sql = "SELECT * FROM $db WHERE parent=$par";
	$res = safe_query($sql); 
	$x   = mysqli_num_rows($res);
	return $x;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function set_image($par=0, $par2=0, $left=10) {
	global $parent, $parent2;
	
	if ($par2 === $parent2 || $par === $parent) 	
			$img = '<img src="images/open.gif" alt="" width="9" height="9" border="0" style="margin:0 20px 0 '.$left.'px;">';
	else	$img = '<img src="images/dupl.gif" alt="" width="9" height="9" border="0" style="margin:0 20px 0 '.$left.'px;">';

	return $img;
}

function set_lnk($par=0, $par2=0, $art=1) {
	global $parent, $parent2;
	
	if ($par && $par2) {
		if ($par == $parent && $par2 == $parent2) 	$lnk = '<a href="?parent='.$par.'&art='.$art.'">';
		else					$lnk = '<a href="?parent='.$par.'&parent2='.$par2.'&art='.$art.'">';
	}
	elseif ($par) {
		if ($par == $parent) 	$lnk = '<a href="?">';
		else					$lnk = '<a href="?parent='.$par.'&parent2='.$par2.'&art='.$art.'">';
	}
	
	return $lnk;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function edit($edit) {
	global $arr_form, $parent, $parent2, $art;
	
	$db = "pdf_group";
	$id = "pgid";

	$sql = "SELECT * FROM $db WHERE $id=".$edit."";
	$res = safe_query($sql); 
	$row = mysqli_fetch_object($res);
	$art = $row->pgart;
	if(!$art) $art = 1;
	
	$echo .= '<input type="Hidden" name="neu" value="'.$neu.'">
		<input type="Hidden" name="edit" value="'.$edit.'">
		<input type="Hidden" name="save" value="1">

		<input type="Hidden" name="parent" value="'.$parent.'">
		<input type="Hidden" name="parent2" value="'.$parent2.'">
		<input type="Hidden" name="art" value="'.$art.'">
	
	<table cellspacing="6">';

	$echo .= '<tr>
		<td></td>
	</tr>
';
		
	foreach($arr_form as $arr) {	
		if ($arr[0] == "aktiv") {
			if ($row->$arr[0] == "1") $sel1 = " checked";
			else $sel2 = " checked";
		}
		
		$echo .= '<tr>
		<td>'.$arr[1].':</td>
		<td>'. str_replace(
					array("#v#", "#n#", "#s#", "#db#", '#e#', '#id#', '#s1#', '#s0#'), 
					array($row->$arr[0], $arr[0], 'width:400px;', $db2, $edit, $id2, $sel1, $sel2), 
			$arr[2]).'</td>
	</tr>';
	}
	
	// Bereiche Zuordnen
	$bereich_bez = array("","Standard Download","Interner Bereich / SECURE Download");
	$bereich_anz = count($bereich_bez)-1;
	if (!$art) $art = 1;
	
	for($i=1; $i <= $bereich_anz; $i++) {
		$radio .= '<p><input type="radio" name="pgart" value="'.$i.'"';
		if ($art == $i) $radio .= ' checked';
		$radio .= '> &nbsp; '.$bereich_bez[$i].'</p>';
	}

	$echo .= '
	<tr>
		<td></td>
		<td>'.$radio.'</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="speichern" value="speichern"></td>
	</tr>
</table>';

	return $echo;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function neu() {
	global $arr_form, $art, $newpar, $parent, $parent2;

	$x = 0;
	$art = 1;
	
	$echo .= '<input type="Hidden" name="neu" value="1"><input type="Hidden" name="save" value="1">
	
	<table cellspacing="6">';
		
	foreach($arr_form as $arr) {	
		$echo .= '<tr>
			<td>'.$arr[1].':</td>
			<td>'. str_replace(array("#v#", "#n#", "#s#"), array($row->$arr[0], $arr[0], 'width:400px;'), $arr[2]).'</td>
		</tr>';
	}
	
	$echo .= '<tr>
		<td></td>
		<td>
			<input type="Hidden" value="'.$art.'" name="pgart"><input type="Hidden" value="'.$newpar.'" name="newpar">
			<input type="Hidden" value="'.$parent.'" name="parent"><input type="Hidden" value="'.$parent2.'" name="parent2">
			<input type="submit" name="speichern" value="speichern"></td>
	</tr>
</table>';

	return $echo;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

if ($save) {
	global $arr_form, $art, $newpar;
	
	$db = "pdf_group";
	$id = "pgid";
	$pfad = "../secure/dfiles/vxcDfgH/";

	foreach($arr_form as $arr) {	
		$tmp = $arr[0];
		if ($tmp == "pgname") $val = eliminiere($_POST[$tmp]);
		else $val = $_POST[$tmp];
		
		if ($val) $sql .= $tmp. "='" .$val. "', ";
	}
		
	if ($neu) {
		$art = $_REQUEST["art"];
		$sql .= "pgart=". ($art ? $art : 1) . ($newpar ? ", parent=$newpar" : '');	
		$sql  = "INSERT $db set $sql";
		$res  = safe_query($sql);
		// $edit = mysqli_insert_id($mylink);
		unset($neu);
		// if ($art == 2) mkdir($pfad.eliminiere($_POST["pgname"]));
	}
	else {
		$sql .= "pgart=".$_POST["pgart"];	
		$sql = "UPDATE $db set $sql WHERE $id=$edit";
		$res = safe_query($sql);
		
		$sql = "UPDATE $db set pgart=".$_POST["pgart"]." WHERE parent=$edit";
		$res = safe_query($sql);

		$db = "pdf_group";
		$id = "pgid";
		$sql = "SELECT * FROM $db WHERE parent=".$edit."";
		$res = safe_query($sql); 
		while ($row = mysqli_fetch_object($res)) {
			$id  = $row->pgid;
			$sq = "UPDATE $db set pgart=".$_POST["pgart"]." WHERE parent=$id";
			$rs = safe_query($sq);
		}
	}	
	unset($edit);
}
elseif ($del) {
	$db = "pdf_group";
	$id = "pgid";

	$sql = "DELETE FROM $db WHERE $id=$del";
	$res = safe_query($sql);	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

if ($neu) 		echo neu("neu");
elseif ($edit) 	echo edit($edit);
else			echo $new.liste($parent,$parent2);

echo '
</form>
';

include("footer.php");

?>
