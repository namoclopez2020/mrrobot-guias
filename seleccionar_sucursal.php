<?php
  ob_start();
  $page_title="Inicio de sesion";
  require_once('includes/load.php');
  page_require_level(3);
  $all_sucursales=find_all_sucursales_by_user();
 // if($session->isUserLoggedIn(true)) { redirect('admin.php', false);}
?>
 <?php include_once('layouts/header.php'); ?>

<div class="container-fluid" >
<div class="login-page">
	<div class="login-box">
    <img src="./libs/images/logo_login.png" class="avatar">
	<?php echo display_msg($msg); ?>
    <div class="text-center" >
       <h1>Elegir sucursal de trabajo</h1>
       <p>Seleccione una opción </p>
     </div>
     
      <form method="post" action="auth2.php" class="clearfix">
        <div class="form-group">
                    <select class="form-control" name="sucursal" required>
                      <option value="">Selecciona una sucursal</option>
                    <?php  foreach ($all_sucursales as $suc): ?>
                      <option value="<?php echo $suc['id'] ?>">
                        <?php echo $suc['nombre_sucursal'] ?></option>
                    <?php endforeach; ?>
                    </select>
          </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info  pull-right">Aceptar</button>
        </div>
		  
    </form>

</div>
</div>

	</div>
<?php include_once('layouts/footer.php'); ?>
