<?php include_once('includes/load.php'); ?>
<?php

$req_fields = array('sucursal' );
validate_fields($req_fields);
$sucursal = remove_junk($_POST['sucursal']);


if(empty($errors)){
  //generar las variables de sesion
  $session->elegir_sucursal($sucursal);
   if(isset($_SESSION['id_sucursal'])){
   
   $session->msg("s", "Bienvenido a sistema de guías, Sucursal: ".$_SESSION['nombre_sucursal']);
   redirect('admin.php',false);
 }
    } 
?>