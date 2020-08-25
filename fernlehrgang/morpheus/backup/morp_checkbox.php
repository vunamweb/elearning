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

// print_r($_REQUEST);

global $arr_form;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
// NICHT VERAENDERN ///////////////////////////////////////////////////////////////////
$save	= $_REQUEST["save"];
$edit	= $_REQUEST["edit"];
$update	= $_REQUEST["update"];
$del	= $_REQUEST["del"];
$id	= $_REQUEST["id"];
$item	= $_REQUEST["item"];
$neu	= $_REQUEST["neu"];
$edit	= $_REQUEST["edit"];
$title= $_REQUEST["title"];
$choose= $_REQUEST["choose"];


///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Checkbox";
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id=vorschau>
	<h2>'.$titel.'</h2> 

	'. ($edit || $neu ? '<p><a href="?pid='.$pid.'">&laquo; zur&uuml;ck</a></p>' : '') . 
     '
    <form action="" onsubmit="" name="verwaltung" method="post">
';
if($del)
{
   $db = "checkbox";
   $sql="delete from $db where id=".$del."";
   $res = safe_query($sql);
   echo liste(); 
}
else if($update)
{
   $db = "checkbox";
   $sql="update $db set title='".$title."' ,format_page=".$item." where id=".$id."";
   //echo $sql;
   $res = safe_query($sql); 
   echo "<p style='color:green'>Update success</p><br>";
   edit($edit);
} 
else if($edit)
{
   edit($edit); 
} 
else if ($save) {
	echo "<br><p style='color:green'>Insert success</p>";
    $db = "checkbox";
    $sql = "insert into $db(title,format_page)values('".$title."',".$item.")";
    //echo $sql;
	$res = safe_query($sql);
    echo liste();
}
else if($neu)
{
    ?>
      <input type="text" name="title" placeholder="Enter title" /> <br /><br />
      <select name="item">
        <option value="1">Format1</option>
        <option value="2">Format2</option>
      </select><br /><br />
      <input type="hidden" name="save" value="save" />
      <input type="submit" value="Save" />
    <?php
}
else
 echo liste();
echo '
</form>
';
//echo '<p><a href="?neu=1">&raquo; NEU</a></p>';
function edit($edit)
{
  $db = "checkbox";
  $id = "id";
  $sql = "SELECT * FROM $db WHERE $id=".$edit."";
  $res = safe_query($sql);
  $row = mysql_fetch_object($res);
  if($row->choose!="")
    $checked="checked";
  else
    $checked="";
  ?>
      <input type="text" name="title" value="<?php echo $row->title ?>" /> <br /><br />
      <select name="item">
        <option value="1" <?php if($row->format_page=='1') echo 
        "selected" ?>>Format1</option>
        <option value="2" <?php if($row->format_page=='2') echo 
        "selected" ?>>Format2</option>
      </select><br /><br />
      <input type="hidden" name="update" value="update" />
      <input type="hidden" name="id" value="<?php echo $row->id ?>" />
      <input type="submit" value="Update" />
  <?php
    
}
function liste() {
	//// EDIT_SKRIPT
	$db = "checkbox";
	$id = "id";

	$ord = "format_page";
	$anz = "title";

	////////////////////

	$echo.='<p><a href="?neu=1">&raquo; NEU</a></p>';
    $echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" >';

	$old = '';

	$sql = "SELECT * FROM $db WHERE 1 ORDER BY ".$ord."";
	$res = safe_query($sql);

	while ($row = mysql_fetch_object($res)) {
		$edit = $row->$id;
		$echo .= '<tr>
			<td width="450"><p><a href="?edit='.$edit.'">'.$row->$anz.'</a></p></td>
            <td width="450"><p>Format'.$row->format_page.'</p></td>
            <td valign="top" width="50"><a href="?edit='.$edit.'"><i class="fa fa-pencil-square-o"></a></td>
			<td valign="top" width="50"><a href="?del='.$edit.'"><i class="fa fa-trash-o"></a></td>
			<td></td>
		</tr>';
	}

	$echo .= '</table><p><a href="?neu=1">&raquo; NEU</a></p>';

	return $echo;
}
include("footer.php");

?>
