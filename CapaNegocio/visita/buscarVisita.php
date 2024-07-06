<?php
include_once("../../CapaDato/capaDatoVisita.php");
$buscar = $_POST['b'];
buscar($buscar);
    function buscar($b) {
      $objectoCapaDato=new capaDatoVisita();
      $sql= $objectoCapaDato->buscar($b); 
      $columnas = count($sql);

      if($columnas == 0){
      echo "No se han encontrado resultados para '<b>".$b."</b>'.";
      }else{
        if ($b=='') {
            $sql=$objectoCapaDato->mostrar(); 
            $columnas = count($sql);

        }
            for ($i = $columnas-1; $i >=0 ; $i--) {
              $id=($sql[$i]['id']);
              $descripcion=($sql[$i]['descripcion']);
              $pagoadelanto=($sql[$i]['pagoadelanto']);
              $montototal=round($sql[$i]['montototal'],1);
              $montopagado=round($sql[$i]['montopagado'],1);
              $montoacobrar=round($sql[$i]['montoacobrar'],1);
              $tratamiento=($sql[$i]['tratamiento']);
         
              echo "<tr><td style='display:none;' class='align-middle'>".$id."</td><td >".$descripcion."</td><td >".$pagoadelanto."</td><td >".$montototal."</td><td >".$montopagado."</td><td >".$montoacobrar."</td><td >".$tratamiento."</td></tr>";
          }
      }
    }
        
?>