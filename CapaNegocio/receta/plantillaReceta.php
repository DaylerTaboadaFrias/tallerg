<?php
require('../../fpdf/fpdf.php');

    class PDF extends FPDF{
        function Header(){
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
      
            $this->Image('../../Public/Imagen/logotipo.png',5,5,80);
            $this->SetFont('Arial','B',22);
            $this->Cell(80);
            $this->Cell(130,35,'RECETA',0,1,'C');
            $this->SetFont('Arial','B',15);
            $this->Cell(95,-9,'Fecha: '.date("%A %d de %B del %Y").'.',0,1,'L');
            $this->Ln(15);
        }

    }
?>