<?php
require_once('../includes/load.php');

  // Checkear nivel de permiso para esta pagina
  page_require_level(2);
$products = join_product_table();
if(isset($_POST['categoria'])){
   // si no hay errores
   $cont=1;
   	   $p_name=remove_junk($db->escape($_POST['product-title']));
   	   $p_provid=remove_junk($db->escape($_POST['product-provider']));
   	   $id_sucursal=remove_junk($db->escape($_POST['product-sucursal']));
   	   $p_cat=remove_junk($db->escape($_POST['categoria']));
	   $p_buy   = remove_junk($db->escape($_POST['buying_price']));
	   $p_sale= remove_junk($db->escape($_POST['sale_price']));
	   $p_qty=0;
	    
	   foreach($products as $product){
			 $cont=$product['id'];
			
		 }
	 $code="P0".$cont;
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
	 $tipo_movimiento=1;
     $query  = "INSERT INTO products (";
     $query .=" quantity,name,codigo_producto,buy_price,sale_price,categorie_id,media_id,prov,date,id_sucursal,visto";
     $query .=") VALUES (";
     $query .=" '{$p_qty}','{$p_name}','{$code}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$p_provid}', '{$date}','{$id_sucursal}','no'";
     $query .=")";
	  
	  
     //si la insercion se ejecuta correctamente
     if($db->query($query)){
		 $consulta="select LAST_INSERT_ID(id) as last from products order by id desc limit 0,1 ";
		 $id=$db->query($consulta);
		 $id=$db->fetch_array($id);
		 $id_producto=$id['last'];
		 
	 insertar_movimiento_producto($id_producto,$tipo_movimiento,$p_qty,$_SESSION['user_id'],$date);
		
       $session->msg('s',"Producto agregado exitosamente. ");
     //  redirect('./product.php', false);
		
     } else {
       $session->msg('d',' Lo siento, registro falló.');
      // redirect('./add_product.php', false);
     }
echo display_msg($msg);
   

 }

?>