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
//SUBTITLE
$pdf->Cell(0, 0, "Employee List", 0, 0, 'C');
$pdf->Ln(10);
//table
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30, 7, "ID", 1, 0, 'C');
$pdf->Cell(60, 7, "Name", 1, 0, 'C');
$pdf->Cell(40, 7, "Contact #", 1, 0, 'C');
$pdf->Cell(50, 7, "Position", 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','',10);

//table data
$employee = new Employee;
foreach ($employee->get() as $emp) {
    $pdf->Cell(30, 7, $emp->emp_id, 1, 0);
    $pdf->Cell(60, 7, $emp->name, 1, 0);
    $pdf->Cell(40, 7, $emp->contact_num, 1, 0);
    $pdf->Cell(50, 7, $emp->job_title, 1, 0);
    $pdf->Ln();
}

$pdf->Output();

?>