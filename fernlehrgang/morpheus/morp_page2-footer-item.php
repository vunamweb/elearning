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
$language=$_GET['language'];
if($language=='')
  $language='germany';

///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Tabellen 2 Spalten bearbeiten";
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id=vorschau>
	<h2>'.$titel.'</h2>';
if(isset($edit) && isset($id_pdf) || $neu)
 echo '<p><a href="morp_page2-footer-item.php?id_pdf='.$id_pdf.'&language='.$language.'">&laquo; zur&uuml;ck</a></p>';
else if(isset($id_pdf))
 echo '<p><a href="morp_manage_pdf.php?page='.$id_pdf.'&language='.$language.'">&laquo; zur&uuml;ck</a></p>';


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
   //set field title or title_english will be inserted
    if($language=='germany')
    {
      $name_colum='name';
      $value_colum='value';
    }
    else
    {
      $name_colum='name_english';
      $value_colum='value_english';
    } 
    //
   $sql="update $db set $name_colum='".$name."',$value_colum='".$value."' ,id_page2_footer=".$item." where id=".$id."";
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
	//set field title or title_english will be inserted
    if($language=='germany')
    {
      $name_colum='name';
      $value_colum='value';
    }
    else
    {
      $name_colum='name_english';
      $value_colum='value_english';
    } 
    //
    echo "<br><p style='color:green'>Insert success</p>";
    $db = "page2_footer_item";
	$sql = "insert into $db(id_page2_footer,$name_colum,$value_colum)values(".$item.",'".$name."' ,'".$value."') ";
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
	while ($row = mysqli_fetch_object($res)) {
		/*get name */
        if($language=='germany')
        {
            if($row->name=='')
             $name=$row->name_english . '(Not tranlate to germany)';
            else
             $name=$row->name; 
        }
        else
        {
            if($row->name_english=='')
             $name=$row->name . '(Not tranlate to english)';
            else
             $name=$row->name_english;
        }
    /* end */
        echo "<option value=".$row->id.">".$name."<option/>";
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
	while ($row = mysqli_fetch_object($res)) {
		/*get name */
        if($language=='germany')
        {
            if($row->name=='')
             $name=$row->name_english . '(Not tranlate to germany)';
            else
             $name=$row->name; 
        }
        else
        {
            if($row->name_english=='')
             $name=$row->name . '(Not tranlate to english)';
            else
             $name=$row->name_english;
        }
    /* end */
        echo "<option value=".$row->id.">".$name."</option>";
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
echo '<p><a href="?neu=1&id_pdf='.$id_pdf.'&language='.$language.'">&raquo; NEU</a></p>';
function edit($edit, $id_pdf)
{
  $language=$_GET['language'];
  if($language=='')
    $language='germany';
  $db = "page2_footer_item";
  $id = "id";
  $sql = "SELECT * FROM $db WHERE $id=".$edit."";
  $res = safe_query($sql);
  $row = mysqli_fetch_object($res);
  //set field value or value_english will be given
    if($language=='germany')
    {
      $name_item=$row->name;
      $value_item=$row->value;
    }
    else
    { 
      $name_item=$row->name_english;
      $value_item=$row->value_english;
    } 
     //
  $db = "page2_footer";
  $sql = "SELECT * FROM $db WHERE id_pdf=".$id_pdf." ORDER BY name";
	$res = safe_query($sql);
    echo "Item : <select name='item'>";
	while ($row1 = mysqli_fetch_object($res)) {
		/*get name */
        if($language=='germany')
        {
            if($row1->name=='')
             $name=$row1->name_english . '(Not tranlate to germany)';
            else
             $name=$row1->name;
        }
        else
        {
            if($row1->name_english=='')
             $name=$row1->name . '(Not tranlate to english)';
            else
             $name=$row1->name_english;
        }
    /* end */
        if($row->id_page2_footer==$row1->id)
          $selected="selected";
        else
          $selected="";
        echo "<option value=".$row1->id." ".$selected.">".$name."</option>";
	}
    echo "</select><br><br />";

  ?>
      <input type="text" name="name" value="<?php echo $name_item ?>" /> <br /><br />
      <input type="text" name="value" value="<?php echo $value_item ?>"  /> <br /><br />
      <input type="hidden" name="update" value="update" />
      <input type="hidden" name="id" value="<?php echo $row->id ?>" />
      <input type="submit" value="Update" />
  <?php

}
function liste($id_pdf) {
	$language=$_GET['language'];
    if($language=='')
      $language='germany';
    //// EDIT_SKRIPT
	$db = "page2_footer_item";
	$id = "id";

	$ord = "id_page2_header, name";
	$anz = "name";

	////////////////////

	$echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" >';

	$old = '';

	$sql = "SELECT b.name,b.name_english,a.name AS gruppe,a.name_english AS gruppe_english,b.value,b.value_english,b.id FROM page2_footer as a,page2_footer_item as b  WHERE a.id_pdf=".$id_pdf."
    and a.id=b.id_page2_footer order by a.name, b.name ";
	$res = safe_query($sql);

	while ($row = mysqli_fetch_object($res)) {
		/*get title */
        if($language=='germany')
        {
            //get name of parent
            if($row->gruppe=='')
             $gruppe=$row->gruppe_english . '(Not tranlate to germany)';
            else
             $gruppe=$row->gruppe;
            // get name of item
            if($row->name=='')
             $name=$row->name_english . '(Not tranlate to germany)';
            else
             $name=$row->name;
            //get value of item
            if($row->value=='')
             $value=$row->value_english . '(Not tranlate to germany)';
            else
             $value=$row->value;
               
        }
        else
        {
            //get name of parent
            if($row->gruppe_english=='')
             $gruppe=$row->gruppe . '(Not tranlate to english)';
            else
             $gruppe=$row->gruppe_english;
            // get name of item
            if($row->name_english=='')
             $name=$row->name . '(Not tranlate to english)';
            else
             $name=$row->name_english;
            //get value of item
            if($row->value_english=='')
             $value=$row->value . '(Not tranlate to english)';
            else
             $value=$row->value_english;
        }
    /* end */ 
        /// BJOERN ////
		if($old != $row->gruppe) {
			$echo .= '<tr>
			<td width="450" style="background:#666;color:#fff;"><p><b style="color:#fff;">'.$gruppe.'</b></p></td>
		</tr>';
			$old = $row->gruppe;
		}

		$edit = $row->$id;
		$echo .= '<tr>
			<td width="450"><p><a href="?edit='.$edit.'&id_pdf='.$id_pdf.'&language='.$language.'">'.$name.'</a></p></td>
            <td width="450"><p><a href="?edit='.$edit.'&id_pdf='.$id_pdf.'&language='.$language.'">'.$value.'</a></p></td>
            <td valign="top" width="50"><a href="?edit='.$edit.'&id_pdf='.$id_pdf.'&language='.$language.'"><i class="fa fa-pencil-square-o"></a></td>
			<td valign="top" width="50"><a href="?del='.$edit.'&id_pdf='.$id_pdf.'"><i class="fa fa-trash-o"></a></td>
			<td></td>
		</tr>';
	}

	$echo .= '</table><p>&nbsp;</p>';

	return $echo;
}
include("footer.php");

?>
