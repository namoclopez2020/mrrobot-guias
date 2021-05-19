<?php

	$page_title = 'Admin página de inicio';
	require_once('includes/load.php');
	
	page_require_level(3);

	if(isset($_GET['id'])){
		if(find_by_id_egreso('egreso',(int)$_GET['id'])){

			$id=$_GET['id'];
			$consulta="SELECT * FROM  egreso where id_egreso='$id'";
			$query=$db->query($consulta);
			while($data=$db->fetch_array($query)){
				$id_egreso=$data['id_egreso'];
				$concepto=$data['concepto'];
				$fecha_egreso=$data['fecha'];
				$monto=$data['monto'];
			}
		}
		else{
		$id="";
		$id_egreso="";
		$concepto="";
		$fecha_egreso="";
		$monto="";
		}
	}else{
		$id="";
		$id_egreso="";
		$concepto="";
		$fecha_egreso="";
		$monto="";
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
    
    <div  class="container-fluid" >
		
		<div class="row">
			<div class="col-lg-11">
				<?php echo display_msg($msg);?>
			</div>
			
			<div class="col-lg-5">
				
					<div class="panel panel-primary" style="">
						<div class="panel-heading">
							<span class="h4" style="color:white">
								NUEVO EGRESO
							</span>
						</div>
						<div class="panel-body">
							<form name="datos" id="datos" method="POST" action="crear_egreso.php">
								<span>CONCEPTO:</span>
								<div class="form-group">
									<input type="text" name="id" value="<?php echo $id_egreso?>" hidden>
									<textarea class="form-control" name="concepto_egreso"><?php echo $concepto?></textarea> 
								</div> 
								<div class="form-group">
									<span>Monto: </span>
									<input type="text" style="color:black" class="form-control" name="monto_egreso" value="<?php echo $monto?>">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-4">
											<button type="submit" name="guardar" id="guardar" class="button-guardar">
												<img src="libs/images/crear.png" class="imagen-taco" >
											</button>
										</div>
										<div class="col-lg-4">
											<a href="borrar_egreso.php?id=<?php echo (int)$id?>" >
												<img src="libs/images/borrar.png" class="imagen-taco">
											</a>
										</div>
										<div class="col-lg-4">
											<button type="button" name="actualizar" id="actualizar" class="button-guardar">
												<img src="libs/images/refresh.png" class="imagen-taco" >
											</button>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 text-center text-muted">
											Registrar egreso
										</div>
										<div class="col-lg-4 text-center text-muted">
											ELiminar Egreso
										</div>
										<div class="col-lg-4 text-center text-muted">
											Actualizar
										</div>
									</div>
								</div>
							</form>
						</div> 
						
					</form>
			
				</div>
				<div class="taco-egreso"  style="background-color:#AED6F1 ">
					<div class="container-fluid ">
						<div class="table-responsive" style="height: 90%" >
							<table class="table table-striped table-bordered" id="example" >
								<thead>
									<tr class="warning">
										<th style="width: 20%"> Nro egreso</th>
										<th class="text-center" style="width: 30%;">Fecha</th>
										<th class="text-center" style="width: 30%"> Concepto</th>
										<th class="text-center" style="width: 20%;">Monto </th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql="select * from egreso";

										if ($query=$db->query($sql) ){
	
											while ($row=$db->fetch_array($query)){
												$correlativo=$row['id_egreso'];
												$fecha=$row['fecha'];
												$concepto=$row['concepto'];
												$monto=$row['monto'];

												echo "<tr>";
												echo "<td class=\"text-center\"><a href=\"egresos.php?id='".(int)$correlativo."\">".remove_junk($correlativo)."</a></td>";
												echo "<td class=\"text-center\">".read_date($fecha)."</td>";
												echo "<td class=\"text-center\">".remove_junk($concepto)."</td>";
												echo "<td class=\"text-center\">".remove_junk($monto)."</td>";
												echo "</tr>";
											}
										}
									?>									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
			
			
			</div>
		</div>
		
	</div>
    <?php include ("./layouts/footer.php");?>


<script type="text/javascript" src="js/buscar_egresos.js"></script>

<script>

// document.addEventListener('DOMContentLoaded', function() {
//     var elems = document.querySelectorAll('.fixed-action-btn');
//     var instances = M.FloatingActionButton.init(elems, {
//       direction: 'top',
//       hoverEnabled: false
//     });
//   });

</script>
<!--FIN BOTON DEPLEGABLE-->
</body></html>