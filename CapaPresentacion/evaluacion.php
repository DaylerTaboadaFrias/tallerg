<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
require './../Controlador.php'; 
include_once("../CapaNegocio/evaluacion/capaNegocioEvaluacion.php");
include_once("../CapaNegocio/paciente/capaNegocioPaciente.php");
$objetoCapaNegocio= new capaNegocioEvaluacion();
$objetoCapaNegocioPaciente= new capaNegocioPaciente();
try{
    if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){
        if(isset($_POST['insertar'])){
            $objetoCapaNegocio->insertar($_SESSION['user'],$_POST['idcliente'],$_POST['fecha'],$_POST['motivo'],$_POST['diagnostico'],$_POST['antecedentes'],$_POST['tipo_oclusion']);
        }
        if(isset($_POST['eliminar'])){

            $objetoCapaNegocio->eliminar($_POST['id']);
        }
        if(isset($_POST['actualizar'])){
            $objetoCapaNegocio->actualizar($_POST['id'],$_POST['idcliente'],$_POST['fecha'],$_POST['motivo'],$_POST['diagnostico'],$_POST['antecedentes'],$_POST['tipo_oclusion']);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}catch(PDOException $ex){
    echo  $ex->getMessage();
}
iniciarNuevoDiagnosticoMedico();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dr.LET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>

<?php
include_once("../plantilla.html");
?>
<body>
    <br>    
<br>
<br>
<h1 class="h2 text-center pt-5 mt-4">Registro de evaluacion y diagnostico dental</h1>

<div class="container mt-3">
<h3 class="h3 pt-5 mt-4">Datos informativos para rellenar :</h3>
    <form action="evaluacion.php" method="POST" enctype="multipart/form-data">
        <input id="id" name="id" type="hidden">
        <div class="row">
            
            <div class="form-group col-md-4">
                <label>Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" placeholder="Fecha" required>
            </div>
            <div class="form-group col-md-4">
                <label for="idcliente">Cliente</label>
                <select class="form-control form-control-sm" id="idcliente" name="idcliente" required>
                <option value="0">Seleccionar cliente</option> 
                <?php
                $clientes=$objetoCapaNegocioPaciente->getPacientes();
                for ($i = 0 ; $i < count($clientes) ; $i++) {
                    ?>
                     <option value="<?php print_r($clientes[$i]['id'])?>"><?php print_r($clientes[$i]['nombre'])?></option> 
                    <?php
                }
                ?>
                </select>
            </div>
            
            
        </div>
        <br>
        <div class="row">
            <div class="form-group col">
                <label>Antecedentes patologicos</label>
                <textarea class="form-control" placeholder="Descripcion enfermedades de base del paciente" id="antecedentes" name="antecedentes" ></textarea>
            </div>
            <div class="form-group col">
                <label>Tipo de oclusion</label>
                <textarea class="form-control" placeholder="Descripcion enfermedades de base del paciente" id="tipo_oclusion" name="tipo_oclusion" ></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label>Motivo</label>
                <textarea class="form-control" placeholder="Descripcion del motivo de la consulta" id="motivo" name="motivo" ></textarea>
            </div>
            <div hidden class="form-group col">
                <label>Id Enfermedad</label>
                <textarea class="form-control" placeholder="Diagnostico" id="idenfermedad" name="idenfermedad" ></textarea>
            </div>
            <div class="form-group col">
                <label>Diagnotico</label>
                <textarea class="form-control" placeholder="Diagnostico" id="diagnostico" name="diagnostico" ></textarea>
            </div>
        </div>
        <br>
        <h3 class="h3">Diagnostico dental</h3>
        <br>
        <div class="form-row">
            
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Iniciar diagnosticador de enfermedades
        </button>

        <div class="modal  fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Diagnoticador de enfermedades</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card" style="">
                        <div class="card-body">
                            <div class="text-center mb-2">
                                <img src="../Public/Imagen/logo_drlet.jpg" width="200" height="200">
                            </div>
                            <div class="text-center mb-3 pb-3">
                                <div class="alert alert-info" role="alert">
                                    <h2 class="alert-info" id="inicio">¿Usted tiene?</h2>
                                    <h3 class="alert-info" id="usted"><h3 style="color: red" id="nombreEnfermedad"></h3></h3>
                                    <h4 id="pregunta"> <?php if(isset($_SESSION["preguntaEnfermedadSintoma"]) && isset($_SESSION["indicePregunta"]) && $_SESSION["indicePregunta"] < count($_SESSION["preguntaEnfermedadSintoma"])) {
                                                                    echo $_SESSION["preguntaEnfermedadSintoma"][$_SESSION["indicePregunta"]];
                                                                } else {
                                                                    echo "No se han presentado sintomas.";
                                                                } ?> </h4>
                                </div>
                                <div class="alert alert-primary" role="alert" style="display: none" id="seccion">
                                    <h3 class="alert-primary" id="tratamiento">Tratamiento recomendado : <h3 style="color: red" id="nombreTratamiento"></h3></h3>
                                    <h5 hidden id="costo"></h5>
                                    <form action="RegistrarTratamiento.php" method="POST">
                                        <input type="hidden" id="idTrabajo" name="idTrabajo" >
                                        <input  type="hidden" id="precio" name="precio">
                                        <button hidden class="btn btn-info" type="submit">Deseo registrar un tratamiento</button>
                                    </form>
                                    
                                    <a hidden target="_blank"  href="/Ubicacion.php" class="btn btn-info">¿Donde nos encontramos?</a>
                                    </div>
                                    <button type="button" id="si" name="si" class="btn btn-success">SI</button>
                                    <button type="button" id="no" name="no" class="btn btn-danger">NO</button>			
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
        </div>
        <br>
        <br>
        <div class="form-row justify-content-between">
            <button type="submit" name="insertar" class="btn btn-secondary" style="background-color: #527a7a">Insertar</button>
            <button type="submit" name="eliminar" class="btn btn-danger mx-3" style="background-color: #ff6666">Eliminar</button>
            <button type="submit" name="actualizar" class="btn btn-info mx-3">Actualizar</button>
            <input class="form-control" id="busqueda" type="text" placeholder="Buscar por nombre" aria-label="Search">
            <button type="button" id="limpiar" class="btn btn-info" >Limpiar</button>
        </div>
    
    </form>
</div>
<div class="container mb-5 pb-5">
    <h1 class="h2 text-center mt-4 mb-4">Lista de trabajos</h1>
    <div class="table-responsive-sm">
        <table id="resultado" class="table table-hover table-bordered table-sm" >

            <thead class="thead-dark" >
            <tr>
                <th style="display:none;" scope="col">Id</th>
                <th scope="col">Cliente</th>
                <th hidden scope="col">Id Cliente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Motivo</th>
                <th scope="col">Diagnostico</th>
                <th hidden scope="col">tipo_oclusion</th>
                <th hidden scope="col">antecedentes_patologicos</th>
            </tr>
            </thead>
            <tbody id="resultado_busqueda">
            <?php
            $resultado=$objetoCapaNegocio->mostrar($_SESSION['user']);
            if($_SESSION['tipo'] == 'D'){
                $resultado=$objetoCapaNegocio->mostrarAdmin();
            }
            for ($i = count($resultado)-1; $i >=0 ; $i--) {

                ?>
                    <tr>
                        <td style="display:none;" class="align-middle"><?php print_r($resultado[$i]['id'])?></td>
                        <td class="align-middle"><?php print_r($resultado[$i]['nombre_completo_cliente'])?></td>
                        <td hidden class="align-middle"><?php print_r($resultado[$i]['id_paciente'])?></td>
                        <td class="align-middle"><?php print_r($resultado[$i]['fecha'])?></td>
                        <td class="align-middle"><?php print_r($resultado[$i]['motivo'])?></td>
                        <td class="align-middle"><?php print_r($resultado[$i]['diagnostico'])?></td>
                        <td hidden class="align-middle"><?php print_r($resultado[$i]['tipo_oclusion'])?></td>
                        <td hidden class="align-middle"><?php print_r($resultado[$i]['antecedentes_patologicos'])?></td>
                
                    </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<script>
   $(document).ready(function() {
            $("#resultado tr").each(function(index) {
                if (index !== 0) { // Omite el encabezado
                    $(this).on("click", function() {
                        var cells = $(this).children("td");
                        $("#id").val(cells.eq(0).text());
                        $("#idcliente").val(cells.eq(2).text());
                        $("#fecha").val(cells.eq(3).text());
                        $("#motivo").val(cells.eq(4).text());
                        $("#diagnostico").val(cells.eq(5).text());
                        $("#tipo_oclusion").val(cells.eq(6).text());
                        $("#antecedentes").val(cells.eq(7).text());
                    });
                }
            });
        });
</script>

<script>
$(document).ready(function() {
    $("#si").click(function(){

	              $.ajax({
			            type: "POST",
			            url: "./../Controlador.php",
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
		                  		$("#idenfermedad").text(data.descripcionIdEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#nombreTratamiento").text(data.trabajo[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1]);
		                  		$("#costo").text(data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1]+" Bs.");
		                 		document.getElementById("seccion").style.display="block";
		                 		document.getElementById("idTrabajo").value = data.trabajoEnfermedad[(data.indiceEnfermedad)-1];
		                 		document.getElementById("precio").value = data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1];
                                console.log(data);
		                  	}else if (data.diagnostico == 2) {
		                  		document.getElementById("pregunta").style.display="none";
		                  		document.getElementById("si").style.display="none";
		                  		document.getElementById("no").style.display="none";
		                  		document.getElementById("inicio").style.display="none";
		                  		
		                  		$("#idenfermedad").text("0");
		                  		$("#usted").text("No es posible encontrar una enfermedad sin sintomas ");
		                  		$("#nombreEnfermedad").text(data.nombreEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#diagnostico").text(data.descripcionEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#nombreTratamiento").text("Ninguno");
		                 		document.getElementById("seccion").style.display="block";
		                 		document.getElementById("idTrabajo").value = data.trabajoEnfermedad[(data.indiceEnfermedad)-1];
		                 		document.getElementById("precio").value = data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1];
                                 console.log(data);
                            }else{
                                console.log(data);
		                  		$("#pregunta").text(data.preguntaEnfermedadSintoma[data.indicePregunta]);
		                  	}
		     				
		     			
	                                                                  
                                                    
	                    }
	              });
	    
    });
    $("#no").click(function(){

	              $.ajax({
			            type: "POST",
			            url: "./../Controlador.php",
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
		                  		console.log(data);
		                  		$("#usted").text("Ya hemos diagnosticado sus sintomas usted tiene: ");
		                  		$("#nombreEnfermedad").text(data.nombreEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#diagnostico").text(data.descripcionEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#idenfermedad").text(data.descripcionIdEnfermedad[(data.indiceEnfermedad)-1]);
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
		                  		console.log(data);
		                  		$("#idenfermedad").text("0");
		                  		$("#usted").text("No es posible encontrar una enfermedad sin sintomas ");
		                  		$("#nombreEnfermedad").text(data.nombreEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#diagnostico").text(data.descripcionEnfermedad[(data.indiceEnfermedad)-1]);
		                  		$("#nombreTratamiento").text("Ninguno");
		                 		document.getElementById("seccion").style.display="block";
		                 		document.getElementById("idTrabajo").value = data.trabajoEnfermedad[(data.indiceEnfermedad)-1];
		                 		document.getElementById("precio").value = data.precio[(data.trabajoEnfermedad[(data.indiceEnfermedad)-1])-1];
		                  	}else{
                                console.log(data);
		                  		$("#pregunta").text(data.preguntaEnfermedadSintoma[data.indicePregunta]);
		                  	}
		     				
		     				
		     			}
	              });
        
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>