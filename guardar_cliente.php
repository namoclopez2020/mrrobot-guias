<?php
	require_once('includes/load.php');
	// Checkin What level user has permission to view this page
	page_require_level(3);
	error_reporting(0);
	$nombre_cliente=$_POST['name'];
	$telefono=$_POST['tlf'];
	$dni=$_POST['dni_a'];
	$direccion=$_POST['address'];
	$email=$_POST['email_cliente'];
	$pedidos="Sin pedidos";
	$grupo="Ordinario";
	$date=make_date();
	$id_sucursal = $_SESSION['id_sucursal'];

	$query="INSERT INTO cliente (nombre_cliente,telefono_cliente,dni_cliente,direccion_cliente,email_cliente,date_added,grupo_cliente,pedidos_cliente,sucursal_id) VALUES ('$nombre_cliente','$telefono','$dni','$direccion','$email','$date','$grupo','$pedidos','$id_sucursal')";

	if($db->query($query) && $db->affected_rows()==1){

		$session->msg("s", "Cliente guardado exitosamente.");}
	else{
		$session->msg("d","Hubo un problema con el registro del nuevo cliente");
	}
	echo display_msg($msg);
?>
