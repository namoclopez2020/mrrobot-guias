<?php

  $page_title = 'Admin página de inicio';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
	page_require_level(3);

	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$consulta="SELECT * FROM registro as r INNER JOIN cliente as c ON r.id_cliente_registro=c.id_cliente where r.correlativo='$id'";
		$query=$db->query($consulta);
		while($data=$db->fetch_array($query)){
			$nombre=$data['nombre_cliente'];
			$id_cliente=$data['id_cliente'];
			$telefono=$data['telefono_cliente'];
			$dni=$data['dni_cliente'];
			$direccion=$data['direccion_cliente'];
			$email=$data['email_cliente'];
			$edad=$data['edad'];
			$descripcion=$data['descrip'];
			$descripcion=str_replace("<br/>","\n",$descripcion);
			$descripcion=str_replace("<br>","\n",$descripcion);
			$cargador=$data['deja_cargador'];
			$falla=$data['falla'];
			$informe=$data['informe_final'];
			$revision=$data['costo_por_revision'];
			$total=$data['costo_total_trabajo'];
			$repuesto=$data['costo_del_repuesto'];
			$adelanto=$data['abono_por_servicio'];
			$saldo=$data['pendiente'];
			$costo_servicio=$data['costo_total'];
			
		}
		
		
		
	}else{
		$id_cliente="";
		$nombre="";
		$telefono="";
		$dni="";
		$direccion="";
		$email="";
		// $descripcion="*MARCA:\n*MODELO:\n*S/N:\n*MEMORIA RAM: \n*DISCO DURO: \n*PLACA: \n*OTROS: \n";
		$descripcion="";
		$cargador="";
		$falla="";
		$informe="";
		$revision="";
		$total="";
		$repuesto="";
		$adelanto="";
		$saldo="";
		$costo_servicio="";
		$sql=$db->query("select LAST_INSERT_ID(correlativo) as last from registro order by correlativo desc limit 0,1 ");
		$rw=$db->fetch_array($sql);
		$id=$rw['last']+1;
		$edad = "";
	}
