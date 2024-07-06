<?php
include_once("../../CapaDato/capaDatoTrabajo.php");
$buscar = $_POST['b'];
buscar($buscar);
    function buscar($b) {
      $objectoCapaDato=new capaDatoTrabajo();
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
              $precio=($sql[$i]['precio']);
              $categoria=($sql[$i]['categoria']);
              $imagen=($sql[$i]['imagen']);
         
              echo "<tr><td style='display:none;' class='align-middle'>".$id."</td><td >".$nombre."</td><td >".$precio."</td><td >".$categoria."</td><td ><img src=".$imagen." width='400' height='200'></td></tr>";
          }
      }
    }
        
?>