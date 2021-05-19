<?php

	$page_title = 'Status de servicios';
  	require_once('includes/load.php');
	// Checkin What level user has permission to view this page
   	page_require_level(3);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include ("./layouts/header.php");?>
	</head>
	<header>
		<?php include ("./layouts/nav.php");?>
	</header>
  	<body> 
  		<div  class="container-fluid" style="padding-top: 60px">
   			<div class="col-md-12">
				<div  id="myModal" tabindex="-1"  aria-labelledby="myModalLabel">
					<div  role="document">
						<div class="modal-content">
							<div class="modal-header">
								<div class="container-fluid" >
									<?php echo display_msg($msg);?>
								</div>
								<h4 class="modal-title" id="myModalLabel">Buscar servicios</h4>
							</div>
							<div class="modal-body">
								<div class="form-horizontal">
									<div class="form-group">
										<div class="container-fluid">
											<div class="table-responsive" >
												<table class="table"  id="table" border="0" style="">
													<thead class="warning">
														<th> Correlativo</th>
														<th> DNI</th>
														<th class="text-center" style="width: 10%;">Nombre </th>
														<th class="text-center" style="width: 5%;"> Telefono </th>
														<th class="text-center" style="width: 5%;"> Direccion </th>
														<th class="text-center" style="width: 50%;"> Equipo </th>
														<th class="text-center" style="width: 5%;"> Falla </th>
														<th class="text-center" style="width: 5%;"> Status </th>
														<th class="text-center" style="width: 5%;"> Fecha </th>
														<th class="text-center" style="width: 10%;"> Costo por revision</th>
														<th class="text-center" style="width: 10%;"> Total</th>
														<th class="text-center" style="width: 10%;">Acciones </th>
													</thead>
													</tbody>
														<?php
															$registros = registrosBySucursal();
															
															$fecha_hoy=date('Y-m-d');
															
															foreach ($registros as $row){
																$correlativo=$row['correlativo'];
																$dni=$row['dni_cliente'];
																$nombre=$row['nombre_cliente'];
																$telefono=$row['telefono_cliente'];
																$descripcion=$row['descrip'];
																$revision=$row['costo_por_revision'];
																
																$falla=$row['falla'];
																$status=$row['status'];
																if($status==0){
																	$status_value="ANULADO";
																}
																if($status==1){
																	$status_value="REPARACION O MANTENIMIENTO";
																}
																elseif($status==2){
																	$status_value="LISTO PARA ENTREGAR";
																}
																elseif($status==3){
																	$status_value="ENTREGADO";
																}
																
																$direccion=$row['direccion_cliente'];
																$fecha=$row['fecha'];
																$total=$row['costo_total_trabajo'];
																$color = '';
																$content = '';
																switch ($status) {
																	case 1:
																		$color =  "red";
																		break;
																	case 2:
																		$color =  "yellow";
																		break;
																	case 3:
																		$color =  "#9af688";
																		break;
																}

																if($status != '0'){
																	$content = '<a href="cambiar_status.php?id='.$correlativo.'">Cambiar Status</a>';
																}
																
																echo "<tr>";
																
																echo '<td class="text-center"><a href="mPrincipal.php?id='.(int)$correlativo.'">'.$correlativo.'</a></td>';
																echo "<td>".remove_junk($dni)."</td>";
																echo "<td class=\"text-center\">".remove_junk($nombre)."</td>";
																echo "<td class=\"text-center\">".remove_junk($telefono)."</td>";
																echo "<td class=\"text-center\">".remove_junk($direccion)."</td>";
																echo "<td class=\"text-center\" style=\"width: 50%;\">".remove_junk($descripcion)."</td>";
																echo "<td class=\"text-center\">".remove_junk($falla)."</td>";
																echo "<td class=\"text-center\" bgcolor=\"".$color."\">".remove_junk($status_value)."</td>";
																echo "<td class=\"text-center\">".read_date($fecha)."</td>";  
																echo "<td class=\"text-center\">".$revision."</td>";
																echo "<td class=\"text-center\">".$total."</td>";
																echo "<td class=\"text-center\">".$content."</td>";
																echo "</tr>";
																
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
		<?php include_once('layouts/footer.php'); ?>
		<!--<script type="text/javascript" src="js/buscar_equipos.js"></script>-->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	</body>
</html>