<?php
require('../fpdf.php');
require_once('../mcneese/connect.php');
session_start();

$company = $_SESSION["company"];
$name = $_SESSION["name"];
$eid = $_SESSION["eid"];
$event = $_SESSION["eName"];
$location = $_SESSION["location"];
$id = $_SESSION["uid"];

if(is_null($id)){
    echo "This link is no longer valid.";
} else {
    $sql = "UPDATE McNeeseEvents SET Attending = Attending+'1' WHERE ID = '$eid'";
    if ($conn->query($sql) === TRUE) {
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
                $this->SetFont('Arial','I',14);
                // Page number
                $this->Cell(0,10,''. $_SESSION["uid"].' - Printed on '. date("m/d/Y"). ' - Valid through '. $_SESSION["date"]. '',0,0,'C');
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
        $pdf->SetFont('Times','',36);
        $pdf->Cell(0, 20, $event, 0, 1, 'C');
        $pdf->SetFont('Times','',28);
        $pdf->Cell(0, 15, $location, 0, 1, 'C');
        $pdf->Cell(0, 15, ''. $_SESSION["date"]. ' at '. $_SESSION["time"]. '', 0, 1, 'C');
        $pdf->Output();

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}
session_destroy();

$conn->close();

?>
