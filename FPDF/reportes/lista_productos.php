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
		$this->Cell(276,5,'REPORTE INVENTARIO GENERAL',0,0,'C');
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
		global $fecha_hoy;
		

		$this->SetFillColor(195, 255, 248);
		$this->SetTextColor(0);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.3);
    	$this->SetFont('Times','B',12);
    	$this->MultiCell(80,10,'Fecha: '.$fecha_hoy);
    	//$this->MultiCell(80,10,'Valor actual de inventario: S/. '.$suma);
    	
    	// $this->cell(10,10,'Nro',1,0,'C',true);
    	// $this->cell(90,10,'Descripcion',1,0,'C',true);
    	// $this->cell(60,10,'Categoria',1,0,'C',true);
    	// $this->cell(20,10,'Stock',1,0,'C',true);
    	// $this->cell(25,10,'Costo',1,0,'C',true);
    	// $this->cell(25,10,'Precio',1,0,'C',true);
    	// $this->cell(50,10,'Fecha Agregado',1,0,'C',true);
    	$this->Ln();
	}
	function viewTableGuias(){

		$listaAgrupada = listaProductosVigentes();
		// $this->SetFillColor(224,235,255);
		// $this->SetTextColor(0);
		// $this->SetFont('');
        $conteo = 0;
        
		foreach($listaAgrupada as $row){
            $x=$this->GetX();
            $y=$this->GetY();
            $conteo++;
            $push_right = 0;
            
            $this->SetFillColor(195, 255, 248);
            $this->SetTextColor(0);
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(.3);
            $this->SetFont('Times','B',12);

            $this->cell(90,10,$row['name'],1,1,'C',true);
            
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            foreach ($row['productos'] as $key => $value) {
                $conteo++;
                
                $this->Cell(90,10,$value,1,1,'C');
            }
               
            
			// $id_producto=$row['id'];
			// $fecha_agregado=$row['date'];
			// $codigo_producto=$row['codigo_producto'];
			// $nombre_producto=$row['nombre_prod'];
			// $costo=$row['buy_price'];
			// $precio_venta=$row["sale_price"];
			// $imagen_id=$row['media_id'];
			// $imagen=$row['file_name'];
			// $id_categoria=$row['categorie_id'];
			// $id_sucursal=$row['id_sucursal'];
			// $categoria=$row['nombre_suc'];
			// $sucursal=$row['nombre_sucursal'];
			// $precio_venta=number_format($precio_venta,2);
			// $stock=$row["quantity"];

			// $this->Cell(90,10,$nombre_producto,1,0,'C');
			// $this->cell(60,10,$categoria,1,0,'C');
			// $this->cell(20,10,$stock,1,0,'C');
			// $this->cell(25,10,$costo,1,0,'C');
			// $this->cell(25,10,$precio_venta,1,0,'C');
			// $this->cell(50,10,$fecha_agregado,1,1,'C');
		}
	}

}
$pdf= new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTableGuias();
$pdf->viewTableGuias();
$pdf->output();

 ?>