?>
<html>
	<head>
		<?php include ("./layouts/header.php");?>
	</head>
	<body>
		<header>
			<?php include ("./layouts/nav.php");?>
		</header>
		<div class="container-fluid">
			<div class="menu-inicial " >
				<div class="mnu-container" >
					<?php echo display_msg($msg);?>
				<div><!--boton regresar-->
				<a href="mPrincipal.php"><img src="libs/images/refresh.png" class="imagen-regresar"></a>
			</div> <!--fin boton regresar -->
			<div class="colbot"><!--inicio colbot-->
				<?php 
				include("model/nuevo_cliente.php");
				?>
				<form id="datos" role="form" name="datos" method="post">
					<div class="taco-mPrincipal taco-blue" >
						<div class="taco-contador1" >
							<span class="taco-titulo1">
								Datos del paciente
							</span>      
						</div>
						<div class="taco-dato1" >
							<table class="form-cliente"  style="color:black">
								<tr>
									<td colspan="2" rowspan="6">
										<button type="button" class="button-guardar" data-toggle="modal" data-target="#myModal"><img src="libs/images/usuario.png" class="imagen-taco"></button>
									</td>
								</tr>
								<tr>
									<td class="celda">Nombre: </td>
									<td class="celda">
										<input type="text" name="correlativo" id="correlativo" class ="textbox1" value="<?php echo $id;?>" hidden>
										<input type="text" name="id_cliente" id="id_cliente" class ="textbox1" value="<?php echo $id_cliente?>" hidden >
										<input type="text" name="nombre_cliente" id="nombre_cliente" class ="textbox1" value="<?php echo $nombre;?>" required>
									</td>
								</tr>
								<tr>
									<td class="celda">Telefono:</td>
									<td class="celda"><input type="text" name="telefono" id="telefono" value="<?php echo $telefono;?>" class ="textbox1" readonly></td>
								</tr>
								<tr>
									<td class="celda">DNI o RUC: </td>
									<td class="celda"><input type="text" name="dni" id="dni" value="<?php echo $dni;?>" class ="textbox1" readonly></td>
								</tr>
								<tr>
									<td class="celda">Direccion: </td>
									<td class="celda"><input type="text" name="direccion" id="direccion"  value="<?php echo $direccion;?>" class ="textbox1" readonly></td>
								</tr>
								<tr>
									<td class="celda">Edad: </td>
									<td class="celda"><input type="text" name="edad" id="edad" value="<?php echo $edad?>" class ="textbox1" readonly></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="taco-mPrincipal tacoB" >
						<div class="taco-contador2" >
							<span class="taco-titulo1">
								Presunción diagnostico
							</span>      
						</div>
						<div class="taco-dato1">
							<table class="form-equipo" border="0" style="color:black">
								<tr>
									<td class="celda1" style="margin-bottom:10px">Diagnostico (CIE: 10)</td>
									<td colspan="2">
										<textarea name="info" id="info" class="textarea1"  style="margin-bottom:20px"><?php echo $descripcion?></textarea>
									</td>
								</tr>
								<!-- <tr>
								<td class="celda2">Deja cargador:</td>
								<td>
									<input type="radio" value="1" name="cargador" id="cargador">Sí &nbsp;
									<input type="radio" name="cargador" id="cargador" value="2" required>NO</td>
								<td class="cargador"></td>
								</tr> -->
								<tr>
									<td class="celda2">Servicio a realizar</td>
									<td colspan="2">
										<input type="text" name="vendedor" id="vendedor" value="<?php echo $user['id'] ?>" style="color:black" hidden>
										<textarea name="servicio" id="servicio" class="textarea2" required><?php echo $falla?></textarea>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="taco-mPrincipal1 tacoPlomo">
						<div class="taco-contador3">
							<span class="taco-titulo1">
								<table border="0" class="orden">
									<tr>
										<td class="nro-orden">Nro de Orden</td>
										<td>
											<table border="2" bordercolor="white" class="tabla10">
												<tr>
													<td class="correlativo"><?php echo $id?></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</span>      
						</div>
						<div class="taco-dato2">
							<table class="informe" >
								<tr>
									<td style="color:aqua">Otros Servicios</td>
								</tr>
								<tr>
									<td>
										<table bordercolor="white" border="1">
											<tr>
												<td class="celda3">
													<textarea name="informe" id="informe" class="textarea1"><?php echo $informe?></textarea>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="celda4">
										<input type="button" class="btn-success" name="actualizar" id="actualizar" value="GUARDAR CAMBIOS" >
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="taco-mPrincipal3 tacoPlomo" style="background-color: #4F4F4F;color:white">
						<div class="col-xs-4 col-md-4 col-lg-4" style="height:80%" >
							<button type="submit" name="guardar" id="guardar" class="button-guardar">
								<img src="libs/images/crear.png" class="imagen-taco" >
							</button>
						</div> 
						<div class="col-xs-4 col-md-4 col-lg-4"  style="height:80%;padding-top:9%" >
							<a href="borrar_registro.php?id=<?php echo (int)$id?>" class="button-guardar">
								<img src="libs/images/borrar.png" class="imagen-taco">
							</a>
						</div> 
						<div class="col-xs-4 col-md-4 col-lg-4" style="height:80%"  >
							<button type="button" name="imprimir" id="imprimir" class="button-guardar">
								<img src="libs/images/imprimir.png" class="imagen-taco">
							</button>
						</div> 
						<div class="col-xs-4 col-md-4 col-lg-4 text-center" style="height:20%" >
							Crear Orden
						</div> 
						<div class="col-xs-4 col-md-4 col-lg-4 text-center"  style="height:20%;" >
							Anular
						</div> 
						<div class="col-xs-4 col-md-4 col-lg-4 text-center" style="height:20%"  >
							Imprimir
						</div> 
					</div>
					<div class="taco-mPrincipal10 taco-aqua">
						<div class="taco-dato5" >
							<table class="tabla5" >
								<tr  style="display:none">
									<td class="celda">COSTO DE CONSULTA</td>
									<td class="celda">
										<input type="text" name="revision" id="revision" class ="textbox1" value="0" onChange="calcular()" required>
									</td>
								</tr>
								<tr>
									<td class="celda">COSTO DEL SERVICIO</td>
									<td class="Celda">
										<input type="text" name="costo" id="costo" class ="textbox1"  value="<?php echo $costo_servicio?>" onchange="calcular()" required>
									</td>
								</tr>
								<tr>
									<td class="celda">COSTO DE OTROS SERVICIOS</td>
									<td class="celda">
										<input type="text" name="repuesto" id="repuesto" class ="textbox1" value="<?php echo $repuesto?>" onChange="calcular()" required>
									</td>
								</tr>
								<tr>
									<td class="Celda">ADELANTO</td>
									<td class="celda">
										<input type="text" name="adelanto" id="adelanto" class ="textbox1" value="<?php echo $adelanto?>" onChange="calcular()" required>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="taco-mPrincipal5" style="background-color: #4F4F4F;color:white">
						<div class="taco-dato10">
							<table class="tabla-cuenta" >
								<tr>
									<td class="saldo">Saldo:</td>
									<td class="saldo1">
										<input type="label" name="saldo" id="saldo" value="<?php echo $saldo?>" readonly="readonly" class="saldo-caja">
									</td>
								</tr>
								<tr>
									<td class="total">Total:</td>
									<td class="total1">
										<input type="label" name="total" id="total" value="<?php echo $total?>" readonly="readonly" class="total-caja">
									</td>
								</tr>
							</table>
						</div>
					</div>
				</form>
				<!--fin del formulario-->
				<div class="taco-mPrincipal4 taco-green" >
					<div class="container-fluid "> 
						<div class="table-responsive"   style="height: 100%;border: 0px">
							<table class="table"  id="example" border="0" style="font-size: 12px;background-color:white;font-weight: bold">
								<thead style="background-color: #4F4F4F;color:white">
										<th class="text-center" style="width: 5%;"> Correlativo</th>
										<th class="text-center" style="width: 5%; "> DNI</th>
										<th class="text-center" style="width: 10%;">Nombre </th>
										<th class="text-center" style="width: 5%;"> Telefono </th>
										<th class="text-center" style="width: 5%;"> Direccion </th>
										<th class="text-center" style="width: 40%;">Presunción diagnostico / Diagnostico (CIE: 10)</th>
										<th class="text-center" style="width: 5%;"> Servicio </th>
										<!-- <th class="text-center" style="width: 5%;"> Status </th> -->
										<th class="text-center" style="width: 5%;"> Fecha </th>
										<th class="text-center" style="width: 10%;"> Consulta Médica</th>
										<th class="text-center" style="width: 10%;"> Otros Servicios</th>
										<th class="text-center" style="width: 10%;"> Total</th>
										<th class="text-center" style="width: 10%;"> Cantidad pagada</th>
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
											$costo = $row['costo_total'];
											$repuesto = $row['costo_del_repuesto'];
											$adelanto=$row['abono_por_servicio'];
											// if($status==0){
											// 	$status_value="Anulado";
											// }
											// elseif($status==1){
											// 	$status_value="REPARACION O MANTENIMIENTO";
											// }
											// elseif($status==2){
											// 	$status_value="LISTO PARA ENTREGAR";
											// }
											// elseif($status==3){
											// 	$status_value="ENTREGADO";
											// }
											
											$direccion=$row['direccion_cliente'];
											$fecha=$row['fecha'];
											$total=$row['costo_total_trabajo'];
											
											echo "<tr>";
											echo "<td class=\"text-center\"><a href='mPrincipal.php?id=".(int)$correlativo."'>".$correlativo."</a></td>";
											echo "<td>".remove_junk($dni)."</td>";
											echo "<td class=\"text-center\">".remove_junk($nombre)."</td>";
											echo "<td class=\"text-center\">".remove_junk($telefono)."</td>";
											echo "<td class=\"text-center\">".remove_junk($direccion)."</td>";
											echo "<td class=\"text-center\" style=\"width: 50%;\">".remove_junk($descripcion)."</td>";
											echo "<td class=\"text-center\">".remove_junk($falla)."</td>";
											// echo "<td class=\"text-center\" bgcolor=\"".$color."\">".remove_junk($status_value)."</td>";
											echo "<td class=\"text-center\">".read_date($fecha)."</td>";  
											echo "<td class=\"text-center\">".$costo."</td>";
											echo "<td class=\"text-center\">".$repuesto."</td>";
											echo "<td class=\"text-center\">".$total."</td>";
											echo "<td class=\"text-center\">".$adelanto."</td>";
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
		<?php include ("./layouts/footer.php");?>
		<script type="text/javascript" src="js/VentanaCentrada.js"></script>
		<script type="text/javascript" src="js/nueva_factura.js"></script>
		<script>
			$(document).ready(function() {
				$('#nombre_cliente').autocomplete({
					source: function(request, response){
						$.ajax({
							url:"./ajax/autocomplete/clientes.php",
							dataType:"json",
							data:{q:request.term},
							success: function(data){
								response(data);
							}

						});
					},
					minLength: 1,
					select: function(event,ui){
						event.preventDefault();
							$('#id_cliente').val(ui.item.id_cliente);
							$('#nombre_cliente').val(ui.item.nombre_cliente);
							$('#telefono').val(ui.item.telefono_cliente);
							$('#email').val(ui.item.email_cliente);
							$('#dni').val(ui.item.dni_cliente);
							$('#direccion').val(ui.item.direccion_cliente);
							$('#edad').val(ui.item.edad_cliente);
					}
				});
			

			});
		</script>		
	</body>
</html>