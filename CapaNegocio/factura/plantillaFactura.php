<?php
require('../../fpdf/fpdf.php');

    class PDF extends FPDF{
        function Header(){
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
      
            $this->Image('../../Public/Imagen/logo_drlet.jpg',5,5,80);
            $this->SetFont('Arial','B',22);
            $this->Cell(80);
            $this->Cell(130,35,'FACTURA',0,1,'C');
            $this->SetFont('Arial','B',15);
            $this->Ln(15);
        }

    }
?>