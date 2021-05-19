<?php
ob_start();
$page_title="Cierre De Caja";
require_once('includes/load.php');
include_once('layouts/header.php');
//include ("./layouts/nav.php");
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
    .gris{
        background: rgba(0, 0, 0, 0.5);
      
    }
    body{
        background-image: url('./libs/images/1.jpg');
        background-position: center;
  background-repeat: repeat;
  background-size: cover;
	-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
	background-attachment: fixed;
    }
    .avatar{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: absolute;
    top: -70px;
    left: calc(50% - 50px);
}
    </style>
    <title>Cierre De Caja</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row " style="margin-top:100px">
            <div class="col-11 col-md-8 col-lg-7 mx-auto gris pt-4">
                <div class="row ">
                    <div class="col-12">
                        <img src="./libs/images/logo_login.png" alt="Logo" class="avatar">
                    </div>
                </div>
                <div class="row mb-2" style="margin-top:80px">
                    <div class="col-12">
                        <h1 class="bg-primary text-light text-center">Cierre de caja diario <?php $fecha_hoy=date('d-m-Y'); echo $fecha_hoy ?></h1>
                    </div>
                </div>
                <div class="table-responsive ">
                    <table class="table  table-hover text-light">
                        <thead class="">
                        <th>Nro</th>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Precio Unit.</th>
                        <th>Nombre Cliente</th>
                        <th>Nro. Factura</th>
                        <th>Cantidad</th>
                        <th>Total Factura</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                                
<?php
$fecha_hoy=date('Y-m-d');
$horai="00:00:00";
$horaf="23:59:59";
$id_sucursal = $_SESSION['id_sucursal'];
//echo "<h1>Cierre de caja diario $fecha_hoy<h1>";
$consulta="SELECT * FROM sales 
INNER JOIN products ON sales.product_id=products.id 
WHERE sales.date BETWEEN '$fecha_hoy $horai' AND '$fecha_hoy $horaf' and sales.id_sucursal = '$id_sucursal'";
$resultado=$db->query($consulta); 
$nro=1;
$sumaprecio=0;//total declarado antes del bucle
while($filas=mysqli_fetch_array($resultado)){
        echo "<tr>";
        echo "<td>" . $nro . "</td>";
	    echo "<td>" . $filas["name"] . "</td>";
		echo "<td>" . $filas["quantity"] . "</td>";
		echo "<td>" . $filas["sale_price"] . "</td>";
		echo "<td>" . $filas["nom_cliente"] . "</td>";
		echo "<td>" . $filas["numero_factura"] . "</td>";
		echo "<td>" . $filas["qty"] . "</td>";
		echo "<td>" . $filas["price"] . "</td>";
        echo "</tr>";
        
        $nro++;
    
     
        $sumaprecio=$sumaprecio+$filas['price'];
        
    }
    
?>

        


                            </tbody>
                            
                    </table>
                    <h1 class="bg-primary text-light"> Total Cierre De Caja Diario: <?php echo "S/. ".$sumaprecio."" ; ?></h1>
                     <input type="button" class="btn btn-success btn-lg" value="Imprimir" onclick="window.print()">
                    
                </div>
               
            </div>
        </div>

    </div>












    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>