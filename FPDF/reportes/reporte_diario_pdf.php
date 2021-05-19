<?php
require('../../includes/load.php');
require('../fpdf.php');
page_require_level(3);

$fecha_hoy=date('Y-m-d');
//suma de pagos de guias



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
		$this->cell(276,10,'Detalle de reporte',0,0,'C');
		$this->Ln(30);


	}

	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Pagina '.$this->PageNo(). '/{nb}',0,0,'C');

	}

	function headerTableGuias (){
		$db=new MySqli_DB();
 $fecha_hoy=date('Y-m-d');
		$sql="SELECT * FROM pagos_registro where fecha_pago like '$fecha_hoy%'";
$data=$db->query($sql);
$suma=0;
foreach($data as $datos){
	$suma += (double)$datos['pagado'];
}
  $this->SetFillColor(141,230,80);
    $this->SetTextColor(0);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.3);
    	$this->SetFont('Times','B',12);
    	$this->MultiCell(80,10,'REPORTE DE GUIAS DEL '.$fecha_hoy);
    	$this->MultiCell(80,10,'Total : S/. '.$suma);
    	
    	$this->cell(20,10,'Nro',1,0,'C',true);
    	
    	$this->cell(40,10,'Cliente',1,0,'C',true);
    	$this->cell(40,10,'Status',1,0,'C',true);
    	$this->cell(40,10,'Pagado',1,0,'C',true);
    	$this->cell(40,10,'Fecha y Hora',1,0,'C',true);
    	$this->cell(40,10,'Tecnico',1,0,'C',true);
    	$this->cell(60,10,'Descripcion',1,0,'C',true);
    	$this->Ln();
	}
	function viewTableGuias(){
		 $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
		
		$db=new MySqli_DB();

		$fecha_hoy=date('Y-m-d');
		$this->SetFont('Times','',12);

		$sql="select u.name,c.nombre_cliente,p.id_correlativo_registro,r.descrip,r.falla,r.status,p.pagado,p.fecha_pago from registro as r INNER JOIN pagos_registro as p ON r.correlativo=p.id_correlativo_registro INNER JOIN users as u ON p.id_vendedor=u.id INNER JOIN cliente as c ON r.id_cliente_registro=c.id_cliente where p.fecha_pago like'$fecha_hoy%' ORDER BY p.id_correlativo_registro";

                           if ($query=$db->query($sql) ){
				while ($row=$db->fetch_array($query)){
					$correlativo=$row['id_correlativo_registro'];
					$descrip=$row['descrip'];
					$descrip=str_replace('<br>', '
						', $descrip);
					$descrip=str_replace('
						*MARCA', '						*MARCA', $descrip);
					$status=$row['status'];
					$fecha=$row['fecha_pago'];
					$pagado=$row['pagado'];
					$nombre_cliente=$row['nombre_cliente'];
					$nombre_tecnico=$row['name'];
					
					switch ($status) {
						case 1 :
							$status_value="En reparacion";
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
					//traer datos

					$this->Cell(20,35,$correlativo,1,0,'C');
					//$this->Cell(40,10,"a",1,0,'C');
    	
    	$this->Cell(40,35,$nombre_cliente,1,0,'C');
    	$this->cell(40,35,$status_value,1,0,'C');
    	$this->cell(40,35,'S/. '.$pagado,1,0,'C');
    	$this->cell(40,35,$fecha,1,0,'C');
    	$this->cell(40,35,$nombre_tecnico,1,0,'C');
    	$this->MultiCell(60,5,$descrip,1,'L');
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