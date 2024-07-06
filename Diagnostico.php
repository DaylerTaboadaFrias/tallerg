<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("CapaDato/capaDatoEnfermedadSintoma.php");
//echo $_SESSION["indicePregunta"];
//print_r($_SESSION["descripcionEnfermedad"]);
//print_r($_SESSION["inferencia"]);
//print_r($_SESSION["preguntaEnfermedadSintoma"]);
//print_r($_SESSION["verticesInferenciaEnfermedad"]);
//echo ($_SESSION["antecedente"]);
//echo $_SESSION["diagnostico"];

?>

<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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
			<div class="text-center mb-4">
				<img src="Public/Imagen/logo_drlet.jpg" width="250" height="250">
			</div>
			<div class="text-center mb-5 pb-5">
				<div class="alert alert-info" role="alert">
				<h2 class="alert-info" id="inicio">¿Usted tiene?</h2>
				<h3 class="alert-info" id="usted"><h3 style="color: red" id="nombreEnfermedad"></h3></h3>
				<h4 id="pregunta"> <?php if(isset($_SESSION["preguntaEnfermedadSintoma"]) && isset($_SESSION["indicePregunta"]) && $_SESSION["indicePregunta"] < count($_SESSION["preguntaEnfermedadSintoma"])) {
												echo $_SESSION["preguntaEnfermedadSintoma"][$_SESSION["indicePregunta"]];
											} else {
												echo "No se han presentado sintomas.";
											} ?> </h4>
				<h5 id="diagnostico"> </h5>
				</div>
				<div class="alert alert-primary" role="alert" style="display: none" id="seccion">

				<h3 class="alert-primary" id="tratamiento">Tratamiento: <h3 style="color: red" id="nombreTratamiento"></h3></h3>
				<h5 id="costo"></h5>
				<form action="RegistrarTratamiento.php" method="POST">
					<input type="hidden" id="idTrabajo" name="idTrabajo" >
					<input type="hidden" id="precio" name="precio">
					<button class="btn btn-info" type="submit">Deseo registrar un tratamiento</button>
				</form>
				
				<a target="_blank"  href="/Ubicacion.php" class="btn btn-info">¿Donde nos encontramos?</a>
				</div>
				<button type="button" id="si" name="si" class="btn btn-success">SI</button>
				<button type="button" id="no" name="no" class="btn btn-danger">NO</button>			
			</div>	
		</div>
	</div>
   </div>
</div>

			


 
<script src="Public/js/jquery-3.3.1.min.js"></script>
<script src="Public/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $("#si").click(function(){

	              $.ajax({
			            type: "POST",
			            url: "Controlador.php",
			            data: {si: "si"},
			            dataType:"json",
	                    beforeSend: function(){
	                    },
	                    error: function(){
	                    alert("error petición ajax");
	                    },
	                    success: function(data){
		                    console.log(data);  
		                  	if (data.diagnostico == 1) {
		                  		document.getElementById("pregunta").style.display="none";
		                  		document.getElementById("si").style.display="none";
		                  		document.getElementById("no").style.display="none";
		                  		document.getElementById("inicio").style.display="none";
		                  		
		                  		$("#usted").text("Ya hemos diagnosticado sus sintomas usted tiene: ");
		                  		$("#nombreEnfermedad").text(data.nombreEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#diagnostico").text(data.descripcionEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#nombreTratamiento").text(data.trabajo[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1]);
		                  		$("#costo").text(data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1]+" Bs.");
		                 		document.getElementById("seccion").style.display="block";
		                 		document.getElementById("idTrabajo").value = data.trabajoEnfermedad[(data.indiceEnfermedad)-1];
		                 		document.getElementById("precio").value = data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1];
		                  	}else if (data.diagnostico == 2) {
		                  		document.getElementById("pregunta").style.display="none";
		                  		document.getElementById("si").style.display="none";
		                  		document.getElementById("no").style.display="none";
		                  		document.getElementById("inicio").style.display="none";
		                  		
		                  		$("#usted").text("No es posible encontrar una enfermedad sin sintomas ");
		                  		$("#nombreEnfermedad").text(data.nombreEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#diagnostico").text(data.descripcionEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#nombreTratamiento").text("Ninguno");
		                 		document.getElementById("seccion").style.display="block";
		                 		document.getElementById("idTrabajo").value = data.trabajoEnfermedad[(data.indiceEnfermedad)-1];
		                 		document.getElementById("precio").value = data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1];
		                  	}else{
		                  		$("#pregunta").text(data.preguntaEnfermedadSintoma[data.indicePregunta]);
		                  	}
		     				
		     			
	                                                                  
                                                    
	                    }
	              });
	    
    });
    $("#no").click(function(){

	              $.ajax({
			            type: "POST",
			            url: "Controlador.php",
			            data: {no: "no"},
			            dataType:"json",
	                    beforeSend: function(){
	                    },
	                    error: function(){
	                    alert("error petición ajax");
	                    },
	                    success: function(data){ 
	
		                    console.log(data);  
		                  	if (data.diagnostico == 1) {
		                  		document.getElementById("pregunta").style.display="none";
		                  		document.getElementById("si").style.display="none";
		                  		document.getElementById("no").style.display="none";
		                  		document.getElementById("inicio").style.display="none";
		                  		
		                  		$("#usted").text("Ya hemos diagnosticado sus sintomas usted tiene: ");
		                  		$("#nombreEnfermedad").text(data.nombreEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#diagnostico").text(data.descripcionEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#nombreTratamiento").text(data.trabajo[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1]);
		                  		$("#costo").text(data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1]+" Bs.");
		                  		document.getElementById("seccion").style.display="block";
		                  		document.getElementById("idTrabajo").value = data.trabajoEnfermedad[(data.indiceEnfermedad)-1];
		                 		document.getElementById("precio").value = data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1];
		                  	}else if (data.diagnostico == 2) {
		                  		document.getElementById("pregunta").style.display="none";
		                  		document.getElementById("si").style.display="none";
		                  		document.getElementById("no").style.display="none";
		                  		document.getElementById("inicio").style.display="none";
		                  		
		                  		$("#usted").text("No es posible encontrar una enfermedad sin sintomas ");
		                  		$("#nombreEnfermedad").text(data.nombreEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#diagnostico").text(data.descripcionEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#nombreTratamiento").text("Ninguno");
		                 		document.getElementById("seccion").style.display="block";
		                 		document.getElementById("idTrabajo").value = data.trabajoEnfermedad[(data.indiceEnfermedad)-1];
		                 		document.getElementById("precio").value = data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1];
		                  	}else{
		                  		$("#pregunta").text(data.preguntaEnfermedadSintoma[data.indicePregunta]);
		                  	}
		     				
		     				
		     			}
	              });
        
    });
});

</script>
</body>
</html>
