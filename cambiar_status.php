<?php 
require_once('includes/load.php');

$page_title="Cambiar status";
page_require_level(3);
$id=remove_junk($db->escape($_GET['id']));
$validar="SELECT * FROM registro where correlativo=$id";
$consultar=$db->query($validar);
while($filas = $db->fetch_array($consultar)){
  $id_status=$filas['status'];
}
if(!isset($_GET['id']) || $id_status==0){
 $session->msg('d','Id no valido');
 redirect('status_equipo.php',false);
}
if(isset($_POST['submit'])){
	$status_val=remove_junk($db->escape($_POST['status']));
	$id=remove_junk($db->escape($_POST['id']));

	$sql_update="update registro set status= $status_val where correlativo= $id";
	if($db->query($sql_update)){
		$session->msg('s','status actualizado correctamente');
	}
	else{
		$session->msg('s','error al actualizar');
	}

}
$id=remove_junk($db->escape($_GET['id']));

$sql="select count(*) as conteo from registro where correlativo=$id";

$consulta=$db->query($sql);

$sql1="select * from registro as R INNER JOIN cliente as C ON R.id_cliente_registro=C.id_cliente where R.correlativo=$id";

$consulta_datos=$db->query($sql1);

foreach($consulta_datos as $row){
	$descripcion=$row['descrip'];
	$descripcion=str_replace("<br>", "\n", $descripcion);
	$falla=$row['falla'];
	$cliente=$row['nombre_cliente'];
	$status=$row['status'];
}

$cont=0;
foreach ($consulta as $datos) {
	$cont=$datos['conteo'];
}

if($cont==1){
	?> 
<head>
  <?php include ("./layouts/header.php");?>
    
  </head>
<body>
    
    <header>
    <?php include ("./layouts/nav.php");?>
  </header>
  <div class ="container-fluid" style="padding-top: 60px;">
<div class="row">
  <div  id="resu" class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Actualizar estado de equipo</span>
         </strong>
        </div>
		  <!-- formulario general -->
		  
        <div class="panel-body" id="padre">
         <div class="col-md-12">
          <form method="post" id="agregar_productos" name="agregar_productos" method="POST"  class="clearfix" >
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" id="product-title" placeholder="Descripcion" value="<?php echo $descripcion?>" readonly>

                  <input type="text" value="<?php echo $id;?>" name="id" hidden>
               </div>
              </div>
			  
			  
              <div class="form-group">
                <div class="row">
					<div class="col-md-6">
                    <select class="form-control" name="status" required>
                      <option value="1" <?php if($status==1){echo 'selected';}?>>En reparacion o mantenimiento</option>
                      <option value="2" <?php if($status==2){echo 'selected';}?>>Listo para entregar</option>
                      <option value="3" <?php if($status==3){echo 'selected';}?>>Entregado</option>

                  
                    </select>
					</div>
                  
                 
              </div>
          </div>
			  

			  
			  
			  
              <button type="submit" name="submit" class="btn btn-success">Actualizar estado</button>
              <a href="status_equipo.php" class="btn btn-warning">Regresar</a>
          </form>
         </div>
        </div>
		  <!-- formulario de formulario -->
		
		  
		  
      </div>
    </div>
  </div>



	<?php
}else{
	 $session->msg('d','id no valido');
	redirect('status_equipo.php',false);
}


include_once('layouts/footer.php'); 

?>