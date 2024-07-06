<?php
include_once("../../CapaDato/capaDatoCategoria.php");
$buscar = $_POST['b'];
buscar($buscar);
    function buscar($b) {
      $objectoCapaDato=new capaDatoCategoria();
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
              $descripcion=($sql[$i]['descripcion']);
         
              echo "<tr><td style='display:none;' class='align-middle'>".$id."</td><td >".$nombre."</td><td >".$descripcion."</td></tr>";
          }
      }
    }
        
?>