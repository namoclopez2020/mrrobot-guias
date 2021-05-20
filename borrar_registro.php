<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $product = find_by_correlativo('registro',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","correlativo no valido");
    redirect('mPrincipal.php');
  }

  $delete_id = vigencia_registro('registro',(int)$product['correlativo']);
  $borrar_pagos = borrar_pagos((int)$product['correlativo']);
  if($delete_id && $borrar_pagos){
      $session->msg("s","Registro anulado exitosamente");
      redirect('mPrincipal.php');
  } else {
      $session->msg("d","Anulacion falló");
      redirect('mPrincipal.php');
  }
?>
