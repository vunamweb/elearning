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
$titel			= "Page1-Logo";
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id=vorschau>
	<h2>'.$titel.'</h2> 

	'. ($id_pdf ? '<p><a href="morp_manage_pdf.php?page='.$id_pdf.'">&laquo; zur&uuml;ck</a></p>' : '') . '
	<form action="" onsubmit="" name="verwaltung" method="post" enctype="multipart/form-data">
';
if($del)
{
   $db = "page1_logo";
   $sql="delete from $db where id=".$del."";
   $res = safe_query($sql);
   echo liste(); 
}
else if($update)
{
    echo "<br><p style='color:green'>Upload success</p>";
    $db = "page1_logo";
	$upload='upload_logo';
    $filename=$_FILES['file']['name'];
    if($_POST['status']!="")
      $status=1;
    else
      $status=0;  
    $sql = "update $db set status=$status where id=".$id."";
    $res = safe_query($sql);
    if($filename !="")
    {
        $tmp_filename=$_FILES['file']['tmp_name'];
        move_uploaded_file($tmp_filename, "$upload/$filename");
        $sql = "update $db set image='".$filename."' where id=".$id."";
        $res = safe_query($sql);
    }
    echo liste();
    
} 
else if($edit)
{
   edit($edit); 
} 
else if ($save) {
	$db = "pdf";
	//delete all logo of the id pdf
    $sql="delete from page1_logo where id_pdf=".$id_pdf."";
    safe_query($sql);
    $sql = "SELECT * FROM $db ";
	$res = safe_query($sql);
    while ($row = mysqli_fetch_object($res)) {
       $name='check'.$row->pid;
       if($_POST[$name]!="")
       {
          $id_logo=$row->pid;
          $image=$row->pname;
          $sql = "insert into page1_logo(id_pdf,id_logo,image)
          values(".$id_pdf.",".$id_logo.",'".$image."')";
          safe_query($sql);
       }
    }
  echo liste($id_pdf);  
}
else if($neu)
{
    ?>
      Logo: <input type="file" name="file" /> <br /><br />
      <input type="hidden" name="save" value="save" />
      <input type="submit" value="Upload" />
    <?php
}
else
 echo liste($id_pdf);
echo '
</form>
';
function edit($edit)
{
  $db = "page1_logo";
  $id = "id";
  $sql = "SELECT * FROM $db WHERE $id=".$edit."";
  $res = safe_query($sql);
  $row = mysqli_fetch_object($res);
  if($row->status==1)
    $check="checked";
  else
    $check="";
  ?>
      Logo: <input type="file" name="file" /> <br /><br />
      <input type="checkbox" name="status" <?php echo $check ?> /> Show <br /><br />
      <input type="hidden" name="update" value="update" />
      <input type="hidden" name="id" value="<?php echo $row->id ?>" />
      <input type="submit" value="Update" />  
  <?php
    
}
function liste($id_pdf) {
	//// EDIT_SKRIPT
	$db = "pdf";
	$id = "id";

	$ord = "image";
	$anz = "image";

	////////////////////

	$echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" >';

	$old = '';

	$sql = "SELECT * FROM $db ";
	$res = safe_query($sql);

	while ($row = mysqli_fetch_object($res)) {
		$echo .= '<tr>
			<td width="450"><img width="50" src="../pdf/'.$row->pname.'" /></td>';
        $sql="select * from page1_logo where id_pdf=".$id_pdf." and id_logo=".$row->pid." ";
        $res1 = safe_query($sql);
        $row1 = mysqli_fetch_object($res1);
        if($row1->id=="")
          $echo.= '<td valign="top" width="50"><input type="checkbox" name="check'.$row->pid.'"></td>';
        else
          $echo.= '<td valign="top" width="50"><input type="checkbox" name="check'.$row->pid.'" checked></td>';
              
         $echo.= '</tr>';
	}

	$echo .= '</table>
              <input type="hidden" name="save" value="save"/> 
              <input type="submit" value="Save"/>
              </form> 
              ';

	return $echo;
}
include("footer.php");

?>
