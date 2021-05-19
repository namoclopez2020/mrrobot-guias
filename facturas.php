<?php

  $page_title = 'Lista de boletas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  $all_sucursal=find_all('sucursales');
  $all_vendedores=find_all('users');
  //capturar datos de la sucursal
$id_sucursal=$_SESSION['id_sucursal'];
?>

<!DOCTYPE html>
<html lang="en">
 <head>
	<?php include ("./layouts/header.php");?>
		
	</head>
<body>
    
    <header>
  	<?php include ("./layouts/nav.php");?>
	</header>
  <div  class="container-fluid" style="padding-top: 60px">
	<div id="resultados"></div>
    <div class="col-md-12">
		<div class="panel panel-default">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a  href="nueva_venta.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Venta</a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Ventas</h4>
		</div>
			<div class="panel-body">
			<div class="table-responsive">        
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                       <thead>
				<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
					<th>Producto</th>
					<th>Vendedor</th>
					<th>Estado</th>
					<th class='text-right'>Total</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
			</thead>
                        <tbody>
                        	<?php
                        	$sql="SELECT f.id_factura,f.numero_factura,f.fecha_factura,f.id_vendedor,f.estado_factura,f.total_venta,p.id_sucursal FROM  facturas as f LEFT JOIN users as u ON u.id=f.id_vendedor LEFT JOIN detalle_factura as d ON d.numero_factura=f.numero_factura LEFT JOIN products as p ON p.id=d.id_producto INNER JOIN sales as s ON s.numero_factura=f.numero_factura and p.id_sucursal=s.id_sucursal  where s.id_sucursal=$id_sucursal GROUP BY f.id_factura,s.id_sucursal order by f.id_factura desc";

                           if ($query=$db->query($sql) ){
				while ($row=$db->fetch_array($query)){
					$id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y G:i:s", strtotime($row['fecha_factura']));
						$id_vendedor=$row['id_vendedor'];
					    $nombre_vendedor_sql=$db->query("select name from users where id='$id_vendedor'");
					    $nombre_vende=$db->fetch_array($nombre_vendedor_sql);
					    $nombre_vendedor=$nombre_vende['name'];
						$estado_factura=$row['estado_factura'];
						if ($estado_factura==1){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_venta=$row['total_venta'];
						
						$sql="select pro.name as nombre_prod from detalle_factura as det INNER JOIN products as pro ON pro.id=det.id_producto where numero_factura=$numero_factura GROUP BY pro.name";
						$queryy=$db->query($sql);
						$productos="";
						while($datos=$db->fetch_array($queryy)){
							$productos=$productos."<br>".$datos['nombre_prod'];
						}
					
					?>
					<tr>
						<td><?php echo $numero_factura; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $productos; ?></td>
						<td><?php echo $nombre_vendedor; ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format ($total_venta,2); ?></td>					
					<td class="text-right">
						<a href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-default' title='Editar boleta' ><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Ver Boleta' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar boleta' onclick="eliminar('<?php echo $numero_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php }
        }?>
                          
                        </tbody>        
                       </table>                  
                    </div>
				
	</div>
	
</div>

	
</div>
				
			
			
		
	</div>
	
	  <?php include_once('layouts/footer.php'); ?>
	  
	
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script>
	  
  </body>
</html>
