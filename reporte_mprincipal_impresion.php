<style type="text/css">

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
	table.page_footer {
		width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;
	}
</style>
<?php 
	include("includes/load.php");
	$correlativo=$_GET['correlativo'];

	$sql=$db->query("select *  from registro as r INNER JOIN cliente as c ON r.id_cliente_registro=c.id_cliente INNER JOIN sucursales as s ON r.id_sucursal_registro=s.id where correlativo=$correlativo ");
	$count_query   = $db->query( "select COUNT(*) as numrows from registro as r INNER JOIN cliente as c ON r.id_cliente_registro=c.id_cliente INNER JOIN sucursales as s ON r.id_sucursal_registro=s.id where correlativo=$correlativo ");
	$row=$db->fetch_array($count_query);
	$numrows = $row['numrows'];

	if( $numrows>0){
		$rw=$db->fetch_array($sql);
		//capturar datos 
		$id_vendedor=$rw['tecnico_asignado'];
		$descripcion=str_replace("<br/>","\n",$rw['descrip']);
		$nombre_cliente=$rw['nombre_cliente'];
		$dni_cliente=$rw['dni_cliente'];
		$telefono_cliente=$rw['telefono_cliente'];
		$email_cliente=$rw['email_cliente'];
		$direccion_cliente=$rw['direccion_cliente'];
		$servicio=$rw['falla'];
		$status_num=$rw['status'];
		$edad_cliente=$rw['edad'];

		//capturar datos de la sucursal 
		$nombre_sucursal=$rw['nombre_sucursal'];
		$direccion_sucursal=$rw['direccion_sucursal'];
		$telefono_sucursal=$rw['telefono_sucursal'];
		$ruc_sucursal=$rw['RUC_SUCURSAL'];
		$ruta_logo=$rw['image_path'];
		$email_sucursal = $rw['email'];
		
		if($status_num==0){
			$status="ANULADO";
		}
		elseif($status_num==1){
			$status="EN REPARACION O MANTENIMIENTO";
		}elseif($status_num==2){
			$status="LISTO PARA ENTREGAR";
		}elseif ($status_num==3){
			$status="ENTREGADO";
		}
		$repuesto=$rw['costo_del_repuesto'];
		$adelanto=$rw['abono_por_servicio'];
		$revision=$rw['costo_por_revision'];
		$costo=$rw['costo_total'];
		$direccion=$rw['direccion_cliente'];
		$informe=$rw['informe_final'];
		$pendiente=$rw['pendiente'];
		$total=$rw['costo_total_trabajo'];


		//capturar datos de la sucursal
		$nombre_sucursal=$_SESSION['nombre_sucursal'];
		$id_sucursal=$_SESSION['id_sucursal'];
		$direccion_sucursal=$_SESSION['direccion_sucursal'];
		$telefono_sucursal = $_SESSION['telefono_sucursal'];
		$ruc_sucursal= $_SESSION['ruc_sucursal'];
		$ruta_logo=$_SESSION['ruta_imagen'];


		$cargador=$rw['deja_cargador'];

	}else{
		$session->msg("d","Correlativo no valido, primero cree la orden de servicio");
		?> 
			<script> 
				alert('Correlativo no valido, primero cree la orden de servicio');
				window.close();

			</script>
		<?php
	}
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
            <td style="width: 23%; color: #444444;">
                <img style="width: 100%;" src="uploads/empresa/<?php echo $ruta_logo?>" alt="Logo"><br>
            </td>
			<td style="width: 55%; color: #34495e;font-size:14px;text-align:center;padding:3% 10% 3% 4%">
                <span style="color: #34495e;font-size:20px;font-weight:bold"> <?php echo $nombre_sucursal;?></span>
				<br><?php echo $direccion_sucursal;?><br> 
				RUC: <?php echo $ruc_sucursal;?><br>
				CEL: <?php echo $telefono_sucursal;?><br>
				E-MAIL: <?php echo $email_sucursal;?>
            </td>
			<td style="width: 35%;text-align:right;">
				COMPROBANTE Nº <?php echo $correlativo;?>
			</td>
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td  style="width:50%;" class='midnight-blue'>Datos del cliente</td>
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
           <td style="width:35%;" class='midnight-blue'>VENDEDOR</td>
		  	<td style="width:25%;" class='midnight-blue'>FECHA</td>
		   <td style="width:40%;" class='midnight-blue'>FORMA DE PAGO</td>
        </tr>
		<tr>
           	<td style="width:35%;">
				<?php 
					$sql_user=$db->query("select * from users where id='$id_vendedor'");
					$rw_user=$db->fetch_array($sql_user);
					echo $rw_user['name'];
				?>
		   	</td>
		  	<td style="width:25%;"><?php echo date("d/m/Y H:m:s");?></td>
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
	<table border="0" align="center"><tr><td>Transcurridos 30 días su equipo sera tomado como parte de pago del servicio</td></tr></table>
	</div> -->
</page>


