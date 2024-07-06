<?php 
include_once("../../CapaDato/capaDatoTratamiento.php");
include_once("../../CapaDato/capaDatoTrabajoTratamiento.php");
include_once("capaNegocioFactura.php");
include 'plantillaFactura.php';
$capaDatoTratamiento= new capaDatoTratamiento();
$capaDatoTrabajoTratamiento= new capaDatoTrabajoTratamiento();
$capaNegocioFactura= new capaNegocioFactura();

$id=$_POST['id'];

$pdf=new PDF('L');
$cabecera=$capaDatoTratamiento->getTratamientoById($id);
$capaNegocioFactura->insertar($cabecera[0]['nit'],$id);
$pdf->AddPage();
$pdf->SetFont('Arial','B',15);
$pdf->Cell(120,-8,'Paciente: '.$cabecera[0]['apellido'].' '.$cabecera[0]['nombre'].'.',0,1,'L');
$pdf->Cell(120,20,'Tratamiento: '.$cabecera[0]['descripcion'],0,1,'L');
$pdf->Cell(120,-8,'Nit: '.$cabecera[0]['nit'],0,1,'L');
$pdf->Ln(35);
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(20);
$pdf->Cell(100,6,'TRABAJO',1,0,'C',1);
$pdf->Cell(45,6,'PRECIO',1,0,'C',1);
$pdf->Cell(45,6,'CANTIDAD',1,0,'C',1);
$pdf->Cell(45,6,'SUBTOTAL',1,1,'C',1);
$resultado=$capaDatoTrabajoTratamiento->getTrabajoTratamientoByIdTratamiento($id);
for ($i=0; $i < count($resultado); $i++) { 
$pdf->SetFont('Arial','I',12);
$pdf->Cell(20);
$pdf->Cell(100,6,$resultado[$i]['trabajo'],1,0,'C',1);
$pdf->Cell(45,6,$resultado[$i]['precio'],1,0,'C',1);
$pdf->Cell(45,6,$resultado[$i]['cantidad'],1,0,'C',1);
$pdf->Cell(45,6,$resultado[$i]['subtotal'],1,1,'C',1);

}
$pdf->SetX(220);
$pdf->Cell(45,6,'Total: '.$cabecera[0]['montototal'],1,1,'C',1);

$pdf->Output();
?>