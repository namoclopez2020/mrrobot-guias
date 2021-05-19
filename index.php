<?php
  ob_start();
$page_title="Inicio de sesion";
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('admin.php', false);}
?>
 <?php include_once('layouts/header.php'); ?>


 <div class="login-box">
   <img src="./libs/images/logo_login.png" class="avatar">
        <h1>Bienvenido</h1>
      
        <?php echo display_msg($msg); ?>
            <form method="post" action="auth.php" class="clearfix">
            <p>Usuario</p>
            <input type="text" name="username" placeholder="Usuario">
            <p>Contraseña</p>
            <input type="password" name="password" placeholder="Contraseña">
            <input type="submit" name="submit" value="Entrar">
            <a href="#">Olvido Contraseña?</a>    
            </form>
         </div> 


	</div>
<?php include_once('layouts/footer.php'); ?>
