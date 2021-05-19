	<?php
		require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  //$products = join_product_table();
   //capturar datos de la sucursal
$id_sucursal=$_SESSION['id_sucursal'];
	?>	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
				  </div>
				  <div class="modal-body">
					<div class="table-responsive" >
						<table class="table" id="example" >
							<thead>
							<tr  class="warning">
					<th>Código</th>
					<th>Producto</th>
					<th>Categoria</th>
					<th>Sucursal</th>
					<th>Stock</th>
					<th><span class="pull-right">Cant.</span></th>
					<th><span class="pull-right">Costo</span></th>
					<th class='text-center' style="width: 36px;">Agregar</th>
					</tr>	
							</thead>
							<tbody>
								<?php
								$sql="select p.quantity,p.id,p.date,p.codigo_producto,p.name as nombre_prod,p.buy_price,p.sale_price,p.media_id,p.categorie_id,p.id_sucursal,c.name as nombre_suc,s.nombre_sucursal from products as p inner join categories as c ON p.categorie_id=c.id inner join sucursales as s ON p.id_sucursal=s.id WHERE p.id_sucursal=$id_sucursal ORDER BY p.id";
		if ($query=$db->query($sql)){
			$fecha_hoy=date('Y-m-d');
			
			
				while ($row=$db->fetch_array($query)){
					$id_producto=$row['id'];
					$codigo_producto=$row['codigo_producto'];
					$nombre_producto=$row['nombre_prod'];
					$precio_venta=$row["sale_price"];
					
					$id_categoria=$row['categorie_id'];
					$id_sucursal=$row['id_sucursal'];
					
				$categoria=$row['nombre_suc'];
					$sucursal=$row['nombre_sucursal'];
					
					$stock=$row["quantity"];
					
				
					?>
					<tr>
						<td><?php echo $codigo_producto; ?></td>
						<td><?php echo $nombre_producto; ?></td>
						<td><?php echo $categoria; ?></td>
						
						<td bgcolor="<?php if($id_sucursal==4){echo "red";}else{echo "blue";}?>"><font color="white"><?php echo $sucursal;?></font></td>
						<td class="text-center"><?php echo $stock;?></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $id_producto; ?>"  value="1" >
						</div></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input type="hidden"  id="stock_<?php echo $stock; ?>"  value="<?php echo $stock;?>" >	
						<input type="text" class="form-control" style="text-align:right"  id="costo_prod_<?php echo $id_producto; ?>" >
							
						</div></td>
						
						<td class='text-center'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
					</tr>
					<?php
				
				}
			}
				?>	
							</tbody>
						</table>
 					</div>
				  </div>
				 
				</div>
			  </div>
			</div>
	<?php
		
	?>