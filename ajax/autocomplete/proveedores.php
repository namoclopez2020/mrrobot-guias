<?php
require_once('../../includes/load.php');
if (isset($_GET['q'])){

//include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
	
if ($db->con())
{
	
	$fetch = $db->query("SELECT * FROM proveedor where nombre like '%" . $db->escape(($_GET['q'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row =$db->fetch_array($fetch)) {
		
		$row_array['value'] = $row['nombre'];
		$row_array['ruc']=$row['RUC'];
		$row_array['telefono']=$row['Telefono'];
		$row_array['id_proveedor']=$row['idproveedor'];
		$row_array['nombre_empresa']=$row['nombre'];
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
$db->db_disconnect();

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>