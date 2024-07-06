<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}

include_once("CapaDato/capaDatoEnfermedad.php");
include_once("CapaDato/capaDatoSintoma.php");
include_once("CapaDato/capaDatoEnfermedadSintoma.php");
include_once("CapaDato/capaDatoTrabajo.php");
//echo $_SESSION["user"];
//echo $_SESSION["tipo"];
$_SESSION["si"]=0;
$_SESSION["no"]=0;
$_SESSION["indiceEnfermedad"] = 1;
$_SESSION["antecedente"] = -1;
$_SESSION["elemento"] = -1;
$_SESSION["diagnostico"] = -1;


$arregloDescripcionEnfermedad = Array();
$arregloNombreEnfermedad = Array();
$arregloTrabajoEnfermedad = Array();
$enfermedad = new capaDatoEnfermedad();
$resultado = $enfermedad->getEnfermedades();
$i = 0;		
while ($i < count($resultado)) {

		$arregloDescripcionEnfermedad[$i] = $resultado[$i]['descripcion'];
		$arregloNombreEnfermedad[$i] = $resultado[$i]['nombre'];
		$arregloTrabajoEnfermedad[$i] = $resultado[$i]['idtrabajo'];
		$i++;
}	

$_SESSION["descripcionEnfermedad"] = $arregloDescripcionEnfermedad;
$_SESSION["nombreEnfermedad"] = $arregloNombreEnfermedad;
$_SESSION["trabajoEnfermedad"] = $arregloTrabajoEnfermedad;

$arregloTrabajo = Array();
$arregloPrecio = Array();
$trabajo = new capaDatoTrabajo();
$resultado = $trabajo->getTrabajo();
$i = 0;		
while ($i < count($resultado)) {

		$arregloTrabajo[$i] = $resultado[$i]['nombre'];
		$arregloPrecio[$i] = $resultado[$i]['precio'];
		$i++;
}	
$_SESSION["trabajo"] = $arregloTrabajo;
$_SESSION["precio"] = $arregloPrecio;

$arregloSintomas = Array();
$sintoma = new capaDatoSintoma();
$resultado = $sintoma->getSintomas();
$i = 0;		
while ($i < count($resultado)) {
		$arregloSintomas[$i] = $resultado[$i]['simbolo'];
		$i++;
}	
$_SESSION["VerticeSintoma"] = $arregloSintomas;



$arregloAristasEnfermedades = Array();
$enfermedadSintoma = new capaDatoEnfermedadSintoma();
$resultado = $enfermedadSintoma->getEnfermedadesSintomas();
$i = 0;	
$c = 0;	
$e = 0;

$idEnfermedad = $resultado[0]['idenfermedad'];
$arregloAristasSintomas = Array();

while ($i < count($resultado)) {

	while ($idEnfermedad == $resultado[$i]['idenfermedad']) {
		$arregloAristasSintomas[$c] = $resultado[$i]['idsintoma']; 
		$c++;
		if ($i < (count($resultado)-1) ) {
			$i++;
		}else{
			$idEnfermedad = -1;
		}
	}	

	$arregloAristasEnfermedades[$e] = $arregloAristasSintomas;
	$arregloAristasSintomas = Array();
	$e++;	
	$c= 0;
	if ($idEnfermedad == -1) {
	 	$i = count($resultado);
	}else{
		$idEnfermedad = $resultado[$i]['idenfermedad'];			
	}
	
}
$_SESSION["AristaEnfermedadSintoma"] = $arregloAristasEnfermedades;


// foreach ($_SESSION["AristaEnfermedadSintoma"]  as $valor) {
// 	foreach ($valor  as $v) {
// 		echo $v . '<br>';
// 	}
// 	echo '<br><br><br>' ;
// }
$enfermedadSintomas = new capaDatoEnfermedadSintoma();
$resultado = $enfermedadSintomas->getNombreSintomasByEnfermedadId($_SESSION["indiceEnfermedad"]);
$i = 0;
$arregloNombreSintoma = Array();
$arregloIdSintoma = Array();
$arregloInferencia = Array();
$_SESSION["maximoPregunta"] = count($resultado)-1;


	while ($i < count($resultado)) {
		$arregloNombreSintoma[$i] = $resultado[$i]["nombre"];
		$arregloIdSintoma[$i] = $resultado[$i]["id"];
		$arregloInferencia[$i] = "F";
		$i++;
	}
	$_SESSION["preguntaEnfermedadSintoma"] = $arregloNombreSintoma;
	$_SESSION["preguntaIdSintoma"] = $arregloIdSintoma;
	$_SESSION["inferencia"] = $arregloInferencia;
	//print_r($_SESSION["preguntaEnfermedadSintoma"]);
	//print_r($_SESSION["preguntaIdSintoma"]);
	//print_r($_SESSION["inferencia"]);
	//print_r($_SESSION["VerticeEnfermedad"]);
	//print_r($_SESSION["VerticeSintoma"]);
	//print_r($_SESSION["AristaEnfermedadSintoma"]);
	$_SESSION["indicePregunta"] = 0;
	$_SESSION["verticesInferenciaEnfermedad"]=Array();
?>

<html>
<head>
<meta charset="UTF-8">
<title>Dr.LET</title>
<link rel="stylesheet" href="Public/css/bootstrap.min.css">

<?php
include_once("plantilla.html");
?> 
</head>

<body>
	
<div class="container mt-5 pt-5">
  <div class="mx-auto" style="width:400px;">
  <div class="card" style="width: 27rem;">
    <div class="card-body">
    <form class="form-signin" action="validarlogin.php" method="POST">
        <div class="text-center mb-4">
         
          <img src="Public/Imagen/logo_drlet.jpg" width="250" height="250">
          <p>Diagnostico medico virtual</p>
        </div>

<div class="Cont" id="Cont">
<center>
<center>
<a href="Diagnostico.php" class="btn btn-primary">Iniciar con el diagnostico</a>
</center>
 
</center></div>  
      </form>
    </div>
  </div>
      
   </div>
</div>

<script src="Public/js/jquery-3.3.1.min.js"></script>
<script src="Public/js/bootstrap.min.js"></script>
</body>
</html>
