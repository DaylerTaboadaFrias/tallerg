<?php
include_once("../../CapaDato/capaDatoUsuario.php");
$buscar = $_POST['b'];
buscar($buscar);
    function buscar($b) {
      $objectoCapaDato=new capaDatoUsuario();
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
              $apellido=($sql[$i]['apellido']);
              $cedula=($sql[$i]['cedula']);
              $correo=($sql[$i]['correo']);
              $nit=($sql[$i]['nit']);
              $sexo=($sql[$i]['sexo']);
              $telefono=($sql[$i]['telefono']);
              $tipo=($sql[$i]['tipo']);
              echo "<tr><td style='display:none;' class='align-middle'>".$id."</td><td >".$nombre."</td><td >".$apellido."</td><td >".$cedula."</td><td >". $correo."</td><td >". $nit."</td><td >".$sexo."</td><td >". $telefono."</td><td >".$tipo."</td></tr>";
          }
      }
    }
        
?>