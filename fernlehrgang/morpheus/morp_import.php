<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# bj�rn t. knetter                                  #
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
$titel			= "Import";
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

 $profile=GetProfile($edit);
  ?>
      <div class="profile-form">
                              <h3>User Profile</h3>
                              <br />
                              <h4><?php echo $message ?></h4>
                              <label>Anrede </label>
                              <select  name="title" id="title">

                                <option <?php if($profile->Anrede==1) echo "selected" ?> value="1">Herr</option>
                                <option <?php if($profile->Anrede==2) echo "selected" ?> value="2">Frau</option>
                              </select>
                              <label>Vorname</label>
                              <input type="text" name="Vorname" id="Vorname" value="<?php echo $profile->Vorname ?>"/>
                              <label>Name</label>
                              <input type="text" name="name" id="name" value="<?php echo $profile->Name ?>"/>
                              <label>Password</label>
                              <input type="password" name="password" id="password" value=""/>
                              <label>Confirm Password</label>
                              <input type="password" name="confirm_password" id="confirm_password" value=""/>

                              <label>Strasse</label>
                              <input type="text" name="Strasse" id="Strasse" value="<?php echo $profile->Strasse ?>"/>
                              <label>Hausnummer</label>
                              <input type="text" name="Hausnummer" id="Hausnummer" value="<?php echo $profile->Hausnummer ?>"/>
                              <label>Plz</label>
                              <input type="text" name="Plz" id="Plz" value="<?php echo $profile->Plz ?>"/>
                              <label>Ort</label>
                              <input type="text" name="ort" id="ort" value="<?php echo $profile->ort ?>"/>
                              <label>Country</label>
                              <?php GetCountry_profile($edit); ?>
                              <label>Geburtsdatum</label>
                              <input type="text" name="Geburtsdatum" id="Geburtsdatum" value="<?php echo $profile->Geburtsdatum  ?>"/>
                              <label>Schuhgrosse</label>
                              <input type="text" name="Schuhgrosse" id="Schuhgrsse" value="<?php echo $profile->Schuhgrosse  ?>"/>
                              <label>Email gesch</label>
                              <input type="email" name="email_gesch" id="email_gesch" value="<?php echo $profile->email_gesch  ?>" />
                              <label>Telefonnummer privat</label>
                              <input type="text" name="Telefonnummer_privat" id="Telefonnummer_privat" value="<?php echo $profile->telefonnummer_privat  ?>" />
                              <label>Telefonnummer geschaft</label>
                              <input type="text" name="Telefonnummer_geschaft" id="Telefonnummer_geschaft" value="<?php echo $profile->Telefonnummer_geschaft  ?>" />
                              <label>Beschaftigt bei</label>
                              <input type="text" name="Beschaftigt_bei" id="Beschaftigt_bei" value="<?php echo $profile->Beschaftigt_bei  ?>" />
                              <label>Beschaftigt als</label>
                              <input type="text" name="beschaftigt_als" id="beschaftigt_als" value="<?php echo $profile->beschaftigt_als  ?>" />
                              <label>Beschaftigt seit</label>
                              <input type="text" name="beschaftigt_seit" id="beschaftigt_seit" value="<?php echo $profile->beschaftigt_seit  ?>" />
                              <br />
                              <button type="submit">Save</button>
                              <input type="hidden" name="update" value="update" />
         </div>
  <?php

}
function liste() {
	 //delete all data of course
     $sql = 'delete from  morp_courses';
     safe_query($sql);
     
     $xml=simplexml_load_file("../questions/test.xml") or die("Error: Cannot create object");
      
     $courses=$xml->course;
     
     for($i=0; $i<count($courses); $i++){
        $name = $courses[$i]['name'];
        $color = $courses[$i]['color'];
        
        $sql = 'insert into morp_courses(name, color) values("'.$name.'", "'.$color.'")';
        safe_query($sql);
     }
     
     return 'import success';
}
include("footer.php");

?>
