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
$color	= $_REQUEST["color"];
$neu	= $_REQUEST["neu"];
$edit	= $_REQUEST["edit"];
$title= $_REQUEST["title"];
$text= $_REQUEST["text"];
$id_pdf=$_REQUEST['id_pdf'];


///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Page2-Footer";
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id=vorschau>
	<h2>'.$titel.'</h2>';
    
if(isset($edit) && isset($id_pdf))
 echo '<p><a href="morp_page2-footer.php?id_pdf='.$id_pdf.'">&laquo; zur&uuml;ck</a></p>';
else if(isset($id_pdf))
 echo '<p><a href="morp_manage_pdf.php?page='.$id_pdf.'">&laquo; zur&uuml;ck</a></p>'; 


  echo'	<form action="" onsubmit="" name="verwaltung" method="post">';     


if($del)
{
   $db = "page2_footer";
   $sql="delete from $db where id=".$del."";
   $res = safe_query($sql);
   echo liste($id_pdf); 
}
else if($update)
{
   $db = "page2_footer";
   $sql="update $db set name='".$title."' where id=".$id."";
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
    $db = "page2_footer";
	$sql = "insert into $db(id_pdf,name)values(".$id_pdf.",'".$title."') ";
    //echo $sql;
	$res = safe_query($sql);
    echo liste($id_pdf);
}
else if($neu)
{
    ?>
      <input style="width: 300px;" type="text" name="title" placeholder="Enter title" /> <br /><br />
      <input type="hidden" name="save" value="save" />
      <input type="submit" value="Save" />
    <?php
}
else
 echo liste($id_pdf);
echo '
</form>
';
echo '<p><a href="?neu=1&id_pdf='.$id_pdf.'">&raquo; NEU</a></p>';
function edit($edit)
{
  $db = "page2_footer";
  $id = "id";
  $sql = "SELECT * FROM $db WHERE $id=".$edit."";
  $res = safe_query($sql);
  $row = mysql_fetch_object($res);
  ?>
      <input style="width: 300px;" type="text" name="title" value="<?php echo $row->name ?>"  /> <br /><br />
      <input type="hidden" name="update" value="update" />
      <input type="hidden" name="id" value="<?php echo $row->id ?>" />
      <input type="submit" value="Update" />
  <?php
    
}
function liste($id_pdf) {
	//// EDIT_SKRIPT
	$db = "page2_footer";
	$id = "id";

	$ord = "name";
	$anz = "name";

	////////////////////

	$echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" >';

	$old = '';

	$sql = "SELECT * FROM $db WHERE id_pdf=".$id_pdf." ORDER BY ".$ord."";
	$res = safe_query($sql);

	while ($row = mysql_fetch_object($res)) {
		$edit = $row->$id;
		$echo .= '<tr>
			<td width="450"><p><a href="?edit='.$edit.'&id_pdf='.$id_pdf.'">'.$row->$anz.'</a></p></td>
			<td valign="top" width="50"><a href="?edit='.$edit.'&id_pdf='.$id_pdf.'"><i class="fa fa-pencil-square-o"></a></td>
			<td valign="top" width="50"><a href="?del='.$edit.'&id_pdf='.$id_pdf.'"><i class="fa fa-trash-o"></a></td>
			<td></td>
		</tr>';
	}

	$echo .= '</table><p>&nbsp;</p>';

	return $echo;
}
include("footer.php");

?>
