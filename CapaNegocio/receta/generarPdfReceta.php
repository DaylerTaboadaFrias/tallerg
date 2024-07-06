<?php 
include_once("../../CapaDato/capaDatoMedicamentoReceta.php");
$capaDatoReceta= new capaDatoMedicamentoReceta();
include 'plantillaReceta.php';
$id=$_POST['id'];

$pdf=new PDF('L');
$cabecera=$capaDatoReceta->getMedicamentoRecetaByIdReceta($id);
$pdf->AddPage();
$pdf->SetFont('Arial','B',15);
$pdf->Cell(120,-8,'Paciente: '.$cabecera[0]['apellido'].' '.$cabecera[0]['nombrep'].'.',0,1,'L');
$pdf->Cell(120,20,'Tratamiento: '.$cabecera[0]['descripcion'],0,1,'L');
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(20);
$pdf->Cell(120,6,'MEDICAMENTO',1,0,'C',1);
$pdf->Cell(120,6,'HORA DE FRECUENCIA',1,1,'C',1);
$resultado=$capaDatoReceta->getMedicamentoRecetaByIdReceta($id);
for ($i=0; $i < count($resultado); $i++) { 
$pdf->SetFont('Arial','I',12);
$pdf->Cell(20);
$pdf->Cell(120,6,$resultado[$i]['nombre'],1,0,'C',1);
$pdf->Cell(120,6,'Tomar cada '.$resultado[$i]['horafrecuencia'].' horas',1,1,'C',1);
}
$pdf->Cell(20);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(160,30,'Recomendacion: '.$cabecera[0]['recomendacion'],0,1,'C');
$pdf->Cell(20);
$pdf->Cell(230,30,'________________________',0,1,'C');
$pdf->Cell(270,-9,'Firma',0,1,'C');
$pdf->Output();
?>