<?php
require('../../includes/load.php');
require('../fpdf.php');
page_require_level(3);


$fecha_hoy=date('Y-m-d');
class myPDF extends FPDF{

	public $db;
	public $suma;
	public $ruta_logo;
	

	function header(){
		$ruta_logo=$_SESSION['ruta_imagen'];
		if(trim($ruta_logo)){
			$this->Image('../../uploads/empresa/'.$ruta_logo,10,10,50,30);
		}
		$this->SetFont('Arial','B',14);
		$this->Cell(276,5,'REPORTE DIARIO GENERAL',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->cell(276,10,'Detalle de reporte de ventas',0,0,'C');
		$this->Ln(30);


	}

	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Pagina '.$this->PageNo(). '/{nb}',0,0,'C');

	}

	function headerTableGuias (){
		$db = new MySqli_DB ();
		$fecha_hoy=date('Y-m-d');
//suma de pagos de ventas
$sql="SELECT * FROM sales where date like '$fecha_hoy%'";
$data=$db->query($sql);
$suma_venta=0;
foreach ($data as $ventas) {
	$suma_venta += (double)$ventas['price'];
}
 	
  $this->SetFillColor(141,230,80);
    $this->SetTextColor(0);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.3);
    	$this->SetFont('Times','B',12);
    	$this->MultiCell(80,10,'REPORTE DE VENTAS DEL '.$fecha_hoy);
    	$this->MultiCell(80,10,'Total: S/. '.$suma_venta);
    	
    	$this->cell(20,10,'Nro',1,0,'C',true);
    	
    	$this->cell(40,10,'Fecha',1,0,'C',true);
    	$this->cell(60,10,'Total',1,0,'C',true);
    	$this->cell(50,10,'Vendedor',1,0,'C',true);
    	$this->cell(40,10,'Estado',1,0,'C',true);
    	$this->cell(60,10,'Productos',1,0,'C',true);
    	
    	$this->Ln();
	}
	function viewTableGuias(){
		 $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
		
		$db=new MySqli_DB();

		$fecha_hoy=date('Y-m-d');
		$this->SetFont('Times','',12);

		$sql="SELECT f.id_factura,f.numero_factura,f.fecha_factura,f.id_vendedor,f.estado_factura,f.total_venta,p.id_sucursal FROM  facturas as f LEFT JOIN users as u ON u.id=f.id_vendedor LEFT JOIN detalle_factura as d ON d.numero_factura=f.numero_factura LEFT JOIN products as p ON p.id=d.id_producto INNER JOIN sales as s ON s.numero_factura=f.numero_factura and p.id_sucursal=s.id_sucursal  WHERE s.date like '$fecha_hoy%' GROUP BY f.id_factura,s.id_sucursal order by f.id_factura desc";

                           if ($query=$db->query($sql) ){
				while ($row=$db->fetch_array($query)){
				$id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y G:i:s", strtotime($row['fecha_factura']));
						$id_vendedor=$row['id_vendedor'];
					    $nombre_vendedor_sql=$db->query("select name from users where id='$id_vendedor'");
					    $nombre_vende=$db->fetch_array($nombre_vendedor_sql);
					    $nombre_vendedor=$nombre_vende['name'];
						$estado_factura=$row['estado_factura'];
						if ($estado_factura==1){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_venta=$row['total_venta'];
						
						$sql="select pro.name as nombre_prod from detalle_factura as det INNER JOIN products as pro ON pro.id=det.id_producto where numero_factura=$numero_factura GROUP BY pro.name";
						$queryy=$db->query($sql);
						$productos="";
						$contador=0;
						while($datos=$db->fetch_array($queryy)){
							//$contador++;
							$productos=$productos.$datos['nombre_prod']."<br>";
							$productos=str_replace('<br>'," ",$productos);
							
						}
						$cantidad_fila=28;
						$cantidad=strlen($productos);
						$contador=$cantidad/$cantidad_fila;
						$contador=(int)$contador;
						/*if($contador%2!==0){
						$contador++;	
						}*/
						$altura=9*$contador;
					


					$this->Cell(20,$altura,$numero_factura,1,0,'C');
					//$this->Cell(40,10,"a",1,0,'C');
    	
    	//$this->Cell(10,35,$numero_factura,1,0,'C');
    	$this->cell(40,$altura,$fecha,1,0,'C');
    	$this->cell(60,$altura,'S/. '.$total_venta,1,0,'C');
    	$this->cell(50,$altura,$nombre_vendedor,1,0,'C');
    	$this->cell(40,$altura,$text_estado,1,0,'C');
    	$this->MultiCell(60,9,$productos,1,'L');
    
    	
    	
    	
    	//$this->Ln();

					 }
        }



	//fin funcion
	}

}
$pdf= new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTableGuias();
$pdf->viewTableGuias();


$pdf->output();

 ?>