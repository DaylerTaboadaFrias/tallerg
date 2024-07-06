<?php 
session_start();
include_once("CapaDato/conexion.php");
include_once("CapaDato/Kairos.php");
$foto = $_POST['foto'];

$kairos = new Kairos();
$argumentArray =  array(
    "image" =>  $foto,
    "gallery_name" => "profile"
); 
$response = json_decode($kairos->recognize($argumentArray));
        $images=$response->{'images'}[0];
        if (array_key_exists('candidates', $images)){
            $images = $images->{'candidates'};
            
            foreach ($images as $img) {
                $respuesta[] = $img->{'subject_id'};
                
            } 

       }else{
            $respuesta[] = -1;

       }

json_encode($respuesta);


if ($respuesta[0] == -1) {
	header("location:login.php");
}else{
$nombrecompleto = $respuesta[0];	
$porciones = explode(" ", $nombrecompleto);
json_encode($porciones);

$nombre= $porciones[0];
$apellido= $porciones[1]." ".$porciones[2];

$conexion = new conexion();
$conexion->conectar();
$consulta=$conexion->ejecutar("select * from usuario where nombre='$nombre' and apellido='$apellido'");
$conexion->desconectar();
$_SESSION['user']=$consulta[0]["id"];
$_SESSION['tipo']=$consulta[0]["tipo"];
header("location:bienvenido.php");
}




?>
