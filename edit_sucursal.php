<?php
	$page_title = 'Editar Cuenta';
	require_once('includes/load.php');
	page_require_level(1);
	
	//capturar el id
	if(isset($_GET['id'])){
		$id_sucursal=remove_junk($db->escape($_GET['id']));
		$sql_suc="SELECT * FROM sucursales where id=$id_sucursal";
		$sql_query=$db->query($sql_suc);
		while($suc=$db->fetch_array($sql_query)){
			$nombre_sucursal=$suc['nombre_sucursal'];
			$image_path= $suc['image_path'];
			$direccion_sucursal=$suc['direccion_sucursal'];
			$telefono_sucursal=$suc['telefono_sucursal'];
			$ruc_sucursal=$suc['RUC_SUCURSAL'];
			$email_sucursal=$suc['email'];
			// $wsp_sucursal=$suc['wsp_sucursal'];
		}
  	}
	//update user image
	if(isset($_POST['submit'])) {
		$photo = new Media();
		$sucursal_id = (int)$_POST['sucursal_id'];
		$photo->upload($_FILES['file_upload']);
		if($photo->process_empresa($sucursal_id)){
			$session->msg('s','La foto fue subida al servidor.');
			redirect('edit_sucursal.php?id='.$sucursal_id);
		} else{
			$session->msg('d',join($photo->errors));
			redirect('edit_sucursal.php?id='.$sucursal_id);
		}
	}
	
 	//update empresa other info
  	if(isset($_POST['update'])){
		$req_fields = array('name','direccion','telefono','ruc');
		validate_fields($req_fields);
    	if(empty($errors)){
			$id = remove_junk($db->escape($_POST['id_sucursal']));
           	$name = remove_junk($db->escape($_POST['name']));
			$direccion = remove_junk($db->escape($_POST['direccion']));
			$telefono = remove_junk($db->escape($_POST['telefono']));
			$ruc = remove_junk($db->escape($_POST['ruc']));
      		$email = remove_junk($db->escape($_POST['email']));
      		//  $wsp = remove_junk($db->escape($_POST['wsp']));
            $sql = "UPDATE sucursales SET nombre_sucursal ='{$name}', direccion_sucursal ='{$direccion}' , telefono_sucursal='{$telefono}',RUC_SUCURSAL='{$ruc}',email='{$email}' WHERE id='{$id}'";
    		$result = $db->query($sql);
			if($result && $db->affected_rows() === 1){
				$session->msg('s',"Datos actualizados. ");
				redirect('edit_sucursal.php?id='.$id, false);
			} else {
				$session->msg('d',' Lo siento, actualización falló.');
				redirect('edit_sucursal.php?id='.$id, false);
			}
		} else {
		$session->msg("d", $errors);
		redirect('edit_account.php',false);
		}
  	}
?>
 <head>
  <?php include ("./layouts/header.php");?>
    
  </head>
<body>
    
    <header>
    <?php include ("./layouts/nav.php");?>
  </header>
  <body> 
    <div  class="container-fluid" style="padding-top: 60px">
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-heading clearfix">
            <span class="glyphicon glyphicon-camera"></span>
            <span>Cambiar logo de la empresa</span>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
                <img class="img-circle img-size-2" style="width: 100%;height: 25%"src="uploads/empresa/<?php echo $image_path;?>" alt="">
            </div>
            <div class="col-md-8">
              <form class="form" action="edit_sucursal.php" method="POST" enctype="multipart/form-data">
              <div class="form-group" >
                <input type="file"  name="file_upload" multiple="multiple" class="btn btn-default btn-file" />
              </div>
              <div class="form-group">
                <input type="hidden" name="sucursal_id" value="<?php echo $id_sucursal;?>">
                 <button type="submit" name="submit" class="btn btn-warning">Cambiar</button>
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <span class="glyphicon glyphicon-edit"></span>
        <span>Editar datos de la empresa</span>
      </div>
      <div class="panel-body">
          <form method="post" action="edit_sucursal.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Nombre</label>
                  <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucwords($nombre_sucursal)); ?>">
                  <input type="hidden"  name="id_sucursal" value="<?php echo remove_junk(ucwords($id_sucursal)); ?>" >
            </div>
            <div class="form-group">
                  <label for="ruc" class="control-label">RUC</label>
                  <input type="text" class="form-control" name="ruc" value="<?php echo remove_junk(ucwords($ruc_sucursal)); ?>">
            </div>
            <div class="form-group">
                  <label for="telefono" class="control-label">Telefono</label>
                  <input type="text" class="form-control" name="telefono" value="<?php echo remove_junk(ucwords($telefono_sucursal)); ?>">
            </div>
            <div class="form-group">
                  <label for="direccion" class="control-label">Direccion</label>
                  <input type="text" class="form-control" name="direccion" value="<?php echo remove_junk(ucwords($direccion_sucursal)); ?>">
            </div>
            <div class="form-group">
                  <label for="direccion" class="control-label">WhatsApp</label>
                  <input type="text" class="form-control" name="wsp" value="<?php echo remove_junk(ucwords($wsp_sucursal)); ?>">
            </div>
            <div class="form-group">
                  <label for="direccion" class="control-label">Email</label>
                  <input type="text" class="form-control" name="email" value="<?php echo remove_junk(ucwords($email_sucursal)); ?>">
            </div>
            <div class="form-group clearfix">
                  <!--  <a href="change_password.php" title="change password" class="btn btn-danger pull-right">Cambiar contraseña</a>-->
                    <button type="submit" name="update" class="btn btn-info">Actualizar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
