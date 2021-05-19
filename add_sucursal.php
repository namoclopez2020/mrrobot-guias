<?php
  $page_title = 'Agregar sucursal';
  require_once('includes/load.php');
  // Checkear nivel de permiso para esta pagina
  page_require_level(1);
$cone= $db->con();
?>
<?php
 if(isset($_POST['add_sucursal'])){
    
	 $nombre=remove_junk($db->escape($_POST['sucursal-name']));
	 $direccion=remove_junk($db->escape($_POST['sucursal-direccion']));
   $ruc=remove_junk($db->escape($_POST['sucursal-ruc']));
   $celular=remove_junk($db->escape($_POST['sucursal-celular']));
   $imagen="no-image";

   
   
	 
     $date    = make_date();
     $query  = "INSERT INTO sucursales (";
     $query .=" direccion_sucursal,nombre_sucursal,telefono_sucursal,RUC_SUCURSAL,image_path";
     $query .=") VALUES (";
     $query .=" '{$direccion}','{$nombre}','{$celular}','{$ruc}','{$imagen}'";
     $query .=")";
	  
	  
  // si se ejecuta correctamente la insercion
     if($db->query($query)){

		 $sucursal_id=$db->insert_id();
      $photo = new Media();
  $photo->upload($_FILES['file_upload']);
  $photo->process_empresa($sucursal_id);
		 
		
       $session->msg('s',"Sucursal agregada satisfactoriamente");
       redirect('sucursal.php', false);
		
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_sucursal.php', false);
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
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar nueva sucursal</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_sucursal.php" class="clearfix" enctype="multipart/form-data">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="sucursal-name" placeholder="Nombre" required>
               </div>
              </div>
			  <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="sucursal-direccion" placeholder="Direccion" required>
               </div>
              </div>
        <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="sucursal-ruc" placeholder="RUC" required>
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="sucursal-celular" placeholder="Celular" required>
               </div>
              </div>
               <!-- <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="sucursal-email" placeholder="Email" required>
               </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="sucursal-wsp" placeholder="WhatsApp" required>
               </div>
              </div>
                 -->
             
              <div class="form-group" >
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span><label for="file_upload" class="form-control">Logo</label>
              <input type="file"  name="file_upload" multiple="multiple" class="btn btn-default btn-file" />
              </div>
            </div>
            
              <button type="submit" name="add_sucursal" class="btn btn-danger">Guardar Datos</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
