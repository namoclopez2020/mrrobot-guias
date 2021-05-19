<?php

  $page_title = 'Admin página de inicio';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);

   
//capturar datos de la sucursal
$nombre_sucursal=$_SESSION['nombre_sucursal'];
$id_sucursal=$_SESSION['id_sucursal'];
$direccion_sucursal=$_SESSION['direccion_sucursal'];
$telefono_sucursal = $_SESSION['telefono_sucursal'];
$ruc_sucursal= $_SESSION['ruc_sucursal'];
$ruta_logo=$_SESSION['ruta_imagen'];
$email_sucursal=$_SESSION['email_sucursal'];
$wsp_sucursal=$_SESSION['wsp_sucursal'];
?>
<html>
	<head>
	<?php include ("./layouts/header.php");?>
    <meta name="theme-color" content="#009aed"/>
    <meta name="theme-color" content="#4285f4">
	</head>
     
<body>

   <!-- <div class="container-fluid">-->
    <header >
        <?php include ("./layouts/nav.php");?>
    </header>
    
     <div  class="container-fluid" >
           
	
	<div class="menu-inicial ">
    
    <div class="mnu-container">
        
        <div class="colbot" >
            <div style="width: 92%">
                <?php echo display_msg($msg);?>
            </div>
             <!--CONTENEDOR ORDENES DE SERVICIO-->
            <a href="ods.php" class="taco tacoC "  >
                <div class="taco-contador" >
                    <span class="taco-titulo">
                        Ordenes De Servicio.
                    </span>      
                </div>
                <div class="taco-dato">
                    <br>
					Modulo Principal.<br>
					Imprimir Ordenes De Servicios.<br>
                    Estado y Ubicacion Del Equipo.
                    <img alt="imglogon" class="imagen-tacoA" src="uploads/empresa/6.png">
                 
                </div>
           
               
            </a>
             <!--FIN CONTENEDOR ORDENES DE SERVICIO-->
            <!--
            <a href="egresos.php" class="taco tacoC" >
                <div class="taco-contador" >
                  <span class="taco-titulo" >
                    Egresos.
                    </span>      
                </div>
                <div class="taco-dato"><br>
					Lista De egresos.<br>
					Agregar egresos.<br>
					<img alt="imglogon" class="imagen-tacoA" src="uploads/empresa/3.png">
                </div>
            </a>
            -->
            <a href="cliente.php" class="taco tacoC">
                <div class="taco-contador"  >
                  <span class="taco-titulo">
                        Clientes.
                    </span>      
                </div>
                <div class="taco-dato"><br>
                    Agregar Clientes.<br>
                    Lista de Clientes.<br>
                    <img alt="imglogon" class="imagen-tacoA" src="uploads/empresa/usuario.png">
              </div>
            </a>
            <!--
            <a href="proveedores.php" class="taco tacoC" >
              
                <div class="taco-contador" >
                  <span class="taco-titulo">
                    Proveedores.
                    
                </span>      
                </div>
                <div class="taco-dato"><br>
                    Agregar Proveedores.<br>
                    Lista de Proveedores.<br>
                    <img alt="imglogon" class="imagen-tacoA" src="uploads/empresa/5.png">
                </div>
            </a>
            <a href="inventario.php" class="taco tacoC" >
              <div class="taco-contador" >
                  <span class="taco-titulo">
                   Inventario.
					
                </span>      
                </div>
                <div class="taco-dato"><br>
					Lista De Producto.<br>
					Compras.<br>
					Ventas.<br>
                    <img alt="imglogon" class="imagen-tacoA" src="uploads/empresa/4.png">
                </div>
            </a>
			-->
            <a href="panel.php" class="taco taco-imagenB">
               
                <div class="taco-contador-orange">
                  <span class="taco-titulo">
                    Vista General.
					
                </span>      
                </div>
                <div class="taco-dato"><br>
					
                    <img alt="imglogon" class="imagen-taco" src="uploads/empresa/<?php echo $ruta_logo;?>">
                </div>
            </a>
        </div>
       
		<!--<div class="pie-menu-inicial">
    <div class="pie-logo-saint">
        <img src="./libs/images/mr robot logo1.png" alt="imglogon" width="484" height="65" style="width:130px">
        <span class="version-saint">Tecnek Web</span>
    </div>
        </div>-->
    </div>


    <?php include ("./layouts/footer.php");?>



</body></html>