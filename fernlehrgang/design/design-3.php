<?php
$id=$_GET['profile'];
$checkuser = $_SESSION["id_user"];

if($checkuser != $id) die('<br><br><h2 style="text-align:center">Zugang verwehrt. Sie haben keien Berechtigung.</h2>');

if($_POST)
{
    $name=$_POST['username'];
	$password = '';

    $confirm_password = $_POST['confirm_password'];
    $check_password	= $_POST['password'];

	if($confirm_password && $check_password) {
		if($confirm_password == $check_password) $password=md5($check_password);
	}

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
        Beschaftigt_bei='".$Beschaftigt_bei."',beschaftigt_als='".$beschaftigt_als."',beschaftigt_seit='".$beschaftigt_seit."' where uid=".$id."";
    else
        $sql="update user set Name='".$name1."',pw='".$password."',Anrede=".$anrede.",Vorname='".$Vorname."',Strasse='".$Strasse."',
        Hausnummer='".$Hausnummer."',Plz='".$Plz."',ort='".$ort."',land=".$country.",Geburtsdatum='".$Geburtsdatum."',Schuhgrosse ='".$Schuhgrosse."',
        email_gesch ='".$email_gesch."',telefonnummer_privat ='".$Telefonnummer_privat."',Telefonnummer_geschaft  ='".$Telefonnummer_geschaft."',
        Beschaftigt_bei='".$Beschaftigt_bei."',beschaftigt_als='".$beschaftigt_als."',beschaftigt_seit='".$beschaftigt_seit."' where uid=".$id."";

    // echo $sql;

    safe_query($sql);
    $message="Ihr Profil wurde erfolgreich geändert.";
}


$profile=GetProfile($id);


// print_r($_SESSION);
// id_user
?>


<section id="slide_tabs" class="dark_section bg_image">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-page">
                            <form class="profile-form" method="post" action="">
	 					  	  <h3>Benutzer Profil</h3>
                              <br />
                              <h4><?php echo $message ?></h4>
							<span>
                              <label>Anrede </label>
                              	<input type="hidden" name="title" id="title" value="<?php echo $profile->Anrede==1 ? "1" : "2"; ?>">
							  	<input name="tmp" id="tmp" value="<?php echo $profile->Anrede==1 ? "Herr" : "Frau"; ?>" readonly>
							</span>
							<span>
                              <label>Vorname</label>
                              <input type="text" name="Vorname" id="Vorname" value="<?php echo $profile->Vorname ?>"/>
							</span>
							<span>
                              <label>Name</label>
                              <input type="text" name="name" id="name" value="<?php echo $profile->Name ?>"/>
							</span>
							<span>


<!--                              <label>Password</label>
                              <input type="password" name="password" id="password" value=""/>
                              <label>Confirm Password</label>
                              <input type="password" name="confirm_password" id="confirm_password" value=""/>
-->


                              <label>Strasse</label>
                              <input type="text" name="Strasse" id="Strasse" value="<?php echo $profile->Strasse ?>"/>
							</span>
							<span>
                              <label>Hausnummer</label>
                              <input type="text" name="Hausnummer" id="Hausnummer" value="<?php echo $profile->Hausnummer ?>"/>
							</span>
							<span>
                              <label>PLZ</label>
                              <input type="text" name="Plz" id="Plz" value="<?php echo $profile->Plz ?>"/>
							</span>
							<span>
                              <label>Ort</label>
                              <input type="text" name="ort" id="ort" value="<?php echo $profile->ort ?>"/>
							</span>
							<span>
                              <label>Land</label>
                              <?php GetCountry_profile($profile->land); ?>
							</span>
							<span>
                              <label>Geburtsdatum</label>
                              <input type="text" name="Geburtsdatum" id="Geburtsdatum" value="<?php echo $profile->Geburtsdatum  ?>"/>
							</span>
							<span>
                              <label>Schuhgröße</label>
                              <input type="text" name="Schuhgrosse" id="Schuhgrsse" value="<?php echo $profile->Schuhgrosse  ?>"/>
							</span>
							<span>
                              <label>E-Mail geschäftlich</label>
                              <input type="email" name="email_gesch" id="email_gesch" value="<?php echo $profile->email_gesch  ?>" />
							</span>
							<span>
                              <label>Telefonnummer privat</label>
                              <input type="text" name="Telefonnummer_privat" id="Telefonnummer_privat" value="<?php echo $profile->telefonnummer_privat  ?>" />
							</span>
							<span>
                              <label>Telefonnummer geschäftlich</label>
                              <input type="text" name="Telefonnummer_geschaft" id="Telefonnummer_geschaft" value="<?php echo $profile->Telefonnummer_geschaft  ?>" />
							</span>
							<span>
                              <label>Beschäftigt bei</label>
                              <input type="text" name="Beschaftigt_bei" id="Beschaftigt_bei" value="<?php echo $profile->Beschaftigt_bei  ?>" />
							</span>
							<span>
                              <label>Beschäftigt als</label>
                              <input type="text" name="beschaftigt_als" id="beschaftigt_als" value="<?php echo $profile->beschaftigt_als  ?>" />
							</span>
							<span>
                              <label>Beschäftigt seit</label>
                              <input type="text" name="beschaftigt_seit" id="beschaftigt_seit" value="<?php echo $profile->beschaftigt_seit  ?>" />
							</span>

                              <br />
                              <button type="submit">Save</button>


<?php
	/* Prüfe ob User bestanden ***************************************************/
	$sql = "SELECT test FROM `user_test_active` WHERE id_user = ".$_SESSION[id_user]." ORDER BY `test` DESC LIMIT 0,1";
	$res = safe_query($sql);
	$row = mysqli_fetch_object($res);
	$test = $row->test;
	if($test > 5) {
?>
		<p><br><br><a href="zertifikat.php"><i class="fa fa-download"></i> Zertifikat erneut Drucken/Speichern</a></p>

<?php	}
/* _________________ Prüfe ob User bestanden */

?>
                            </form>


                   </div>
               </div> <!-- .col-sm-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section><!-- #slide_tabs -->


