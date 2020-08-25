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
include("cms_include_checkbox.inc");

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
$id_pdf=$_REQUEST['id_pdf'];
$language="english";


///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Checkbox";
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id=vorschau>
	<h2>'.$titel.'</h2> 

	'. ($id_pdf ? '<p><a href="morp_manage_pdf.php?page='.$id_pdf.'&language='.$language.'">&laquo; zur&uuml;ck</a></p>' : '') . '
	<form action="" onsubmit="" name="verwaltung" method="post">
';
if($del)
{
   $db = "checkbox_english";
   $sql="delete from $db where id=".$del."";
   $res = safe_query($sql);
   echo liste(); 
}
else if($update)
{
   $db = "checkbox";
   $sql="update $db set title='".$title."' ,format_page=".$item." ,choose='".$choose."' where id=".$id."";
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
	$db = "checkbox_english";
	//delete all logo of the id pdf
    $sql="delete from pdf_checkbox_english where id_pdf=".$id_pdf."";
    safe_query($sql);
    $sql = "SELECT * FROM $db ";
	$res = safe_query($sql);
    while ($row = mysqli_fetch_object($res)) {
       $name='check'.$row->id;
       if($_POST[$name]!="")
       {
          $id_checkbox=$row->id;
          $sql = "insert into pdf_checkbox_english(id_pdf,id_checkbox)
          values(".$id_pdf.",".$id_checkbox.")";
          safe_query($sql);
       }
    }
  echo liste($id_pdf);
}
else if($neu)
{
    ?>
      <input type="text" name="title" placeholder="Enter title" /> <br /><br />
      <select name="item">
        <option value="1">Format1</option>
        <option value="2">Format2</option>
      </select><br /><br />
      <input type="checkbox" name="choose" /><br /><br />
      <input type="hidden" name="save" value="save" />
      <input type="submit" value="Save" />
    <?php
}
else
 echo liste($id_pdf);
echo '
</form>
';
function edit($edit)
{
  $db = "checkbox_english";
  $id = "id";
  $sql = "SELECT * FROM $db WHERE $id=".$edit."";
  $res = safe_query($sql);
  $row = mysqli_fetch_object($res);
  if($row->choose!="")
    $checked="checked";
  else
    $checked="";
  ?>
      <input type="text" name="title" value="<?php echo $row->title ?>" /> <br /><br />
      <br /><br />
      <input type="checkbox" name="choose" <?php echo $checked ?> /><br /><br />
      <input type="hidden" name="update" value="update" />
      <input type="hidden" name="id" value="<?php echo $row->id ?>" />
      <input type="submit" value="Update" />
  <?php
    
}
function liste($id_pdf) {
	//// EDIT_SKRIPT
	$db = "checkbox_english";
	$id = "id";

	$ord = "format_page";
	$anz = "title";

	////////////////////

	$echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" >
      <input type="submit" value="Save" />';

	$old = '';

	$sql = "SELECT * FROM $db WHERE 1 ORDER BY ".$anz."";
	$res = safe_query($sql);

	while ($row = mysqli_fetch_object($res)) {
		$edit = $row->$id;
		$echo .= '<tr>
			<td width="450"><p><a href="?edit='.$edit.'">'.$row->$anz.'</a></p></td>
            ';
        
        $sql="select * from pdf_checkbox_english where id_pdf=".$id_pdf." and id_checkbox=".$row->id." ";
        $res1 = safe_query($sql);
        $row1 = mysqli_fetch_object($res1);
        if($row1->id=="")
          $echo.= '<td width="450"><input type="checkbox" name="check'.$row->id.'"></td>';
        else
          $echo.= '<td width="450"><input type="checkbox" name="check'.$row->id.'" checked></td>';    
            
          $echo.= '
            <td></td>
		</tr>';
	}

	$echo .= '</table><input type="hidden" name="save" value="save" />
      <input type="submit" value="Save" />';

	return $echo;
}
include("footer.php");

?>
