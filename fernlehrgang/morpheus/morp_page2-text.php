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
include("editor.php");
// print_r($_REQUEST);

global $arr_form;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
// NICHT VERAENDERN ///////////////////////////////////////////////////////////////////
$save	= $_REQUEST["save"];
$text	= $_REQUEST["text"];
$edit=$_REQUEST['edit'];
$language=$_GET['language'];
if($language=='')
  $language='germany';

///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Page 2 text";
///////////////////////////////////////////////////////////////////////////////////////
if ($save) {
	// check exist pdf
    $db = "page2_text";
    $id = "id_pdf";
    $sql = "SELECT * FROM $db WHERE $id=".$edit."";
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    //set field value or value_english will be given
    if($language=='germany')
    {
      $field="value";
    }
    else
    { 
      $field="value_english";
    } 
     //
    //not exist
    if($row->id=="")
    {
        $sql = "insert into $db(id_pdf,$field)
        values('".$edit."','".$text."')";
        //echo $sql;die();
        $res = safe_query($sql);
    }
    // exist
    else
    {
        $sql = "update $db set $field='".$text."' where id_pdf=".$edit."";
        //echo $sql ;die();
        $res = safe_query($sql);
    }
}

echo '<div id=vorschau>
	<h2>'.$titel.'</h2>

	'.($edit || $neu ? '<p><a href="morp_manage_pdf.php?page='.$edit.'&language='.$language.'">&laquo; zur&uuml;ck</a></p>' : '')
    .'
	<form action="" onsubmit="" name="verwaltung" method="post">
      ';
    if($save)
     echo "<br><p style='color:green'>Update success</p>";
    $db = "page2_text";
    $sql = "SELECT * FROM $db where id_pdf=".$edit."";
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    //set field value or value_english will be given
    if($language=='germany')
    {
      $name=$row->value;
    }
    else
    { 
      $name=$row->value_english;
    } 
     // 
	echo '<textarea class="tiny" name="text" style="width:750px;height:500px;">'.$name.'</textarea>
       <input type="hidden" name="save" value="save" />
      <input type="submit" value="save" />
    ';
echo '
</form>
';

include("footer.php");

?>
