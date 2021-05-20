<?php
  $page_title = 'Lista de clientes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $clientes = clientesBySucursal();
?>
<head>
  <?php include ("./layouts/header.php");?>
    
  </head>
<body>
    
    <header>
    <?php include ("./layouts/nav.php");?>
  </header>
   <div  class="container-fluid" style="padding-top: 60px">
  
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_client.php" class="btn btn-primary">Agregar Cliente</a>
         </div>
        </div>
        <div class="panel-body">
          <div class="table-responsive" >
          <table class="table table-bordered" id="example">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 10%;">Nombre y Apellidos</th>
				<th class="text-center" style="width: 10%;"> Teléfono </th>
				<th class="text-center" style="width: 10%;"> Edad </th>
                <th class="text-center" style="width: 10%;"> E-mail </th>
                <th class="text-center" style="width: 25%;"> Dirección </th>
                <th class="text-center" style="width: 10%;"> Agregado </th>
                <th class="text-center" style="width: 50px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($clientes as $cliente):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                
                <td> <?php echo remove_junk($cliente['nombre_cliente']); ?></td>
				<td class="text-center"> <?php echo remove_junk($cliente['telefono_cliente']); ?></td>
				<td class="text-center"> <?php echo remove_junk($cliente['edad']); ?></td>
                <td class="text-center"> <?php echo remove_junk($cliente['email_cliente']); ?></td>
                <td class="text-center"> <?php echo remove_junk($cliente['direccion_cliente']); ?></td>
                <td class="text-center"> <?php echo read_date($cliente['date_added']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_client.php?id=<?php echo (int)$cliente['id_cliente'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <!-- <a href="delete_client.php?id=<?php //echo (int)$cliente['id_cliente'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a> -->
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
  
              </body>