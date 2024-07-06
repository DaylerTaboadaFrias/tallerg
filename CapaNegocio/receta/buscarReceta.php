<?php
include_once("../../CapaDato/capaDatoReceta.php");
$buscar = $_POST['b'];
buscar($buscar);
    function buscar($b) {
      $objectoCapaDato=new capaDatoReceta();
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
                $recomendacion=($sql[$i]['recomendacion']);
                $fecha=($sql[$i]['fecha']);
                $tratamiento=($sql[$i]['tratamiento']);
                $apellido=($sql[$i]['apellido']);
                $nombre=($sql[$i]['nombre']);
                echo "<tr><td style='display:none;' class='align-middle'>".$id."</td><td >".$recomendacion."</td><td >".$fecha."</td><td >".$tratamiento."</td><td >".$apellido.' '.$nombre."</td><td><button type='button' class='btn btn-primary' data-toggle='modal' data-target=#exampleModal".$id.">Mostrar Detalle</button><button type='button' class='btn btn-info'>Imprimir</button></td></tr>";
            }
        }
    }
        
?>