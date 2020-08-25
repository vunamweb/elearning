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
$text	= $_REQUEST["text"];
$edit=$_REQUEST['edit'];

///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Produktbezeichnung";
///////////////////////////////////////////////////////////////////////////////////////
if ($save) {
	// check exist pdf
    $db = "page1_text_top";
    $id = "id_pdf";
    $sql = "SELECT * FROM $db WHERE $id=".$edit."";
    $res = safe_query($sql);
    $row = mysql_fetch_object($res);
    //not exist
    if($row->value=="")
    {
        $sql = "insert into $db(id_pdf,value)
        values('".$edit."','".$text."')";
        $res = safe_query($sql);
    }
    // exist
    else
    {
        $sql = "update $db set value='".$text."' where id_pdf=".$edit."";
        $res = safe_query($sql);
    }
}

echo '<div id=vorschau>
	<h2>'.$titel.'</h2>

	'.($edit || $neu ? '<p><a href="morp_manage_pdf.php?page='.$edit.'">&laquo; zur&uuml;ck</a></p>' : '')
    .'
	<form action="" onsubmit="" name="verwaltung" method="post">
      ';
    if($save)
     echo "<br><p style='color:green'>Update success</p>";
    $db = "page1_text_top";
    $sql = "SELECT * FROM $db where id_pdf=".$edit."";
    $res = safe_query($sql);
    $row = mysql_fetch_object($res);

    echo '<textarea class="tiny" name="text" style="width:750px;height:500px;">'.$row->value.'</textarea>
       <input type="hidden" name="save" value="save" />
      <input type="submit" value="save" />
    ';
echo '
</form>
';

include("footer.php");

?>
