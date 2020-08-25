        <header id="header">
            <div class="container">
               <div class="row">
                 <?php if($_SESSION["username"]!=""){?>
                 <div class="pull-right">
                   <form class="logout" method="post" action="index.php">
                     <label>Hallo <a href="?profile=<?php echo $_SESSION["id_user"] ?>"><?php echo $_SESSION["username"]; ?></a> </label>
                     <button type="submit">Logout</button>
                     <input type="hidden" name="logout" />
                   </form>
                 </div>
                 <?php } ?>
                </div>
            </div>
         </header>

<?php
// print_r($_SESSION);
?>