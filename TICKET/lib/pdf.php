<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';

$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT * FROM ticket WHERE id= '$id'");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

class PDF extends FPDF
{
}

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0,0,128);
$pdf->SetFillColor(0,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont("Arial","b",9);
$pdf->Image('../img/logo.png',40,10,-300);
$pdf->Cell (0,5,iconv("UTF-8", "ISO-8859-1",'LinuxStore El Salvador'),0,1,'C');
$pdf->Cell (0,5,iconv("UTF-8", "ISO-8859-1",'Reporte de problema mediante Ticket'),0,1,'C');

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell (0,5,iconv("UTF-8", "ISO-8859-1",'Información de Ticket #'.iconv("UTF-8", "ISO-8859-1",$reg['serie'])),0,1,'C');

$pdf->Cell (35,10,'Fecha',1,0,'C',true);
$pdf->Cell (0,10,iconv("UTF-8", "ISO-8859-1",$reg['fecha']),1,1,'L');
$pdf->Cell (35,10,'Serie',1,0,'C',true);
$pdf->Cell (0,10,iconv("UTF-8", "ISO-8859-1",$reg['serie']),1,1,'L');
$pdf->Cell (35,10,'Estado',1,0,'C',true);
$pdf->Cell (0,10,iconv("UTF-8", "ISO-8859-1",$reg['estado_ticket']),1,1,'L');
$pdf->Cell (35,10,'Nombre',1,0,'C',true);
$pdf->Cell (0,10,iconv("UTF-8", "ISO-8859-1",$reg['nombre_usuario']),1,1,'L');
$pdf->Cell (35,10,'Email',1,0,'C',true);
$pdf->Cell (0,10,iconv("UTF-8", "ISO-8859-1",$reg['email_cliente']),1,1,'L');
$pdf->Cell (35,10,'Departamento',1,0,'C',true);
$pdf->Cell (0,10,iconv("UTF-8", "ISO-8859-1",$reg['departamento']),1,1,'L');
$pdf->Cell (35,10,'Asunto',1,0,'C',true);
$pdf->Cell (0,10,iconv("UTF-8", "ISO-8859-1",$reg['asunto']),1,1,'L');
$pdf->Cell (35,15,'Problema',1,0,'C',true);
$pdf->Cell (0,15,iconv("UTF-8", "ISO-8859-1",$reg['mensaje']),1,1,'L');
$pdf->Cell (35,15,'Solucion',1,0,'C',true);
$pdf->Cell (0,15,iconv("UTF-8", "ISO-8859-1",$reg['solucion']),1,1,'L');

$pdf->Ln();

$pdf->cell(0,5,"LinuxStore 2018",0,0,'C');

$pdf->output();