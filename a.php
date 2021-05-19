<?php 
$cantidad="5F3";
$restar="4F2";
$unidades_por_caja=10;


list($a,$b)= explode('F', $cantidad);
list($c,$d) = explode ('F',$restar);

$total_a = ($a*10)+$b;
$total_b = ($c*10)+$d;

$numerico=$total_a-$total_b;
$cajas=(int)($numerico/$unidades_por_caja);
$unidades=$numerico%$unidades_por_caja;

$resultado=$cajas."F".$unidades;
echo $resultado;
?>