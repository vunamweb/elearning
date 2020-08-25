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
$id_pdf = $_REQUEST['id_pdf'];
$neworder = $_REQUEST['neworder'];
$filter = (int) $_REQUEST['filter'];
$language=$_GET['language'];
if($language=='')
  $language='germany';


///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Page1-Headline";
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id=vorschau>
	<h2>'.$titel.'</h2>';
if(isset($edit) && isset($id_pdf))
 echo '<p><a href="morp_page1-headline.php?id_pdf='.$id_pdf.'&language='.$language.'">&laquo; zur&uuml;ck</a></p>';
else if(isset($id_pdf))
 echo '<p><a href="morp_manage_pdf.php?page='.$id_pdf.'&language='.$language.'">&laquo; zur&uuml;ck</a></p>';


  echo'	<form action="" onsubmit="" name="verwaltung" method="post">
';

if($neworder) {
	$arr 		= array();
    $db = "page1_headline";
    $sql = "SELECT id FROM $db WHERE id_pdf=".$id_pdf." ORDER BY ordering";
	$res = safe_query($sql);

	while ($rw = mysqli_fetch_object($res)) $arr[] = $rw->id;

	$xx=0;
	foreach ($arr as $val) {
		$xx++;
		$sql  = "UPDATE $db SET ordering = $xx WHERE id=$val";
		safe_query($sql);
	}
}

if($filter)
{
    $type=$_GET['type'];
    $db = "page1_headline";
    $sql = "SELECT * FROM $db WHERE id_pdf=".$id_pdf."";
    $count=0;
    $res = safe_query($sql);
    while ($row = mysqli_fetch_object($res)) {
	  $count++;
    }
    //echo $count;
    switch($type)
    {
        case 'up' :
        {
            if($filter==1)
            {
               $sql = "SELECT * FROM $db WHERE ordering=".$count." and id_pdf=".$id_pdf."";
               $res = safe_query($sql);
               $row = mysqli_fetch_object($res);
               $sql="update $db set ordering=1 where id =".$row->id."";
               safe_query($sql);
               $sql="update $db set ordering=".$count." where id =".$id."";
               safe_query($sql);
            }
            else
            {
               $sql = "SELECT * FROM $db WHERE ordering=".($filter-1)." and id_pdf=".$id_pdf."";
               $res = safe_query($sql);
               $row = mysqli_fetch_object($res);
               $sql="update $db set ordering=".$filter." where id =".$row->id."";
               safe_query($sql);
               $sql="update $db set ordering=".($filter-1)." where id =".$id."";
               safe_query($sql);
            }
            break;
        }
        case 'down':
        {
            if($filter==$count)
            {
               $sql = "SELECT * FROM $db WHERE ordering=1 and id_pdf=".$id_pdf."";
               $res = safe_query($sql);
               $row = mysqli_fetch_object($res);
               $sql="update $db set ordering=".$count." where id =".$row->id."";
               safe_query($sql);
               $sql="update $db set ordering=1 where id =".$id."";
               safe_query($sql);
            }
            else
            {
               $sql = "SELECT * FROM $db WHERE ordering=".($filter+1)." and id_pdf=".$id_pdf."";
               $res = safe_query($sql);
               $row = mysqli_fetch_object($res);
               $sql="update $db set ordering=".$filter." where id =".$row->id."";
               safe_query($sql);
               $sql="update $db set ordering=".($filter+1)." where id =".$id."";
               safe_query($sql);
            }
        }
    }

 echo liste($id_pdf);
}
else if($del)
{
   $db = "page1_headline";
   $sql="delete from $db where id=".$del."";
   $res = safe_query($sql);
   echo liste($id_pdf);
}
else if($update)
{
   $db = "page1_headline";
   //set field value or value_english will be given
    if($language=='germany')
    {
      $title_colum="title";
      $text_colum="text";
    }
    else
    { 
      $title_colum="title_english";
      $text_colum="text_english";
    }  
     //
   $sql="update $db set $title_colum='".$title."', $text_colum='".$text."' where id=".$id."";
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
	//set field title or title_english will be inserted
    if($language=='germany')
    {
      $title_colum='title';
      $text_colum="text";
    }
    else
    {
      $title_colum='title_english';
      $text_colum="text_english"; 
    } 
    //
    echo "<br><p style='color:green'>Insert success</p>";
    $db = "page1_headline";
    $sql = "insert into $db(id_pdf,$title_colum,$text_colum)
    values(".$id_pdf.",'".$title."','".$text."')";
    $res = safe_query($sql);
    ?>
      <input type="text" name="title" placeholder="Enter title" /> <br /><br />
      <?php
        $oFCKeditor = new FCKeditor('text') ;
        $oFCKeditor->BasePath = '../fckeditor/';
        $oFCKeditor->Value = '';
        $oFCKeditor->Height=400;
        $oFCKeditor->Create() ;
      ?>
      <input type="hidden" name="save" value="save" />
      <input type="submit" value="Save" />
    <?php

}
else if($neu)
{
    ?>
      <input type="text" name="title" placeholder="Enter title" /> <br /><br />
      <?php
        $oFCKeditor = new FCKeditor('text') ;
        $oFCKeditor->BasePath = '../fckeditor/';
        $oFCKeditor->Value = '';
        $oFCKeditor->Height=400;
        $oFCKeditor->Create() ;
      ?>
      <input type="hidden" name="save" value="save" />
      <input type="submit" value="Save" />
    <?php
}
else
 echo liste($id_pdf);
