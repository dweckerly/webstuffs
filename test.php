<?php
require('fpdf.php');

$company = $_GET["company"];
$name = $_GET["name"];

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
    $this->Image('logo.png', 48, 12, 200);
	// Line break
    $this->Ln(56);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Printed on '. date("m/d/Y"). ' - Valid through (Add reference to event time here)',0,0,'C');
}
}

// Instantiation of inherited class
$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',36);
$pdf->Cell(0, 20, 'McNeese Event Parking', 0, 1, 'C');
$pdf->SetFont('Times','',48);
$pdf->Cell(0, 20, $company, 0, 1, 'C');
$pdf->Cell(0, 20, $name, 0, 1, 'C');
$pdf->Output();
?>
