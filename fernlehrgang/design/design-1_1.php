<?php
//active account
if(isset($_GET['token']))
{
    $sql="update user set active=1 where token='".$_GET[token]."'";
    safe_query($sql);
    $message="Your account has actived , you can now login";
}
?>
<section id="slide_tabs" class="dark_section bg_image">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="title_form"> <?php echo $message; ?>  </h4>
                    <div class="login-page">
                          <div class="form">
                            <form class="register-form" method="post" action="index.php">
                              <input type="text" name="username" id="username" required placeholder="UserName"/>
                              <input type="password" name="password" id="password" required placeholder="Password"/>
                              <input type="password" name="confirm_password" id="confirm_password" required placeholder="Confirm password"/>
                              <input type="email" name="email" id="email" required placeholder="Email address" />
                              <button type="submit">Create</button> 
                              <p class="message">Already registered? <a href="javascript:void(0)">Sign In</a></p>
                            </form>
                            <form class="login-form" method="post" action="index.php">
                              <input type="text" name="username" id="username" required placeholder="Username"/>
                              <input type="password" name="password" id="password" required placeholder="Password"/>
                              <input type="hidden" name="login" />
                              <button type="submit">Login</button>
                              <p class="message">Not registered? <a href="javascript:void(0)">Create an account</a></p>
                            </form>
                          </div>
                   </div>
               </div> <!-- .col-sm-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section><!-- #slide_tabs -->