echo '
</form>
';
if(!isset($id_pdf))
  echo '<p><a href="?neu=1&language='.$language.'">&raquo; NEU</a></p>';
else
  echo '<p><a href="?neu=1&id_pdf='.$id_pdf.'&language='.$language.'">&raquo; NEU</a></p>';

function edit($edit)
{
  $language=$_GET['language'];
  if($language=='')
    $language='germany';
  $db = "page1_headline";
  $id = "id";
  $sql = "SELECT * FROM $db WHERE $id=".$edit."";
  $res = safe_query($sql);
  $row = mysqli_fetch_object($res);
  //set field value or value_english will be given
    if($language=='germany')
    {
      $title=$row->title;
      $text=$row->text;
    }
    else
    { 
      $title=$row->title_english;
      $text=$row->text_english;
    } 
     //
  ?>
      <input type="text" name="title" value="<?php echo $title ?>"  /> <br /><br />
      <?php
        $oFCKeditor = new FCKeditor('text') ;
        $oFCKeditor->BasePath = '../fckeditor/';
        $oFCKeditor->Value = $text;
        $oFCKeditor->Height=400;
        $oFCKeditor->Create() ;
      ?>
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
	$db = "page1_headline";
	$id = "id";

	$ord = "ordering";
	////////////////////

	$echo .= '<p>&nbsp;</p><p><a href="?neworder=1&id_pdf='.$id_pdf.'"><i class="fa fa-sort-amount-asc"></i> Sortierung aktualisieren</a></p>
	<table width="100%" cellspacing="0" cellpadding="0" >';

	$old = '';
    if($id_pdf=="")
      $id_pdf=0;
    $sql = "SELECT * FROM $db WHERE id_pdf=".$id_pdf." ORDER BY ".$ord."";
    $res = safe_query($sql);

	while ($row = mysqli_fetch_object($res)) {
		$edit = $row->$id;
        $order=$row->ordering;
		/*get title */
        if($language=='germany')
        {
            if($row->title=='')
             $title=$row->title_english . '(Not tranlate to germany)';
            else
             $title=$row->title; 
        }
        else
        {
            if($row->title_english=='')
             $title=$row->title . '(Not tranlate to english)';
            else
             $title=$row->title_english;
        }
    /* end */ 
        $echo .= '<tr>
			<td width="300"><p><a href="?edit='.$edit.'&id_pdf='.$id_pdf.'&language='.$language.'">'.$title.' ('.$order.')</a></p></td>
			<td width="30"><p><a href="?id='.$edit.'&filter='.$order.'&type=up&id_pdf='.$id_pdf.'"><i style="font-size:12px" class="fa fa-arrow-up"></i></a></p></td>
			<td width="250"><p><a href="?id='.$edit.'&filter='.$order.'&type=down&id_pdf='.$id_pdf.'"><i style="font-size:12px" class="fa fa-arrow-down"></i></a></p></td>
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
