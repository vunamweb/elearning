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
$name= $_REQUEST["name"];
$value= $_REQUEST["value"];
$id_pdf=$_REQUEST['id_pdf'];


///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Tabellen 2 Spalten bearbeiten";
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id=vorschau>
	<h2>'.$titel.'</h2>';
if(isset($edit) && isset($id_pdf) || $neu)
 echo '<p><a href="morp_page2-footer-item.php?id_pdf='.$id_pdf.'">&laquo; zur&uuml;ck</a></p>';
else if(isset($id_pdf))
 echo '<p><a href="morp_manage_pdf.php?page='.$id_pdf.'">&laquo; zur&uuml;ck</a></p>';


  echo'	<form action="" onsubmit="" name="verwaltung" method="post">';

if($del)
{
   $db = "page2_footer_item";
   $sql="delete from $db where id=".$del."";
   $res = safe_query($sql);
   echo liste($id_pdf);
}
else if($update)
{
   $db = "page2_footer_item";
   $sql="update $db set name='".$name."',value='".$value."' ,id_page2_footer=".$item." where id=".$id."";
   //echo $sql;
   $res = safe_query($sql);
   echo "<p style='color:green'>Update success</p><br>";
   edit($edit, $id_pdf);
}
else if($edit)
{
   edit($edit, $id_pdf);
}
else if ($save) {
	echo "<br><p style='color:green'>Insert success</p>";
    $db = "page2_footer_item";
	$sql = "insert into $db(id_page2_footer,name,value)values(".$item.",'".$name."' ,'".$value."') ";
    //echo $sql;
	$res = safe_query($sql);
    // show form
    $db = "page2_footer";
	$id = "id";

	$ord = "name";
	$anz = "name";

	////////////////////



	$old = '';

	$sql = "SELECT * FROM $db WHERE id_pdf=".$id_pdf." ORDER BY ".$ord."";
	$res = safe_query($sql);
    echo "Item : <select name='item'>";
	while ($row = mysql_fetch_object($res)) {
		echo "<option value=".$row->id.">".$row->name."<option/>";
	}
    echo "</select><br><br />";
    ?>
      <input type="text" name="name" placeholder="Enter name" /> <br /><br />
      <input type="text" name="value" placeholder="Enter value" /> <br /><br />
      <input type="hidden" name="save" value="save" />
      <input type="submit" value="Save" />
    <?php

}
else if($neu)
{
    $db = "page2_footer";
	$id = "id";

	$ord = "name";
	$anz = "name";

	////////////////////



	$old = '';

	$sql = "SELECT * FROM $db WHERE id_pdf=".$id_pdf." ORDER BY ".$ord."";
	$res = safe_query($sql);
    echo "Item : <select name='item'>";
	while ($row = mysql_fetch_object($res)) {
		echo "<option value=".$row->id.">".$row->name."</option>";
	}
    echo "</select><br><br />";
    ?>
      <input type="text" name="name" placeholder="Enter name" /> <br /><br />
      <input type="text" name="value" placeholder="Enter value" /> <br /><br />
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
function edit($edit, $id_pdf)
{
  $db = "page2_footer_item";
  $id = "id";
  $sql = "SELECT * FROM $db WHERE $id=".$edit."";
  $res = safe_query($sql);
  $row = mysql_fetch_object($res);
  $db = "page2_footer";
  $sql = "SELECT * FROM $db WHERE id_pdf=".$id_pdf." ORDER BY name";
	$res = safe_query($sql);
    echo "Item : <select name='item'>";
	while ($row1 = mysql_fetch_object($res)) {
		if($row->id_page2_footer==$row1->id)
          $selected="selected";
        else
          $selected="";
        echo "<option value=".$row1->id." ".$selected.">".$row1->name."</option>";
	}
    echo "</select><br><br />";

  ?>
      <input type="text" name="name" value="<?php echo $row->name ?>" /> <br /><br />
      <input type="text" name="value" value="<?php echo $row->value ?>"  /> <br /><br />
      <input type="hidden" name="update" value="update" />
      <input type="hidden" name="id" value="<?php echo $row->id ?>" />
      <input type="submit" value="Update" />
  <?php

}
function liste($id_pdf) {
	//// EDIT_SKRIPT
	$db = "page2_footer_item";
	$id = "id";

	$ord = "id_page2_header, name";
	$anz = "name";

	////////////////////

	$echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" >';

	$old = '';

	$sql = "SELECT b.name,a.name AS gruppe,b.value,b.id FROM page2_footer as a,page2_footer_item as b  WHERE a.id_pdf=".$id_pdf."
    and a.id=b.id_page2_footer order by a.name, b.name ";
	$res = safe_query($sql);

	while ($row = mysql_fetch_object($res)) {
		/// BJOERN ////
		if($old != $row->gruppe) {
			$echo .= '<tr>
			<td width="450" style="background:#666;color:#fff;"><p><b style="color:#fff;">'.$row->gruppe.'</b></p></td>
		</tr>';
			$old = $row->gruppe;
		}

		$edit = $row->$id;
		$echo .= '<tr>
			<td width="450"><p><a href="?edit='.$edit.'&id_pdf='.$id_pdf.'">'.$row->$anz.'</a></p></td>
            <td width="450"><p><a href="?edit='.$edit.'&id_pdf='.$id_pdf.'">'.$row->value.'</a></p></td>
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
