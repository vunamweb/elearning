<?php
//active account
if(isset($_GET['token']))
{
    $sql="update user set active=1 where token='".$_GET[token]."'";
    safe_query($sql);
    $message="Vielen Dank! Ihr Account wurde aktiviert. Sie k&ouml;nnen mit dem Fernlehrgang starten.";

/*            //send email to this user
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $messag=	$emailLogo."$format<br><br>Anbei erhalten Sie einen Link, mit dem Sie Ihr Passwort zur&uuml;cksetzen k&ouml;nnen:<br><br>";
            $messag.=$token."</p>";
            //echo $message;
            $subject="Token f&uuml;r ein vergessenes Passwort";
            mail($_POST['email_forgot_pw'],$subject,$messag,$headers);
*/
}
?>
<section id="slide_tabs" class="dark_section bg_image">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!--<h4 class="title_form"> <?php echo $message; ?>  </h4> !-->
                    <div class="login-page">
                          <div class="form">
                            <a class="navbar-brand" href="<?php echo $dir; ?>"><img src="<?php echo $dir; ?>img/logo.png" class="img-responsive" alt=""></a>
                            <form class="forgotpassword-form" method="post" action="index.php" style="display: none;">
                              <h3 class="message_forgotpassword">Bitte geben Sie Ihre E-Mail an.</h3>
                              <input type="email" name="email" id="email" required placeholder="E-Mail"/>
                              <input type="text" name="token" id="token" required placeholder="Token" value="token"/>
                              <input type="password" name="password" id="password" required placeholder="Neues Passwort" value="ssss"/>
                              <input type="password" name="confirm_password" id="confirm_password" required placeholder="Passwort wiederholen" value="sssss"/>

                              <button type="submit">Absenden</button>

                              <p class="message">Bereits registriert? <a choose="4" href="javascript:void(0)">Einloggen</a></p>
                            </form>

                            <form class="register-form" method="post" action="index.php">
	 					  	  <h3>Willkommen beim chung shi Fernlehrgang.</h3>
                              <p>Bitte f&uuml;llen Sie alle Felder zur Anmeldung aus.</p>
                              <select  name="title" id="title" required>
                                <option value="">Anrede</option>
                                <option value="1">Herr</option>
                                <option value="2">Frau</option>
                              </select>
                              <input type="text" name="Vorname" id="Vorname" required placeholder="Vorname"/>
                              <input type="text" name="name" id="name" required placeholder="Name"/>
                              <input type="email" name="email" id="email" required placeholder="E-Mail f&uuml;r Kontakt und Login" />
<!--                              <input  type="text" name="username" id="username" required placeholder="UserName" value="username"/>-->
                              <input type="password" name="password" id="password" required placeholder="Passwort"/>
                              <input type="password" name="confirm_password" id="confirm_password" required placeholder="Passwort wiederholen"/>
                              <input type="text" name="Strasse" id="Strasse" required placeholder="Strasse"/>
                              <input type="text" name="Hausnummer" id="Hausnummer" required placeholder="Hausnummer"/>
                              <input type="text" name="Plz" id="Plz" required placeholder="Plz"/>
                              <input type="text" name="ort" id="ort" required placeholder="Ort"/>
                              <?php GetCountry(); ?>
                              <input type="text" name="Geburtsdatum" id="Geburtsdatum" required placeholder="Geburtsdatum"/>
                              <input type="text" name="Schuhgrosse" id="Schuhgrsse" required placeholder="Schuhgr&ouml;sse"/>
                              <input type="email" name="email_gesch" id="email_gesch" required placeholder="E-Mail gesch&auml;ftlich" />
                              <input type="text" name="Telefonnummer_privat" id="Telefonnummer_privat" required placeholder="Telefonnummer privat" />
                              <input type="text" name="Telefonnummer_geschaft" id="Telefonnummer_geschaft" required placeholder="Telefonnummer gesch&auml;ftlich" />
                              <input type="text" name="Beschaftigt_bei" id="Beschaftigt_bei" required placeholder="Besch&auml;ftigt bei" />
                              <input type="text" name="beschaftigt_als" id="beschaftigt_als" required placeholder="Besch&auml;ftigt als" />
                              <input type="text" name="beschaftigt_seit" id="beschaftigt_seit" required placeholder="Besch&auml;ftigt seit" />
                              <button type="submit">Account erstellen</button>
                              <h4 class="title_form"> <?php echo $message; ?>  </h4>
                              <p class="message">Bereits registriert? <a href="javascript:void(0)">Einloggen</a></p>
                            </form>
                            <form class="login-form" method="post" action="index.php">
                              <h4 class="title_form"> <?php echo $message; ?>  </h4>
                              <input type="email" name="email" id="email" required placeholder="E-Mail"/>
                              <input type="password" name="password" id="password" required placeholder="Passwort"/>
                              <input type="hidden" name="login" />
                              <button type="submit">Login</button>

                              <p class="message">Noch nicht registriert? <a href="javascript:void(0)">Erstellen Sie einen Account</a></p>
                              <p class="text-center message"><a choose="3" href="javascript:void(0)">Passwort vergessen</a></p>
                            </form>
                          </div>
                   </div>
               </div> <!-- .col-sm-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section><!-- #slide_tabs -->


