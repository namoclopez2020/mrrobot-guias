<?php
  $page_title = 'PROUCTOS VIGENTES';
  require_once('includes/load.php');

  // Checkin What level user has permission to view this page
  page_require_level(2);
  //capturar datos de la sucursal
  $all_products = inventario();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
	  <?php include ("./layouts/header.php");?>	
	</head>
  <header>
    <?php include ("./layouts/nav.php");?>
	</header>
  <body> 
  	<div  class="container-fluid" style="padding-top: 40px">
      <div class="col-md-12">
		    <div id="myModal" tabindex="-1"  aria-labelledby="myModalLabel">
			    <div  role="document">
				    <div class="modal-content">
				      <div class="modal-header">
					    <a href="add_product.php" class="btn btn-primary">Agregar producto</a>
              <a href="./FPDF/reportes/reporte_inventario.php" class="btn btn-warning " style="margin-right:30">Reporte</a>
              <a href="./FPDF/reportes/lista_productos.php" class="btn btn-success pull-right" style="margin-left:10px">Exportar Lista</a>
				    </div>
				  <div class="modal-body">
					<div class="table-responsive">        
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead >
                  <tr class="warning">
                    <th class="text-center" style="width: 50px;">#</th>
                    <th> Imagen</th>
                    <th> Descripción </th>
                    <th class="text-center" style="width: 10%;"> Categoría </th>
                    <th class="text-center" style="width: 10%;"> Stock </th>
                    <th class="text-center" style="width: 10%;"> Precio de compra </th>
                    <th class="text-center" style="width: 10%;"> Precio de venta </th>
                    <th class="text-center" style="width: 10%;"> Agregado </th>
                    <th class="text-center" style="width: 100px;"> Acciones </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($all_products as $row){
                      $id_producto=$row['id'];
					            $fecha_agregado=$row['date'];
                      $codigo_producto=$row['codigo_producto'];
                      $nombre_producto=$row['nombre_prod'];
                      $costo=$row['buy_price'];
                      $precio_venta=$row["sale_price"];
                      $imagen_id=$row['media_id'];
                      $imagen=$row['file_name'];
                      $id_categoria=$row['categorie_id'];
                      $id_sucursal=$row['id_sucursal'];
                      $categoria=$row['nombre_suc'];
                      $sucursal=$row['nombre_sucursal'];
                      $precio_venta=number_format($precio_venta,2);
                      $stock=$row["quantity"];

                      echo "<tr>";
                      echo "<td class=\"text-center\">".count_id()."</td>";
                      echo "<td>";
                      if($imagen_id === '0'):
                        echo "<img class=\"img-thumbnail img-circle\" style=\"height: 60px;width: 60px\" src=\"uploads/products/no_image.jpg\" alt=\"\">";
                      else:
                        echo "<img class=\"img-avatar img-circle\" style=\"height: 60px;width: 60px\" src=\"uploads/products/".$imagen."\" alt=\"\">";
                      endif;
                      echo "</td>";
                      echo "<td>".remove_junk($nombre_producto)."</td>";
                      echo "<td class=\"text-center\">".remove_junk($categoria)."</td>";
                      echo "<td class=\"text-center\">".remove_junk($stock)."</td>";
                      echo "<td class=\"text-center\">".remove_junk($costo)."</td>";
                      echo "<td class=\"text-center\">".remove_junk($precio_venta)."</td>";
                      echo "<td class=\"text-center\">".read_date($fecha_agregado)."</td>";
                      echo "<td class=\"text-center\">";
                      echo " <div class=\"btn-group\">";
                      echo "<a href=\"edit_product.php?id=".(int)$id_producto."\" class=\"btn btn-info btn-xs\"  title=\"Editar\" data-toggle=\"tooltip\">";
                      echo "<span class=\"glyphicon glyphicon-edit\"></span>";
                      echo "</a>";
                      // echo "<a href=\"delete_product.php?id=".(int)$id_producto."\" class=\"btn btn-danger btn-xs\"  title=\"Eliminar\" data-toggle=\"tooltip\">";
                      // echo "<span class=\"glyphicon glyphicon-trash\"></span>";
                      // echo "</a>";
                      echo "<a href=\"movimientos.php?id=".(int)$id_producto."\" class=\"btn btn-warning btn-xs\"  title=\"Historial\" data-toggle=\"tooltip\">";
                      echo "<span class=\"glyphicon glyphicon-info-sign\"></span>";
                      echo "</a>";
                      echo "</div>";
                      echo "</td>";
                      echo "</tr>";
                    }
					        ?>
                </tbody>        
              </table>          
            </div>
			  </div>
			</div>	
		</div>
	  <hr>
	  <?php include_once('layouts/footer.php'); ?>
  </body>
</html>