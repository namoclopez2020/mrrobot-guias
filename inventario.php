<?php

  $page_title = 'Ordenes de servicio';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<html>
	<head>
	<?php include ("./layouts/header.php");?>
	
	</head>
<body>

    <header>
  	<?php include ("./layouts/nav.php");?>
	</header>
    <div  class="container-fluid">
	 <?php echo display_msg($msg); ?>
	<div class="menu-inicial ">
    
    <div class="mnu-container" style="margin-left: 0px;">
        
        <div class="colbot">
            <a href="product.php" class="taco taco-principal">
            
                <div class="taco-dato-principal">
                    <img alt="imglogon" class="imagen-tacoB" src="libs/images/modulo_principal.png">
                </div>

                <span class="taco-titulo-principal">
                    Productos
                </span>
               
            </a>
            <a href="compras.php" class="taco taco-principal-B">
            
                <div class="taco-dato-principal">
                    <img alt="imglogon" class="imagen-tacoB" src="libs/images/egresos.png">
                </div>

                <span class="taco-titulo-principal">
                    Compras
                </span>
               
            </a>
            <a href="facturas.php" class="taco tacoA">
             
                <div class="taco-dato-principal">
                    <img alt="imglogon" class="imagen-tacoB" src="libs/images/estatus.png">
                </div>

                <span class="taco-titulo-principal">
                   Ventas
                </span>
            </a>
            <a href="categorie.php" class="taco tacoA" style="background-color: #ADBBBD">
             
                <div class="taco-dato-principal">
                    <img alt="imglogon" class="imagen-tacoB" src="libs/images/categoria.png">
                </div>

                <span class="taco-titulo-principal">
                   Categorias
                </span>
            </a>
             <a href="media.php" class="taco tacoA" >
             
                <div class="taco-dato-principal">
                    <img alt="imglogon" class="imagen-tacoB" style="width: 220px;height: 170px"src="libs/images/imagen.png">
                </div>

                <span class="taco-titulo-principal">
                   Imagenes
                </span>
            </a>
			
           
            <!--<a href="" class="taco taco-imagenB">
               
                <div class="taco-contador-blue">
                  <span class="taco-titulo">
                    Estatus del taller
					
                </span>      
                </div>
                <div class="taco-dato"><br>
					
                    <img alt="imglogon" class="imagen-taco" src="./libs/images/mr robot logo1.png">
                </div>
            </a>-->
        </div>
		<div class="pie-menu-inicial">
    <div class="pie-logo-saint">
        <img src="./libs/images/mr robot logo1.png" alt="imglogon" width="484" height="65" style="width:130px">
        <span class="version-saint">Tecnek Web</span>
    </div>
    
    <input id="tbxFlag" name="FBFlag" type="hidden" value="1">
    <?php include ("./layouts/footer.php");?>


<script>

// document.addEventListener('DOMContentLoaded', function() {
//     var elems = document.querySelectorAll('.fixed-action-btn');
//     var instances = M.FloatingActionButton.init(elems, {
//       direction: 'top',
//       hoverEnabled: false
//     });
//   });

</script>
<!--FIN BOTON DEPLEGABLE-->

</body></html>