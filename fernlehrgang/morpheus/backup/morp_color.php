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
$color	= $_REQUEST["color"];
$edit	= $_REQUEST["edit"];

///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Warengruppe";
///////////////////////////////////////////////////////////////////////////////////////
//get color
if ($save) {
	// check exist pdf
    $db = "6_color";
    $id = "id_pdf";
    $sql = "SELECT * FROM $db WHERE $id=".$edit."";
    $res = safe_query($sql);
    $row = mysql_fetch_object($res);
    //not exist
    if($row->value=="")
    {
        $sql = "insert into $db(id_pdf,value)
        values('".$edit."','".$color."')";
        $res = safe_query($sql);
    }
    // exist
    else
    {
        $sql = "update $db set value='".$color."' where id_pdf=".$edit."";
        $res = safe_query($sql);
    }
}

	$db = "6_color";
    $id = "id_pdf";
    $sql = "SELECT * FROM $db WHERE $id=".$edit."";
    $res = safe_query($sql);
    $row = mysql_fetch_object($res);
    $value=$row->value;
    echo '<div id=vorschau>';

	if($save) echo "<br><p style='color:green'>Update ".$color." success</p>";

    echo '<h2>'.$titel.'</h2>
    <p><a href="morp_manage_pdf.php?page='.$edit.'">&laquo; zur&uuml;ck</a></p><br/>
	'.'
	<form action="" onsubmit="" name="verwaltung" method="post">
		<div style="display:block; width:200px; height:30px;background:#'.$value.'"></div>
      <select name="color" style="font-size:14px;">';
       if($value=='e0cf5d')
         echo '<option selected style="color:#e0cf5d" value="e0cf5d">isolates</option>';
       else
         echo '<option style="color:#e0cf5d" value="e0cf5d">isolates</option>';

       if($value=='dca051')
         echo '<option selected style="color:#dca051" value="dca051">concentrates</option>';
       else
         echo '<option style="color:#dca051" value="dca051">concentrates</option>';

       if($value=='4670ba')
         echo '<option selected style="color:#4670ba" value="4670ba">textures</option>';
       else
         echo '<option style="color:#4670ba" value="4670ba">textures</option>';

       if($value=='8272b4')
         echo '<option selected style="color:#8272b4" value="8272b4">fibres</option>';
       else
         echo '<option style="color:#8272b4" value="8272b4">fibres</option>';

       if($value=='92b76d')
         echo '<option selected style="color:#92b76d" value="92b76d">lecithin</option>';
       else
         echo '<option style="color:#92b76d" value="92b76d">lecithin</option>';

       if($value=='3d99a9')
         echo '<option selected style="color:#3d99a9" value="3d99a9">soya beans</option>';
       else
         echo '<option style="color:#3d99a9" value="3d99a9">soya beans</option>';


      echo '</select>
      <input type="hidden" name="save" value="save" /><br/><br/>
      <input type="submit" value="Farbauswahl speichern" />
';
echo '
</form>
';

include("footer.php");

?>
