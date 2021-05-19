<?php 
    $page_title="Caja Actual";
    require_once('includes/load.php');
    page_require_level(1);

    $fecha_hoy=date('Y-m-d');
    $montos = cajaActual();
?>
<html>
<head>
	<?php include('layouts/header.php');?>
</head>
<header>
	<?php include('layouts/nav.php')?>
</header>
<body>
<div  class="panel container-fluid" style="padding-top: 60px">
    <div class="col-md-12">
        <div class="table-responsive">        
            <table class="table table-striped table-bordered" style="width:100%" id="example">
                <thead>
                    <tr class="warning">
                        <th class="text-center" style="width: 10px;">#</th>
                        <th class="text-center" style="width: 40%"> Descripción equipo </th>
                        <th class="text-center" style="width: 20%;"> Cliente </th>
                        <th class="text-center" style="width: 10%;"> Status </th>
                        <th class="text-center" style="width: 10%;"> Pagado </th>
                        <th class="text-center" style="width: 20%;"> Fecha y Hora</th>
                        <th class="text-center" style="width: 20%;"> Técnico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="select u.name,c.nombre_cliente,p.id_correlativo_registro,r.descrip,r.falla,r.status,p.pagado,p.fecha_pago from registro as r INNER JOIN pagos_registro as p ON r.correlativo=p.id_correlativo_registro INNER JOIN users as u ON p.id_vendedor=u.id INNER JOIN cliente as c ON r.id_cliente_registro=c.id_cliente where p.fecha_pago like'$fecha_hoy%' ORDER BY p.id_correlativo_registro";
                        if ($query=$db->query($sql) ){
                            while ($row=$db->fetch_array($query)){
                                $correlativo=$row['id_correlativo_registro'];
                                $descrip=$row['descrip'];
                                $status=$row['status'];
                                $fecha=$row['fecha_pago'];
                                $pagado=$row['pagado'];
                                $nombre_cliente=$row['nombre_cliente'];
                                $nombre_tecnico=$row['name'];
                                
                                switch ($status) {
                                    case 1 :
                                        $status_value="EN REPARACION O MANTENIMIENTO";
                                        break;
                                    case 2:
                                        $status_value="Listo para entregar";
                                        break;
                                    case 3 :
                                        $status_value="Entregado";
                                        break;
                                    
                                    default:
                                        $status_value="";
                                        break;
                                }
    
                    ?>
                    <tr>
                        <td class="text-center"><?php echo count_id();?></td>
                        <td class="text-center"> <?php echo remove_junk($descrip); ?></td>
                        <td class="text-center"> <?php echo remove_junk($nombre_cliente); ?></td>
                        <td class="text-center"> <?php echo remove_junk($status_value); ?></td>
                        <td class="text-center"> <?php echo remove_junk($pagado); ?></td>
                        <td class="text-center"> <?php echo remove_junk($fecha); ?></td>
                        <td class="text-center"> <?php echo remove_junk($nombre_tecnico); ?></td>

                    </tr>
                    <?php
                            }
                        }
                    ?>
            
                </tbody>        
            </table>                  
        </div>
    </div>
	<?php include_once('layouts/footer.php'); ?>

</body>
</html>
