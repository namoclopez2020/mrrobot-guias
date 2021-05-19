<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
error_reporting(0);
$id=$_POST['id'];
$concepto=$_POST['concepto_egreso'];
$monto=$_POST['monto_egreso'];

$date=make_date();


$query="UPDATE egreso set concepto='$concepto',monto='$monto' where id_egreso=$id ";

if($db->query($query) && $db->affected_rows()==1){

  $session->msg("s", "Datos actualizados correctamente.");}
else{
	$session->msg("d","Hubo un problema con la actualización");
}

?>
