<?php
include_once("../../CapaDato/capaDatoTratamiento.php");
$buscar = $_POST['b'];
buscar($buscar);
    function buscar($b) {
      $objectoCapaDato=new capaDatoTratamiento();
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
                $fecha=($sql[$i]['fecha']);
                $montototal=($sql[$i]['montototal']);
                $montopagado=round($sql[$i]['montopagado'],1);
                $montoacobrar=round($sql[$i]['montoacobrar'],1);
                $descripcion=($sql[$i]['descripcion']);
                $estado=($sql[$i]['estado']);
                $apellido=($sql[$i]['apellido']);
                $nombre=($sql[$i]['nombre']);
                echo "<tr><td style='display:none;' class='align-middle'>".$id."</td><td >".$fecha."</td><td >".$montototal."</td><td >".$montopagado."</td><td >".$montoacobrar."</td><td >".$descripcion."</td><td >".$estado."</td><td >".$apellido.' '.$nombre."</td><td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal".$id."'>Mostrar detalle</button></td></tr>";
            }
        }
    }
        
?>