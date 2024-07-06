<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
  header("location: /centraldent/index.php");
}
include_once("CapaDato/capaDatoEnfermedadSintoma.php");
include_once("CapaDato/capaDatoEnfermedad.php");
include_once("CapaDato/capaDatoSintoma.php");
include_once("CapaDato/capaDatoTrabajo.php");

if(isset($_POST['si'])){
$_SESSION["inferencia"][$_SESSION["indicePregunta"]] = "V";

siguientePregunta();
$datos = new stdClass();
$datos->inferencia = $_SESSION["inferencia"];
$datos->indicePregunta = $_SESSION["indicePregunta"];
$datos->indiceEnfermedad = $_SESSION["indiceEnfermedad"];
$datos->preguntaEnfermedadSintoma = $_SESSION["preguntaEnfermedadSintoma"];
//$datos->verticesInferenciaEnfermedad = $_SESSION["verticesInferenciaEnfermedad"];
//$datos->antecedente = $_SESSION["antecedente"];
$datos->diagnostico = $_SESSION["diagnostico"];
$datos->trabajo =$_SESSION["trabajo"];
$datos->precio =$_SESSION["precio"];
$datos->trabajoEnfermedad =$_SESSION["trabajoEnfermedad"];
$datos->descripcionEnfermedad = $_SESSION["descripcionEnfermedad"];
$datos->descripcionIdEnfermedad = $_SESSION["descripcionIdEnfermedad"];
$datos->nombreEnfermedad = $_SESSION["nombreEnfermedad"];
$respuesta = json_encode($datos);

echo $respuesta;

}
if(isset($_POST['no'])){

siguientePregunta();	
$datos = new stdClass();
$datos->inferencia = $_SESSION["inferencia"];
$datos->indicePregunta = $_SESSION["indicePregunta"];
$datos->indiceEnfermedad = $_SESSION["indiceEnfermedad"];
$datos->preguntaEnfermedadSintoma = $_SESSION["preguntaEnfermedadSintoma"];
//$datos->verticesInferenciaEnfermedad = $_SESSION["verticesInferenciaEnfermedad"];
//$datos->antecedente = $_SESSION["antecedente"];
$datos->diagnostico = $_SESSION["diagnostico"];
$datos->trabajo =$_SESSION["trabajo"];
$datos->precio =$_SESSION["precio"];
$datos->trabajoEnfermedad =$_SESSION["trabajoEnfermedad"];
$datos->descripcionEnfermedad = $_SESSION["descripcionEnfermedad"];
$datos->nombreEnfermedad = $_SESSION["nombreEnfermedad"];
$respuesta = json_encode($datos);

echo $respuesta;
}	


function siguientePregunta(){

	if ($_SESSION["indicePregunta"] < $_SESSION["maximoPregunta"]) {
		$_SESSION["indicePregunta"] = $_SESSION["indicePregunta"]+1;
	}else{

		motorDeInferencia();

	}
}

function motorDeInferencia(){
	if(isset($_SESSION["AristaEnfermedadSintoma"]) && isset($_SESSION["indiceEnfermedad"]) && $_SESSION["indiceEnfermedad"] > 0 && $_SESSION["indiceEnfermedad"] <= count($_SESSION["AristaEnfermedadSintoma"])) {
		$aristasEnfermedad = $_SESSION["AristaEnfermedadSintoma"][$_SESSION["indiceEnfermedad"]-1];
		$arregloVerticesInferenciaEnfermedad = Array();
		$indiceVerticesInferenciaEnfermedad = 0;
		for ($i=0; $i < count($aristasEnfermedad); $i++) { 
			if ($_SESSION["inferencia"][$i] == "V") {
				$arregloVerticesInferenciaEnfermedad[$indiceVerticesInferenciaEnfermedad] = $aristasEnfermedad[$i];
				$indiceVerticesInferenciaEnfermedad++;

			}
		}

		if (count($arregloVerticesInferenciaEnfermedad)>0) {


			$_SESSION["verticesInferenciaEnfermedad"] = $arregloVerticesInferenciaEnfermedad;

			$porcentaje = diagnostico($_SESSION["verticesInferenciaEnfermedad"]);


			if ($porcentaje >49) {
				$_SESSION["diagnostico"] = 1;



			}else{
				$indice = porcentajeMayor($_SESSION["verticesInferenciaEnfermedad"]);
				$_SESSION["antecedente"] = buscarAntecedente($_SESSION["verticesInferenciaEnfermedad"][$indice],$_SESSION["indiceEnfermedad"]);

				if ($_SESSION["antecedente"] == -1) {
					$_SESSION["indiceEnfermedad"] = $_SESSION["indiceEnfermedad"]+1;
				}else{
					$_SESSION["indiceEnfermedad"] = $_SESSION["antecedente"]+1;
					$_SESSION["antecedente"] = -1;
				}
				generarPreguntas();
			}

		}else{
			$_SESSION["indiceEnfermedad"] = $_SESSION["indiceEnfermedad"]+1;
			generarPreguntas();
		}
	} else {
		$_SESSION["diagnostico"] = 2;
	}


}

