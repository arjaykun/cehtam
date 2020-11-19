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
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'L');
        session_start();
        $this->SetY(-15);
        $this->Cell(0,10,'Prepared by:' . $_SESSION['auth']->name,0,0,'R');
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

$employee = new Employee;
$emp = $employee->find_by_emp_id($_GET['emp']);

$pdf->Cell(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10, 7, "Employee: ". $emp->name . " (#".$emp->emp_id.")");
$pdf->Ln(5);
$pdf->Cell(15);
$pdf->Cell(30, 7, "Deptartment/ Position: ". $emp->dept_name . "/ " . $emp->job_title );
$pdf->Ln(5);
$pdf->Cell(15);
$pdf->Cell(30, 7, "E-mail: ". $emp->email);
$pdf->Ln(5);
$pdf->Cell(15);
$pdf->Cell(30, 7, "Contact #: ". $emp->contact_num);
//table
$pdf->Ln(10);
$pdf->Cell(15);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10, 7, "#", 1, 0, 'C');
$pdf->Cell(30, 7, "Date(m/d/y)", 1, 0, 'C');
$pdf->Cell(30, 7, "Time-in", 1, 0, 'C');
$pdf->Cell(30, 7, "Time-out", 1, 0, 'C');
$pdf->Cell(30, 7, "Regular hrs.", 1, 0, 'C');
$pdf->Cell(30, 7, "Overtime", 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','',9);

//table data
$log = new TimeLog;

if (isset($_GET['to']) && isset($_GET['from'])) {
    $logs = $log->get_by_emp($_GET['emp'], 0, $_GET['from'], $_GET['to']);
} else {
    $logs = $log->get_by_emp($_GET['emp'], 0);
}

$total_regular= 0;
$total_ot= 0;
foreach ($logs as $key => $l) {
    $time = $log->get_hours_work($l->time_work, $l->time_in, $l->time_out);
    $pdf->Cell(15);
    $pdf->Cell(10, 7, $key + 1, 1, 0, 'C');
    $pdf->Cell(30, 7, Date("m/d/Y", strtotime($l->time_in)), 1, 0);
    $pdf->Cell(30, 7, Date("H:i:s a", strtotime($l->time_in)), 1, 0);
    $pdf->Cell(30, 7, Date("H:i:s a", strtotime($l->time_out)), 1, 0);
    $pdf->Cell(30, 7, $time['regular'], 1, 0);
    $pdf->Cell(30, 7,  $time['overtime'], 1, 0);
    $pdf->Ln();

    $total_regular += $time['regular'];
    $total_ot += $time['overtime'];
}
$pdf->Cell(15);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70);
$pdf->Cell(30, 12,"Total Hours:" );
$pdf->Cell(30, 12, $total_regular . " hrs.");
$pdf->Cell(30, 12,  $total_ot. " hrs.");

$pdf->Ln(30);
$pdf->Cell(15);
$pdf->SetFont('Arial','B',12);
$pdf->Output();

?>