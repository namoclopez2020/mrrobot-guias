﻿<style type="text/css">

	table { vertical-align: top; }
	tr    { vertical-align: top; }
	td    { vertical-align: top; }
	.midnight-blue{
		background : #2fcdfd;
		padding: 4px 4px 4px;
		color:white;
		font-weight:bold;
		font-size:12px;
	}
	.silver{
		background:white;
		padding: 3px 4px 3px;
	}
	.clouds{
		background:#ecf0f1;
		padding: 3px 4px 3px;
	}
	.border-top{
		border-top: solid 1px #bdc3c7;
		
	}
	.border-left{
		border-left: solid 1px #bdc3c7;
	}
	.border-right{
		border-right: solid 1px #bdc3c7;
	}
	.border-bottom{
		border-bottom: solid 1px #bdc3c7;
	}
	table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
	}

</style>
<?php 
	include("includes/load.php");
	$id_vendedor=$_SESSION['user_id'];
	$current_user=find_by_id('users',$id_vendedor);
	$id_vendedor=$current_user['id'];

	$descripcion=$_GET['info'];
	$id_cliente=$_GET['cliente'];
	$servicio=$_GET['servicio'];
	$status="REPARACION O MANTENIMIENTO";
	$status_num=1;
	$repuesto=$_GET['repuesto'];
	$adelanto=$_GET['adelanto'];
	$revision=$_GET['revision'];
	$costo=$_GET['costo'];

	//capturar datos de la sucursal
	$nombre_sucursal=$_SESSION['nombre_sucursal'];
	$id_sucursal=$_SESSION['id_sucursal'];
	$direccion_sucursal=$_SESSION['direccion_sucursal'];
	$telefono_sucursal = $_SESSION['telefono_sucursal'];
	$ruc_sucursal= $_SESSION['ruc_sucursal'];
	$ruta_logo=$_SESSION['ruta_imagen'];
	$email_sucursal=$_SESSION['email_sucursal'];
	$wsp_sucursal=$_SESSION['wsp_sucursal'];


	$informe=$_GET['informe'];
	$pendiente=$costo+$revision+$repuesto-$adelanto;
	$total=$costo+$revision+$repuesto;
	$a='*';
	$b='<br>*';
	$descripcion=str_replace($a,$b,$descripcion);
	$cargador=$_GET['cargador'];
	if($cargador=="1"){
		$cargador_value="SI DEJA CARGADOR";
	}else{
		$cargador_value="NO DEJA CARGADOR";
	}

	$date= make_date();

	//query para insertar en la tabla registro
	$insertar="insert into registro (descrip,falla,status,fecha,costo_por_revision,costo_total_trabajo,abono_por_servicio,tecnico_asignado,informe_final,costo_del_repuesto,costo_total,deja_cargador,pendiente,id_cliente_registro,id_sucursal_registro)
	VALUES ('$descripcion','$servicio','$status_num','$date','$revision','$total','$adelanto','$id_vendedor','$informe','$repuesto','$costo','$cargador_value','$pendiente','$id_cliente','$id_sucursal') ";
	//insertar registro
	$db->query($insertar);
	//buscar el ultimo correlativo
	$sql=$db->query("select LAST_INSERT_ID(correlativo) as last from registro order by correlativo desc limit 0,1 ");

	$rw=$db->fetch_array($sql);
	$numero_factura=$rw['last'];
	//query para insertar en la tabla pagos_registro
	$insertar_pago="INSERT INTO pagos_registro (id_correlativo_registro,pagado,fecha_pago,id_vendedor,sucursal_id) VALUES ('$numero_factura','$adelanto','$date','$id_vendedor','$id_sucursal')";
	if(!$db->query($insertar_pago)){
		?> 
			<script>window.close();</script>
		<?php
	}

	$datos_cliente="SELECT * FROM cliente where id_cliente=$id_cliente";
	$cliente=$db->query($datos_cliente);
	$datos_cl=$db->fetch_array($cliente);
	$nombre_cliente=$datos_cl['nombre_cliente'];
	$telefono_cliente=$datos_cl['telefono_cliente'];
	$dni_cliente=$datos_cl['dni_cliente'];
	$direccion_cliente=$datos_cl['direccion_cliente'];
	$email_cliente=$datos_cl['email_cliente'];
	$edad_cliente=$datos_cl['edad'];
?>

