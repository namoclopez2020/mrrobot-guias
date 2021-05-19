<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $product = find_by_id_egreso('egreso',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","id no valido");
    redirect('egresos.php');
  }
?>
<?php
  $delete_id = delete_by_egreso('egreso',(int)$product['id_egreso']);
  if($delete_id){
      $session->msg("s","Egreso eliminado exitosamente");
      redirect('egresos.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('egresos.php');
  }
?>
