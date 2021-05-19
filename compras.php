<?php

  $page_title = 'Lista de boletas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $all_sucursal=find_all('sucursales');
  $all_proveedores=find_all('proveedores');
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
	
    <div class="col-md-12">
		<div class="panel panel-default">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a  href="nueva_compra.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Compra</a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Compras</h4>
		</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table" id="example">
						<thead>
							<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
					
					<th>Vendedor</th>
					<th>Estado</th>
					<th class='text-right'>Total</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
						</thead>
						<tbody>
							<?php
							$sql="SELECT c.id_compra,c.numero_compra,c.fecha_compra,c.id_proveedor,c.metodo_pago,c.costo_total_compra,p.id_sucursal FROM compras as c LEFT JOIN proveedor as prov ON prov.idproveedor=c.id_proveedor LEFT JOIN detalle_compra as d ON d.num_compra=c.numero_compra LEFT JOIN products as p ON p.id=d.id_producto_compra where c.suc_id=$id_sucursal GROUP BY c.id_compra,p.id_sucursal order by c.id_compra desc";
							$query=$db->query($sql);
				while ($row=$db->fetch_array($query)){
						$id_factura=$row['id_compra'];
						$numero_factura=$row['numero_compra'];
						$fecha=date("d/m/Y G:i:s", strtotime($row['fecha_compra']));
						$id_proveedor=$row['id_proveedor'];
					    $nombre_proveedor_sql=$db->query("select nombre from proveedor where idproveedor='$id_proveedor'");
					    $nombre_prov=$db->fetch_array($nombre_proveedor_sql);
					    $nombre_proveedor=$nombre_prov['nombre'];
						$metodo_pago=$row['metodo_pago'];
						if ($metodo_pago==1){$text_estado="Efectivo";$label_class='label-success';}
						else{$text_estado="Tarjeta";$label_class='label-warning';}
						$total_venta=$row['costo_total_compra'];
					?>
					<tr>
						<td><?php echo $numero_factura; ?></td>
						<td><?php echo $fecha; ?></td>
						
						<td><?php echo $nombre_proveedor; ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format ($total_venta,2); ?></td>					
					<td class="text-right">
						<a href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-default' title='Editar boleta' ><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Ver compra' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar compra' onclick="eliminar('<?php echo $numero_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				?>
				
						</tbody>
					</table>
 				</div>
			</div>
		</div>	
		
	</div>
	<hr>
	  <?php include_once('layouts/footer.php'); ?>
	  
	
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/compras.js"></script>
	  
  </body>
</html>