<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 50%; text-align: left">
                </td>
                <td style="width: 50%; text-align: right;">
                    &copy; <?php echo "Mr Robot "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>
            <td style="width: 23%;height:20%; color: #444444;">
                <img style="width: 100%" src="uploads/empresa/<?php echo $ruta_logo?>" alt="Logo"><br>
            </td>
			<td style="width: 55%; color: #34495e;font-size:14px;text-align:center;padding:3% 10% 3% 4%">
                <span style="color: #34495e;font-size:20px;font-weight:bold"> <?php echo $nombre_sucursal;?></span>
				<br><?php echo $direccion_sucursal;?><br>
				CEL: <?php echo $telefono_sucursal;?><br>
				E-MAIL: <?php echo $email_sucursal;?>
            </td>
			<td style="width: 35%;text-align:right; 	">
			COMPROBANTE Nº <?php echo $numero_factura;?>
			</td>
			
        </tr>
    </table>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td  style="width:50%;" class='midnight-blue'>Datos del paciente</td>
        </tr>
		<tr>
			<td style="width:100%; height: 50%;line-height : 20px;" >
				<span style="font-size: 15px;font-weight: bold">Nombres y Apellidos:</span> <?php echo $nombre_cliente;?> <br>
				<span style="font-size: 15px;font-weight: bold">Direccion:</span> <?php echo $direccion_cliente;?> <br>
				<span style="font-size: 15px;font-weight: bold">Email:</span> <?php echo $email_cliente;?> <br>
				<span style="font-size: 15px;font-weight: bold">Edad:</span> <?php echo $edad_cliente;?> <br>
				<span style="font-size: 15px;font-weight: bold">DNI:</span> <?php echo $dni_cliente;?> <br>
				<span style="font-size: 15px;font-weight: bold">TLF:</span> <?php echo $telefono_cliente;?> <br>
			</td>
        </tr>
    </table>
	<br>
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
		<tr>
			<td style="width:35%;" class='midnight-blue'>MÉDICO</td>
			<td style="width:25%;" class='midnight-blue'>FECHA</td>
			<td style="width:40%;" class='midnight-blue'>FORMA DE PAGO</td>
		</tr>
		<tr>
			<td style="width:35%;">
				<?php echo $current_user['name']; ?>
			</td>
			<td style="width:25%;">
				<?php echo date("d/m/Y H:m:s");?>
			</td>
			<td style="width:40%;" >
				<?php 
					$condiciones=1;
					if ($condiciones==1){echo "Efectivo";}
					elseif ($condiciones==2){echo "Cheque";}
					elseif ($condiciones==3){echo "Transferencia bancaria";}
					elseif ($condiciones==4){echo "Crédito";}
				?>
			</td>
		</tr>
	</table>
	<br>
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           	<td style="width:40%;" class='midnight-blue'>Presunción diagnostico / Diagnostico (CIE: 10)</td>
			<td style="width:30%;" class='midnight-blue'>SERVICIO A REALIZAR</td>
			<td style="width:30%;" class='midnight-blue'>OTROS SERVICIOS</td>
		   	<!-- <td style="width:40%;" class='midnight-blue'>STATUS</td> -->
        </tr>
		<tr>
           	<td style="width:40%;">
				<?php 
					echo $descripcion;
					echo "<br>";
				?>
		   	</td>
			<td style="width:30%;"><?php echo $servicio?></td>
			<td style="width:30%;"><?php echo $informe?></td>
        </tr>
    </table>
   	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
			<td style="width:40%;" class='midnight-blue'>CONSULTA MÉDICA: <?php echo $costo;?></td>
			<td style="width:30%;" class='midnight-blue'>COSTO OTROS SERVICIOS: <?php echo $repuesto;?></td>
			<td style="width:30%;" class='midnight-blue'></td>
		</tr>
    </table>
	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
			<td style="width:40%;" class='midnight-blue'>PENDIENTE: <?php echo $pendiente;?></td>
		   	<td style="width:30%;" class='midnight-blue'>ADELANTO: <?php echo $adelanto;?></td>
			<td style="width:30%;" class='midnight-blue'>COSTO TOTAL DEL SERVICIO: <?php echo $total;?></td>
		</tr>
    </table>
	<!-- <div style="font-size:11pt;text-align:center;font-weight:bold;width: 90%;"><table border="1"  cellpadding="0" cellspacing="0" style="width: 40%;height: 10%;border-style: solid;margin-top: 2%;" align="center"><tr><td><table  align="center" border="0" cellpadding="0" cellspacing="0" style="border-style: solid; border-top-width: 1px;width: 90%;margin-top: 20%"><tr><td style="padding: 0px 10% 0px 10%;text-align: center">FIRMA DEL CLIENTE</td></tr></table></td></tr></table>
	<table border="0" align="center"><tr><td>Transcurridos 30 días su equipo sera tomado como parte de pago del servicio</td></tr></table> -->
	<!-- </div> -->
	
	
	  

</page>


