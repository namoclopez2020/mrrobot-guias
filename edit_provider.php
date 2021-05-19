<?php
  $page_title = 'Editar proveedor';
  require_once('includes/load.php');

  // Checkin What level user has permission to view this page
  page_require_level(2);
 // $all_providers = find_all('proveedores');
  //$all_photo = find_all('media');
$provider = find_by_id1('proveedor',(int)$_GET['id']);
//if(!$provider){
 // $session->msg("d","Missing provider id.");
//  redirect('proveedores.php');	 

?>
<?php

?>
<?php
 if(isset($_POST['edit_provider'])){
  // $req_fields = array('empresa_title','telefono_title','contacto_title','tipo_producto' );
  // validate_fields($req_fields);


   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['empresa_title']));
     $p_telef  = remove_junk($db->escape($_POST['telefono_title']));
     $p_contact   = remove_junk($db->escape($_POST['contacto_title']));
     $p_ruc = remove_junk($db->escape($_POST['RUC']));
     $p_direccion=remove_junk($db->escape($_POST['direccion_title']));
	 $p_id  = remove_junk($db->escape($_POST['id_proveedor']));
	   $query   = "UPDATE proveedor SET";
       $query  .=" nombre ='{$p_name}',Telefono ='{$p_telef}',";
       $query  .=" representante ='{$p_contact}', direccion ='{$p_direccion}', RUC ='{$p_ruc}'";
       $query  .=" WHERE idproveedor ='{$p_id}'";
	   
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
	  
     $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto ha sido actualizado. ");
                 redirect('proveedores.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_provider.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_provider.php?id='.$product['id'], false);
   }


 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Actualizar datos del proveedor</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="edit_provider.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="empresa_title" placeholder="Empresa proveniente" value="<?php echo remove_junk($provider['nombre']);?>" required>
               </div>
              </div>
			  <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="telefono_title" placeholder="Teléfono" value="<?php echo remove_junk($provider['Telefono']);?>" required>
               </div>
              </div>
			  <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="contacto_title" placeholder="Nombre del contacto" value="<?php echo remove_junk($provider['representante']);?>" required>
               </div>
              </div>
			  <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="direccion_title" placeholder="direccion" value="<?php echo remove_junk($provider['direccion']);?>" required>
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="RUC" placeholder="RUC" value="<?php echo remove_junk($provider['RUC']);?>" required>
               </div>
              </div>
              <input type="hidden" class="form-control" name="id_proveedor" value="<?php echo remove_junk($provider['idproveedor']);?>" required>

              <button type="submit" name="edit_provider" class="btn btn-danger">Actualizar proveedor</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
