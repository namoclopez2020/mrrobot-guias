<?php
  $page_title = 'Lista de proveedores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $providers = find_all_provider();
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
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_provider.php" class="btn btn-primary">Agregar proveedor</a>
         </div>
        </div>
        <div class="panel-body">
          <div class="table-responsive" >
          <table class="table table-bordered" id="example">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 20%;"> Empresa proveniente </th>
                <th class="text-center" style="width: 20%;"> Teléfono </th>
                <th class="text-center" style="width: 20%;"> Nombre del Contacto </th>
               
				  <th class="text-center" style="width: 10%;"> RUC </th>
               
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($providers as $provider):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                
                <td> <?php echo remove_junk($provider['nombre']); ?></td>
                <td class="text-center"> <?php echo remove_junk($provider['Telefono']); ?></td>
                <td class="text-center"> <?php echo remove_junk($provider['representante']); ?></td>
                
				   <td class="text-center"> <?php echo remove_junk($provider['RUC']); ?></td>
               
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_provider.php?id=<?php echo (int)$provider['idproveedor'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_provider.php?id=<?php echo (int)$provider['idproveedor'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
