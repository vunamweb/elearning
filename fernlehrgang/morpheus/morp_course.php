<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
# edit 27.11.2006                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #
error_reporting(0);
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
$type=$_REQUEST['type'];
$add=$_REQUEST['add'];
$page=$_REQUEST['page'];
$download=$_REQUEST['download'];
$view=$_REQUEST['view'];
$active=$_REQUEST['active'];
//echo $update .'ddd';
///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Test online";
$titel			= "Course";
///////////////////////////////////////////////////////////////////////////////////////


//////   BJOERN EDIT //////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

echo '<div id=vorschau>
	'.($name_of_product ? $name_of_product.'<br><br>' : '<h2>'.$titel.'</h2>').'

	'. ($edit || $neu || $view ? '<p><a href="?pid='.$pid.'">&laquo; zur&uuml;ck</a></p>' : '').
    '<form action="" onsubmit="" name="verwaltung" method="post">'
     ;
if(isset($active))
{
   $sql="update user_test_active set active=1 where id_user=".$active."";
   safe_query($sql);
   echo liste();
}
else if($del)
{

   $sql="delete from user where uid=".$del."";
   $res = safe_query($sql);
   echo liste();
}
else if($update)
{
    //echo 'dd' ;die();
    $password=md5($_POST['password']);

    $email=$_POST['email'];
    $token=md5(uniqid(rand(30,100), true));
    $anrede=$_POST['title'];
    $Vorname=$_POST['Vorname'];
    $name1=$_POST['name'];
    $Strasse=$_POST['Strasse'];
    $Hausnummer=$_POST['Hausnummer'];
    $Plz=$_POST['Plz'];
    $ort=$_POST['ort'];
    $country=$_POST['country'];
    $Geburtsdatum=$_POST['Geburtsdatum'];
    $Schuhgrosse=$_POST['Schuhgrosse'];
    $email_gesch=$_POST['email_gesch'];
    $Telefonnummer_privat=$_POST['Telefonnummer_privat'];
    $Telefonnummer_geschaft=$_POST['Telefonnummer_geschaft'];
    $Beschaftigt_bei=$_POST['Beschaftigt_bei'];
    $beschaftigt_als=$_POST['beschaftigt_als'];
    $beschaftigt_seit=$_POST['beschaftigt_seit'];
    if($_POST['password']=="")
        $sql="update user set Name='".$name1."',Anrede=".$anrede.",Vorname='".$Vorname."',Strasse='".$Strasse."',
        Hausnummer='".$Hausnummer."',Plz='".$Plz."',ort='".$ort."',land=".$country.",Geburtsdatum='".$Geburtsdatum."',Schuhgrosse ='".$Schuhgrosse."',
        email_gesch ='".$email_gesch."',telefonnummer_privat ='".$Telefonnummer_privat."',Telefonnummer_geschaft  ='".$Telefonnummer_geschaft."',
        Beschaftigt_bei='".$Beschaftigt_bei."',beschaftigt_als='".$beschaftigt_als."',beschaftigt_seit='".$beschaftigt_seit."' where uid=".$edit."";
    else
        $sql="update user set Name='".$name1."',pw='".$password."',Anrede=".$anrede.",Vorname='".$Vorname."',Strasse='".$Strasse."',
        Hausnummer='".$Hausnummer."',Plz='".$Plz."',ort='".$ort."',land=".$country.",Geburtsdatum='".$Geburtsdatum."',Schuhgrosse ='".$Schuhgrosse."',
        email_gesch ='".$email_gesch."',telefonnummer_privat ='".$Telefonnummer_privat."',Telefonnummer_geschaft  ='".$Telefonnummer_geschaft."',
        Beschaftigt_bei='".$Beschaftigt_bei."',beschaftigt_als='".$beschaftigt_als."',beschaftigt_seit='".$beschaftigt_seit."' where uid=".$edit."";
    safe_query($sql);
   echo "<p style='color:green'>Update success</p><br>";
   edit($edit);
}
else if($edit)
{
  edit($edit);
}

 else
 echo liste();
   //echo '<p><a href="?neu=1&language='.$language.'">&raquo; NEU</a></p>';

echo '
</form>
';
function edit($edit)
{

 $course=Getcourse($edit);
  ?>
      <div class="profile-form">
                              
                              <label>Name</label>
                              <input type="text" name="name" id="name" value="<?php echo $course->name ?>"/>
                              <label>Color</label>
                              <input type="text" name="color" id="color" value="<?php echo $course->color ?>"/>
                              <br />
                              <button type="submit">Save</button>
                              <input type="hidden" name="update" value="update" />
         </div>
  <?php

}
function liste() {
	//// EDIT_SKRIPT
	$db = "morp_courses";
	$id = "id";

	$ord = "name";
    $language=$_GET['language'];
    if($language=='')
      $language='germany';
    ////////////////////

	$echo .= '<p>&nbsp;</p>
			<table width="100%" cellspacing="0" cellpadding="0" class="p20 autocol" >
               <tr>
                <td>Name</td>
                <td align="center">Color</td>
               </tr>
             ';

	$old = '';

	$sql = "SELECT * FROM $db ORDER BY ".$ord."";
	$res = safe_query($sql);

	while ($row = mysqli_fetch_object($res)) {
		$edit = $row->$id;
        //get current test
        $sql="select * from user_test_active where id_user=".$row->uid." ORDER BY test DESC";
        $res1 = safe_query($sql);
        $row1 = mysqli_fetch_object($res1);
        //if is first time
        if($row1->id=="")
        {
            $test=1;
            $status='<p>Zur 1. Prüfung angemeldet und aktiviert</p>';
        }
        // if active next test
        else if($row1->active==1 && $row1->test == 6)
        {
            $test=$row1->test;
            $status='<p><span style="color:blue; font-weight:bold;">Prüfung bestaden</span></p>';
        }
        else if($row1->active==1)
        {
            $test=$row1->test;
            $status='<p>Prüfung '.$row1->test.' steht aus</p>';
        }
      //if not active next test
      else if($row1->active==0)
        {
	        ///// NOTICE - bjoern 2017-02-08 !!!!!!
	        /* if test == 5 user has certificate *****************************************************************/
            $test=$row1->test;
            $status='<a href="?active='.$row->uid.'">Nächste Prüfung '.$row1->test.' aktivieren</a>';
        }
        $echo .= '<tr>
         <td><a href="morp_course.php?edit='.$row->id.'">'.$row->name.'</a></td>
         <td><a href="morp_course.php?edit='.$row->id.'">'.$row->color.'</a></td>
        </tr>';
	}

	$echo .= '</table><p>&nbsp;</p>';

	return $echo;
}
include("footer.php");

?>
