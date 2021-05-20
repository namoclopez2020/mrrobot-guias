<?php
require_once('../../includes/load.php');
if (isset($_GET['q'])){

//include("../../config/conexion.php");
$return_arr = array();
$id_sucursal=$_SESSION['id_sucursal'];
/* If connection to database, run sql statement. */
	
if ($db->con())
{
	
	$fetch = $db->query("SELECT * FROM cliente WHERE sucursal_id=".$id_sucursal." AND nombre_cliente like '%" . $db->escape(($_GET['q'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row =$db->fetch_array($fetch)) {
		$id_cliente=$row['id_cliente'];
		$row_array['value'] = $row['nombre_cliente'];
		$row_array['id_cliente']=$id_cliente;
		$row_array['nombre_cliente']=$row['nombre_cliente'];
		$row_array['telefono_cliente']=$row['telefono_cliente'];
		$row_array['dni_cliente']=$row['dni_cliente'];
		$row_array['direccion_cliente']=$row['direccion_cliente'];
		$row_array['email_cliente']=$row['email_cliente'];
		$row_array['edad_cliente']=$row['edad'];
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
$db->db_disconnect();

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>