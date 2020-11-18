<?php
//include connection file 
include_once '../loadclasses.php';
include_once '../fpdf/fpdf.php';
 
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../../assets/images/bg/scan.jpg',10,10,20);
        $this->SetFont('Arial','B',9);

        $this->Cell(20);
        $this->Cell(10, 5, "Company Employee Handsfree");
        $this->Cell(130);
        $this->Cell(0, 5, Date('M d, Y'));
        $this->Ln(5);
        $this->Cell(20);
        $this->Cell(10, 5, "Tracing and Monitoring");
        // Move to the right
        // $this->Cell(80);
        // // Title
        // $this->SetFont('Arial','B',13);
        // $this->Cell(80,10,'Employee List',1,0,'C');
        // // Line break
        $this->Ln(20);

    }
     
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
 
       
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',15);

if (isset($_GET['to']) && isset($_GET['from'])) {
    $subtitle = " ( From=". $_GET['from'] ." | To=". $_GET['to'] ." ) ";
} else {
    $subtitle = " ( ALL RECORDS ) "; 
}
//SUBTITLE
$pdf->Cell(0, 0, "Time Log", 0, 0, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',11);

$pdf->Cell(0, 0, $subtitle, 0, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(5);
//table
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10, 7, "#", 1, 0, 'C');
$pdf->Cell(50, 7, "Employee", 1, 0, 'C');
$pdf->Cell(30, 7, "Date(m/d/y)", 1, 0, 'C');
$pdf->Cell(30, 7, "Time-in", 1, 0, 'C');
$pdf->Cell(30, 7, "Time-out", 1, 0, 'C');
$pdf->Cell(20, 7, "Hrs. Work", 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','',9);

//table data
$log = new TimeLog;
if (isset($_GET['to']) && isset($_GET['from'])) {
    $logs = $log->get($_GET['from'], $_GET['to']);
} else {
    $logs = $log->get();
}


foreach ($logs as $key => $l) {
    $pdf->Cell(5);
    $pdf->Cell(10, 7, $key + 1, 1, 0, 'C');
    $pdf->Cell(50, 7, $l->name, 1, 0);
    $pdf->Cell(30, 7, Date("m/d/Y", strtotime($l->time_in)), 1, 0);
    $pdf->Cell(30, 7, Date("H:i:s a", strtotime($l->time_in)), 1, 0);
    $pdf->Cell(30, 7, Date("H:i:s a", strtotime($l->time_out)), 1, 0);
    $pdf->Cell(20, 7, $log->get_hours_work($l->time_work, $l->time_in, $l->time_out), 1, 0);
    $pdf->Ln();
}

$pdf->Output();

?>