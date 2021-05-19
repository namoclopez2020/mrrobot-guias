d<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);

  $concepto=remove_junk($_POST['concepto_egreso']);
  $monto=remove_junk($_POST['monto_egreso']);
  $fecha=make_date();
 $query="insert into egreso (fecha,concepto,monto) VALUES ('$fecha','$concepto','$monto')";
  
  if($db->query($query)){
      $session->msg("s","Egreso creado correctamente");
      redirect('egresos.php');
  } else {
      $session->msg("d","Creacion de egreso falló");
      redirect('egresos.php');
  }
?>