<?php
include_once("../../CapaDato/capaDatoMedicamento.php");
$buscar = $_POST['b'];
buscar($buscar);
    function buscar($b) {
      $objectoCapaDato=new capaDatoMedicamento();
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
                $nombre=($sql[$i]['nombre']);
                $marca=($sql[$i]['marca']);
                $medida=($sql[$i]['medida']);
                $imagen=($sql[$i]['imagen']);
                $tipo=($sql[$i]['tipo']);
                echo "<tr><td style='display:none;' class='align-middle'>".$id."</td><td >".$nombre."</td><td >".$marca."</td><td >".$medida."</td><td ><img src=".$imagen." width='100' height='100'></td><td >".$tipo."</td></tr>";
            }
        }
    }
        
?>