function buscarAntecedente($elemento,$indiceEnfermedad){

$antecedente = -1;

$_SESSION["elemento"] = $elemento;
	for ($i=$indiceEnfermedad; $i < count($_SESSION["AristaEnfermedadSintoma"]); $i++) { 
		$aristasEnfermedad = $_SESSION["AristaEnfermedadSintoma"][$i];
		for ($f=0; $f < count($aristasEnfermedad); $f++) { 
			if ($aristasEnfermedad[$f] == $_SESSION["elemento"]) {
				$antecedente = $i;
				$f = count($aristasEnfermedad);
				$i = count($_SESSION["AristaEnfermedadSintoma"]);
			}
		}
	}			

return $antecedente;
}


function generarPreguntas(){
$enfermedadSintomas = new capaDatoEnfermedadSintoma();


$resultado = $enfermedadSintomas->getNombreSintomasByEnfermedadId($_SESSION["indiceEnfermedad"]);


$i = 0;
$c = 0;
$arregloNombreSintoma = Array();
$arregloIdSintoma = Array();
$arregloInferencia = Array();
if ($_SESSION["elemento"] != -1) {
	while ($i < count($resultado)) {

			if ($_SESSION["elemento"] != $resultado[$i]["id"]) {
				$arregloNombreSintoma[$c] = $resultado[$i]["nombre"];
				$arregloIdSintoma[$c] = $resultado[$i]["id"];
				$arregloInferencia[$c] = "F";
				$c++;
			}


		$i++;
	}
	$_SESSION["maximoPregunta"] = count($arregloNombreSintoma)-1;
	$_SESSION["preguntaEnfermedadSintoma"] = $arregloNombreSintoma;
	$_SESSION["preguntaIdSintoma"] = $arregloIdSintoma;
	$_SESSION["inferencia"] = $arregloInferencia;
	$_SESSION["indicePregunta"] = 0;
	$_SESSION["AristaEnfermedadSintoma"][$_SESSION["indiceEnfermedad"]-1] = $arregloIdSintoma;
}else{
	while ($i < count($resultado)) {

				$arregloNombreSintoma[$i] = $resultado[$i]["nombre"];
				$arregloIdSintoma[$i] = $resultado[$i]["id"];
				$arregloInferencia[$i] = "F";

		$i++;
	}
	$_SESSION["maximoPregunta"] = count($arregloNombreSintoma)-1;
	$_SESSION["preguntaEnfermedadSintoma"] = $arregloNombreSintoma;
	$_SESSION["preguntaIdSintoma"] = $arregloIdSintoma;
	$_SESSION["inferencia"] = $arregloInferencia;
	$_SESSION["indicePregunta"] = 0;

}



}



function diagnostico($verticeInferenciaEnfermedad){
$porcentaje = 0;
$enfermedadSintomas = new capaDatoEnfermedadSintoma(); 
	for ($i=0; $i < count($verticeInferenciaEnfermedad); $i++) {

		$resultado =  $enfermedadSintomas->getPonderacionById($verticeInferenciaEnfermedad[$i],$_SESSION["indiceEnfermedad"]);
		$porcentaje = $porcentaje + $resultado[0]["ponderacion"];
	}

return $porcentaje;
}


function porcentajeMayor($verticeInferenciaEnfermedad){
$porcentaje = 0;
$indice = -1;
$enfermedadSintomas = new capaDatoEnfermedadSintoma(); 
	for ($i=0; $i < count($verticeInferenciaEnfermedad); $i++) { 

		$resultado =  $enfermedadSintomas->getPonderacionById($verticeInferenciaEnfermedad[$i],$_SESSION["indiceEnfermedad"]);
		if ($resultado[0]["ponderacion"] > $porcentaje) {
			$porcentaje = $resultado[0]["ponderacion"];
			$indice = $i;

		}
	}

return $indice;
}

function iniciarNuevoDiagnosticoMedico(){
	$_SESSION["si"]=0;
$_SESSION["no"]=0;
$_SESSION["indiceEnfermedad"] = 1;
$_SESSION["antecedente"] = -1;
$_SESSION["elemento"] = -1;
$_SESSION["diagnostico"] = -1;


$arregloDescripcionEnfermedad = Array();
$arregloNombreEnfermedad = Array();
$arregloTrabajoEnfermedad = Array();
$arregloDescripcionIdEnfermedad = Array();
$enfermedad = new capaDatoEnfermedad();
$resultado = $enfermedad->getEnfermedades();
$i = 0;		
while ($i < count($resultado)) {

		$arregloDescripcionIdEnfermedad[$i] = $resultado[$i]['id'];
		$arregloDescripcionEnfermedad[$i] = $resultado[$i]['descripcion'];
		$arregloNombreEnfermedad[$i] = $resultado[$i]['nombre'];
		$arregloTrabajoEnfermedad[$i] = $resultado[$i]['idtrabajo'];
		$i++;
}	

$_SESSION["descripcionIdEnfermedad"] = $arregloDescripcionIdEnfermedad;
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
}

?>