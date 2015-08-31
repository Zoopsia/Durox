<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('libraries/fpdf/fpdf.php');

class PDF extends FPDF {
	// Cabecera de página
	
	function Header()
	{
	    // Logo
	    //$this->Image('logo_pb.png',10,8,33);
	    // Arial bold 15
	    $this->SetFont('Arial','BU',13);
	    // Movernos a la derecha
	    $this->Cell(80);
	    // Título
	    $this->Cell(30,10,'Lista de Precios',0,0,'C');
	    // Salto de línea
	    $this->Ln(10);
	}
	
	// Pie de página
	function Footer()
	{
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	function ListaPreciosTable($header, $data)
	{
		$this->SetTitle('Lista de Precios');
		$this->SetX(15);
	    // Colores, ancho de línea y fuente en negrita
	    $this->SetFillColor(87,87,87);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(0,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
		// Ancho columnas
		$w = array(150, 30);		
	    // Cabecera
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	    $this->Ln();
	    // Restauración de colores y fuentes
	    $this->SetFillColor(245,245,245);
	    $this->SetTextColor(0);
	    $this->SetFont('', '', 10);
	    // Datos
	    $fill = false;
		
	    foreach($data as $row)
	    {
	    	$this->SetX(15);
	        $this->Cell($w[0],6,$row->nombre,'LR',0,'C',$fill);
			$this->Cell($w[1],6,'$ '.$row->precio,'LR',0,'R',$fill);
			
	        $this->Ln();
	        $fill = !$fill;
	    }
	    // Línea de cierre
	    $this->SetX(15);
	    $this->Cell(array_sum($w),0,'','T');
	}
}
?>