<?php

  $page_title = 'Historial de productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
$id_producto=$_GET['id'];
if(!(isset($_GET['id']) && is_numeric($_GET['id']))){
	redirect('product.php',false);
}
$products=find_all('products');
$query="Select name from products where id='$id_producto'";
$data=$db->query($query);
$nombre_prod=$db->fetch_array($data);
$nombre_producto=$nombre_prod['name'];
$all_movimientos=find_all('movimientos');
$all_tipo_movimiento=find_all('detalle_movimiento');

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
		    
			<h4><i class='glyphicon glyphicon-search'></i> Historial de : <?php echo $nombre_producto;?></h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_movimientos">
				


				
				
				
			</form>
<?php
					$sql="SELECT m.id_movimiento,m.cantidad_mov,m.fecha_movimiento,p.name as pname,u.name as uname,d.nombre_tipo_movimiento FROM  movimientos as m LEFT JOIN detalle_movimiento as d ON m.id_tipo_movimiento=d.id_detalle_mov LEFT JOIN users as u ON m.id_vendedor_mov=u.id LEFT JOIN products as p ON m.id_producto_mov=p.id where m.id_producto_mov='$id_producto'  GROUP BY m.id_movimiento order by m.id_movimiento desc";
					$query=$db->query($sql);
					
				?>

				<div class="table-responsive">
					 <table class="table" id="example">
					 	<thead>
				<tr class="info">
					<th>#</th>
					
					
					<th>Fecha</th>
					<th>Vendedor</th>
					<th>Cantidad</th>
					<th>Movimiento</th>
					
				</tr>
			</thead>
			<tbody>
				
				
						<?php
				foreach($query as $fila){
					$fecha_movimiento=date("d/m/Y G:i:s", strtotime($fila['fecha_movimiento'])) ;
					
					echo "<tr>";
					echo "<td>". $fila['id_movimiento'] ."</td>";
				
					echo "<td>". $fecha_movimiento ."</td>";
					echo "<td>". $fila['uname'] ."</td>";
					echo "<td>". $fila['cantidad_mov'] ."</td>";
					echo "<td>". $fila['nombre_tipo_movimiento'] ."</td>";
					
					echo "</tr>";
								
				}
					?>
				
				
			
				
			</tbody></table>
				
				</div>

				
			</div>
		</div>	
		
	</div>
	<hr>
	  <?php include_once('layouts/footer.php'); ?>
	  
	
	

	  
  </body>
</html>
