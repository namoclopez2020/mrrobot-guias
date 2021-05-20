<?php
	require_once('includes/load.php');
	// Checkin What level user has permission to view this page
	page_require_level(3);
	error_reporting(0);
	$nombre_cliente= (isset($_POST['name'])) ? $_POST['name'] : null;
	$telefono= (isset($_POST['tlf'])) ? $_POST['tlf'] : null;
	$dni= (isset($_POST['dni_a'])) ? $_POST['dni_a'] : null;
	$direccion=(isset($_POST['address'])) ? $_POST['address'] : null;
	$email= isset($_POST['email_cliente']) ? $_POST['email_cliente'] : null;
	$edad= isset($_POST['edad_cliente']) ? $_POST['edad_cliente'] : null;

	$pedidos="Sin pedidos";
	$grupo="Ordinario";
	$date=make_date();
	$id_sucursal = $_SESSION['id_sucursal'];

	$query="INSERT INTO cliente (nombre_cliente,telefono_cliente,dni_cliente,direccion_cliente,email_cliente,date_added,grupo_cliente,pedidos_cliente,sucursal_id,edad) VALUES ('$nombre_cliente','$telefono','$dni','$direccion','$email','$date','$grupo','$pedidos','$id_sucursal','$edad')";

	if($db->query($query) && $db->affected_rows()==1){

		$session->msg("s", "Cliente guardado exitosamente.");}
	else{
		$session->msg("d","Hubo un problema con el registro del nuevo cliente");
	}
	echo display_msg($msg);
?>
