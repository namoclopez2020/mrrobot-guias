<?php 
$page_title="Reporte diario";
require_once('includes/load.php');
page_require_level(2);

$id_sucursal = $_SESSION['id_sucursal'];
$fecha_hoy=date('Y-m-d');
//suma de pagos de guias
$sql="SELECT * FROM pagos_registro where sucursal_id = '".$id_sucursal."' and fecha_pago like '$fecha_hoy%'";
$data=$db->query($sql);
$suma=0;
foreach($data as $datos){
	$suma += (double)$datos['pagado'];
}
//suma de pagos de ventas
$sql="SELECT * FROM sales where id_sucursal = '".$id_sucursal."' and date like '$fecha_hoy%'";
$data=$db->query($sql);
$suma_venta=0;
foreach ($data as $ventas) {
	$suma_venta += (double)$ventas['price'];
}
//suma de egresos
$sql="SELECT * FROM egreso where sucursal_id = '".$id_sucursal."' and fecha like '$fecha_hoy%'";
$data=$db->query($sql);
$suma_egreso=0;
foreach ($data as $egreso) {
	$suma_egreso += (double)$egreso['monto'];
}
$neto=$suma+$suma_venta-$suma_egreso;
?>
<html>
<head>
	<?php include('layouts/header.php');?>
</head>
<header>
	<?php include('layouts/nav.php')?>
</header>
<body>
<div  class="container-fluid" style="padding-top: 60px">
    <div class="col-md-15">
	
		
		<div id="myModal" tabindex="-1"  aria-labelledby="myModalLabel">
			  <div  role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<a href="./FPDF/reportes/reporte_diario_pdf.php" class="btn btn-warning">Generar PDF de guias</a>
					<a href="./FPDF/reportes/reporte_diario_ventas_pdf.php" class="btn btn-success">Generar PDF  de ventas</a>
					<div>
						<h4>Total pagos por servicio: <?php echo "S/. ".$suma;?></h4>
						<h4>Total pagos en ventas: <?php echo "S/. ".$suma_venta;?></h4>
						<h4>Total de egresos: <?php echo "S/. ".$suma_egreso;?></h4>

						<h4>Total neto: <?php echo "S/. ".$neto;?></h4>
					</div>

				  </div>
				  <div class="modal-body">
				  	PAGOS POR GUIAS DIARIAS
					<div class="table-responsive">        
                        <table class="table table-striped table-bordered" style="width:100%" id="example">
                        <thead>
                            <tr class="warning">
                     <th class="text-center" style="width: 10px;">#</th>
               
                <th class="text-center" style="width: 40%"> Descripción equipo </th>
                <th class="text-center" style="width: 20%;"> Cliente </th>
                <th class="text-center" style="width: 10%;"> Status </th>
                <th class="text-center" style="width: 10%;"> Pagado </th>
                <th class="text-center" style="width: 20%;"> Fecha y Hora</th>
                <th class="text-center" style="width: 20%;"> Técnico</th>
				  
                <!--<th class="text-center" style="width: 10%;"> Usuario </th>
				  -->
                
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
                        	$sql="select u.name,c.nombre_cliente,p.id_correlativo_registro,r.descrip,r.falla,r.status,p.pagado,p.fecha_pago from registro as r INNER JOIN pagos_registro as p ON r.correlativo=p.id_correlativo_registro INNER JOIN users as u ON p.id_vendedor=u.id INNER JOIN cliente as c ON r.id_cliente_registro=c.id_cliente where p.fecha_pago like'$fecha_hoy%' and p.sucursal_id = ".$id_sucursal." ORDER BY p.id_correlativo_registro";

                           if ($query=$db->query($sql) ){
				while ($row=$db->fetch_array($query)){
					$correlativo=$row['id_correlativo_registro'];
					$descrip=$row['descrip'];
					$status=$row['status'];
					$fecha=$row['fecha_pago'];
					$pagado=$row['pagado'];
					$nombre_cliente=$row['nombre_cliente'];
					$nombre_tecnico=$row['name'];
					
					switch ($status) {
						case 1 :
							$status_value="EN REPARACION O MANTENIMIENTO";
							break;
						case 2:
							$status_value="Listo para entregar";
							break;
						case 3 :
							$status_value="Entregado";
							break;
						
						default:
							$status_value="";
							break;
					}
					
					?>
					<tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($descrip); ?></td>
                <td class="text-center"> <?php echo remove_junk($nombre_cliente); ?></td>
                 <td class="text-center"> <?php echo remove_junk($status_value); ?></td>
                <td class="text-center"> <?php echo remove_junk($pagado); ?></td>
                
               
                <td class="text-center"> <?php echo remove_junk($fecha); ?></td>
                <td class="text-center"> <?php echo remove_junk($nombre_tecnico); ?></td>
                
              
				
               
            </tr><?php }
        }?>
                          
                        </tbody>        
                       </table>                  
                    </div>
			  </div>
			</div>
			<div class="col-md-15">
	
		
		<div id="myModal" tabindex="-1"  aria-labelledby="myModalLabel">
			  <div  role="document">
				<div class="modal-content">
				  <div class="modal-header">
					VENTAS DIARIAS
					
				  </div>
				  <div class="modal-body">
					<div class="table-responsive">        
                         <table  class="table table-striped table-bordered" style="width:100%" id="example1">
                       <thead>
				<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
					<th>Producto</th>
					<th>Vendedor</th>
					<th>Estado</th>
					<th class='text-right'>Total</th>
					
					
				</tr>
			</thead>
                        <tbody>
                        	<?php
                        	$sql="SELECT f.id_factura,f.numero_factura,f.fecha_factura,f.id_vendedor,f.estado_factura,f.total_venta,p.id_sucursal FROM  facturas as f LEFT JOIN users as u ON u.id=f.id_vendedor LEFT JOIN detalle_factura as d ON d.numero_factura=f.numero_factura LEFT JOIN products as p ON p.id=d.id_producto INNER JOIN sales as s ON s.numero_factura=f.numero_factura and p.id_sucursal=s.id_sucursal  WHERE s.date like '$fecha_hoy%' and s.id_sucursal = ".$id_sucursal." GROUP BY f.id_factura,s.id_sucursal order by f.id_factura desc";

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
						
					</tr>
					<?php }
        }?>
                          
                        </tbody>        
                       </table>          
                    </div>
			  </div>
			</div>	
		</div>

	<?php include_once('layouts/footer.php'); ?>

</body>
</html>
