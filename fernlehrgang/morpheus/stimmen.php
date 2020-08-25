<?
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

global $arr_form;

$edit 	= $_REQUEST["edit"];
$neu	= $_REQUEST["neu"];
$save	= $_REQUEST["save"];
$del	= $_REQUEST["del"];
$id		= $_REQUEST["id"];

echo '<div id=vorschau>
	<h2>Job Art</h2>

	'. ($edit || $neu ? '<p><a href="?pid='.$pid.'">&laquo; zur&uuml;ck</a></p>' : '') .'	
	<form action="" onsubmit="" name="verwaltung" method="post">
';

$new = '<p><a href="?neu=1">&raquo; NEU</a></p>';

$arr_form = array(
	array("name", "Name",'<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("beruf", "Beruf",'<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("text", "Text",'<textarea cols="" rows="15" name="#n#" style="#s#">#v#</textarea>'),
	array("textkurz", "Text kurz",'<textarea cols="" rows="5" name="#n#" style="#s#">#v#</textarea>'),
	array("bild", "Bild Name",'<input type="Text" value="#v#" name="#n#" style="#s#">'),
);


/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function liste() {
	$db = "morp_stimmen";
	$id = "id";
	$ord = "id";
	$anz = "name";
	$anz2 = "beruf";
	
	$echo .= '<p>&nbsp;</p><table width="100%">';

	$sql = "SELECT * FROM $db WHERE 1 ORDER BY ".$ord."";
	$res = safe_query($sql); 
		
	while ($row = mysqli_fetch_object($res)) {	
		$edit = $row->$id;
		$echo .= '<tr>
			<td width="600"><p><a href="?edit='.$edit.'"><strong>'.$row->$anz.'</strong> - '.$row->$anz2.'</a></p></td>
			<td valign="top"><a href="?edit='.$edit.'"><img src="images/edit.gif" alt="" width="18" height="10" border="0"></a></td>
			<td valign="top"><a href="?del='.$edit.'"><img src="images/delete.gif" alt="" width="9" height="10" border="0"></a></td>
		</tr>';
	}
	
	$echo .= '</table><p>&nbsp;</p>';

	return $echo;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function edit($edit) {
	global $arr_form;
	
	$db = "morp_stimmen";
	$id = "id";
	$ord = "id";
	$anz = "name";
	$anz2 = "beruf";

	$sql = "SELECT * FROM $db WHERE $id=".$edit."";
	$res = safe_query($sql); 
	$row = mysqli_fetch_object($res);
	
	$echo .= '<input type="Hidden" name="neu" value="'.$neu.'">
		<input type="Hidden" name="edit" value="'.$edit.'">
		<input type="Hidden" name="save" value="1">
	
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
	
	$echo .= '
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
	global $arr_form;

	$x = 0;
	
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
		<td><input type="submit" name="speichern" value="speichern"></td>
	</tr>
</table>';

	return $echo;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

if ($save) {
	global $arr_form;
	
	$db = "morp_stimmen";
	$id = "id";

	foreach($arr_form as $arr) {	
		$tmp = $arr[0];
		$val = $_POST[$tmp];

		if ($val) $sql .= $tmp. "='" .$val. "', ";
	}
	
	$sql = substr($sql, 0, -2);	
	
	if ($neu) {
		$sql  = "INSERT $db set $sql";
		$res  = safe_query($sql);
		$edit = mysqli_insert_id($mylink);
		unset($neu);
	}
	else {
		$sql = "update $db set $sql WHERE $id=$edit";
		$res = safe_query($sql);
	}	
}
elseif ($del) {
	$db = "morp_stimmen";
	$id = "id";

	$sql = "DELETE FROM $db WHERE $id=$del";
	$res = safe_query($sql);	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

if ($neu) 		echo neu("neu");
elseif ($edit) 	echo edit($edit);
else			echo liste($id).$new;

echo '
</form>
';

include("footer.php");

?>
