<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
error_reporting(0);


$id_vendedor=$_SESSION['user_id'];
$current_user=find_by_id('users',$id_vendedor);
$id_vendedor=$current_user['id'];

$id=$_POST['correlativo'];
//chequear si esta anulado 
$query="select status from registro where correlativo=".$db->escape($id);
$q=$db->query($query);
while($fila=$db->fetch_array($q)){
	$vigente=$fila['status'];
}
if($vigente!=="0"){


//recepcion de datos
$id_vendedor=$_SESSION['user_id'];
$descripcion=$_POST['info'];
$servicio=$_POST['servicio'];
$repuesto=$_POST['repuesto'];
$adelanto=$_POST['adelanto'];
$revision=$_POST['revision'];
$costo=$_POST['costo'];
$informe=$_POST['informe'];
$pendiente=$costo+$revision+$repuesto-$adelanto;
$total=$costo+$revision+$repuesto;
$a='*';
$b='*';
$descripcion=str_replace($a,$b,$descripcion);
$cargador=$_POST['cargador'];
if($cargador=="1"){
	$cargador_value="SI DEJA CARGADOR";
}else{
	$cargador_value="NO DEJA CARGADOR";
}


//capturar datos de la sucursal
$nombre_sucursal=$_SESSION['nombre_sucursal'];
$id_sucursal=$_SESSION['id_sucursal'];
$direccion_sucursal=$_SESSION['direccion_sucursal'];
$telefono_sucursal = $_SESSION['telefono_sucursal'];
$ruc_sucursal= $_SESSION['ruc_sucursal'];
$ruta_logo=$_SESSION['ruta_imagen'];


$date=make_date();

$datos="SELECT * from registro where correlativo=$id";

$buscar=$db->query($datos);

while($data=$db->fetch_array($buscar)){
	$pen=$data['abono_por_servicio'];
}
$abono_final=(double)$adelanto-(double)$pen;

$query="UPDATE registro set descrip='$descripcion',falla='$servicio',fecha='$date',costo_por_revision='$revision',costo_total_trabajo='$total',abono_por_servicio='$adelanto',tecnico_asignado='$id_vendedor',informe_final='$informe',costo_del_repuesto='$repuesto',costo_total='$costo',deja_cargador='$cargador_value',pendiente='$pendiente', id_sucursal_registro='$id_sucursal' where correlativo=$id ";

$insertar_pago="INSERT INTO pagos_registro (id_correlativo_registro,pagado,fecha_pago,id_vendedor,sucursal_id) VALUES ( $id,'$abono_final','$date','$id_vendedor','$id_sucursal')";
if($db->query($query) && $db->affected_rows()==1) {

	if($abono_final==0){
		$session->msg("s", "Datos actualizados correctamente.");
	}else{
		if($db->query($insertar_pago)){
			$session->msg('s',"Datos actualizados y pago ingresado correctamente");
		}
	}

  }
else{
	$session->msg("d","Hubo un problema con la actualización");
}
}else{
	$session->msg("d","Esta guia esta anulada, no se puede actualizar");
}
?>
