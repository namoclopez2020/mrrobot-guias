<?php
	
require_once('../includes/load.php');
include('../layouts/header.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
 $products = find_all('products'); 
$categorias=find_all('categories');
$session_id=$_SESSION['user_id'];


//capturar datos de la sucursal
$id_sucursal=$_SESSION['id_sucursal'];

if (isset($_POST['id'])){$id=$_POST['id'];}

if (isset($_POST['cantidad']) && isset($_POST['costo_prod']))
{
$cantidad=$_POST['cantidad'];

$costo_compra=$_POST['costo_prod']*$cantidad;
if (isset($_POST['costo_prod']) && isset($_POST['costo_prod']))
{
	if($costo_compra == "")	{
	echo("Agregar Costo del Producto");
	
                
            

}else{}



}	
}
if (!empty($id) and !empty($cantidad) and !empty($costo_compra))
{
$insert_tmp=$db->query("INSERT INTO tmp_compra (id_producto_compra,cantidad_producto_compra,costo_compra_tmp,session_id_compra) VALUES ('$id','$cantidad','$costo_compra','$session_id')");

}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);	
$delete=$db->query("DELETE FROM tmp_compra WHERE id_tmp_compra='".$id_tmp."'");
}

?>
<div class="table-responsive">
<table class="table">
<tr>
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th class='text-right'>COSTO</th>
	<th class='text-right'>COSTO TOTAL</th>
	<th></th>
</tr>
<?php
	$sumador_total=0;
	
	$sql=$db->query("select * from products, tmp_compra where products.id=tmp_compra.id_producto_compra and id_sucursal='$id_sucursal' and tmp_compra.session_id_compra='".$session_id."'");
	while ($row=$db->fetch_array($sql))
	{
	$id_tmp=$row["id_tmp_compra"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad_producto_compra'];
	$nombre_producto=$row['name'];
	
	
	$costo_compra_unit=$row['costo_compra_tmp']/$cantidad;
	$costo_compra=$row['costo_compra_tmp'];
	$sumador_total+=$costo_compra;
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			<td class='text-right'><?php echo $costo_compra_unit;?></td>
			<td class='text-right'><?php echo $costo_compra;?></td>
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}
	
	$total_factura= number_format($sumador_total,2,'.','');
	$total_iva=($total_factura * 18 )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$subtotal=$total_factura-$total_iva;

?>
<tr>
	<td class='text-right' colspan=4>SUBTOTAL S/.</td>
	<td class='text-right'><?php echo number_format($subtotal,2);?></td>
	<td></td>
</tr>
<tr>	
	<td class='text-right' colspan=4>IGV (<?php echo "18"?>)% S/.</td>
	<td class='text-right'><?php echo number_format($total_iva,2);?></td>
	<td></td>
</tr>
<tr>
	<td class='text-right' colspan=4>TOTAL S/.</td>
	<td class='text-right'><?php echo number_format($total_factura,2);?></td>
	<td></td>
</tr>

</table>
</div>
</form>
