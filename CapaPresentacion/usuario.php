<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("../CapaNegocio/usuario/capaNegocioUsuario.php");
$objetoCapaNegocio= new capaNegocioUsuario();	
try{
	if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){


	
		if(isset($_POST['insertar'])){
			$objetoCapaNegocio->insertar($_POST['nombre'],$_POST['apellido'],$_POST['cedula'],$_POST['correo'],$_POST['nit'],$_POST['sexo'],$_POST['telefono'],$_POST['tipo']);
		}
		if(isset($_POST['eliminar'])){

			$objetoCapaNegocio->eliminar($_POST['id']);
		}

		if(isset($_POST['actualizar'])){
			$objetoCapaNegocio->actualizar($_POST['id'],$_POST['nombre'],$_POST['apellido'],$_POST['cedula'],$_POST['correo'],$_POST['nit'],$_POST['sexo'],$_POST['telefono'],$_POST['tipo']);
		}
		
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
		
	}
}catch(PDOException $ex){
	echo  $ex->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dr.LET</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
include_once("../plantilla.html");
?>		
<body>
	<br>
	<br>
<h1 class="h2 text-center pt-5 mt-4">USUARIOS</h1>
	<div class="container mt-3">
  		<form action="usuario.php" method="POST">
  			<input id="id" name="id" type="hidden">
			<div class="row">
		  		<div class="form-group col-md-4">
				    <label>Nombre</label>
				    <input type="text" id="nombre" name="nombre" class="form-control form-control-sm" placeholder="Nombre" required>
		  		</div>
				<div class="form-group col-md-4">
				    <label>Apellido</label>
				    <input type="text" id="apellido" name="apellido" class="form-control form-control-sm" placeholder="Apellido" required>
		  		</div>
		  		<div class="form-group col-md-4">
				    <label>Cedula</label>
				    <input type="number" id="cedula" name="cedula" class="form-control form-control-sm" placeholder="Cedula" required>
		  		</div>
			</div>	

			<div class="row">
				<div class="form-group col-md-4">
				    <label>Correo</label>
				    <input type="email" id="correo" name="correo" class="form-control form-control-sm" placeholder="Correo" required>
		  		</div>
		  		<div class="form-group col-md-4">
				    <label>Nit</label>
				    <input type="number" id="nit" name="nit" class="form-control form-control-sm" placeholder="Nit" required>
		  		</div>
		  		<div class="form-group col-md-4">
				    <label for="sexo">Sexo</label>
				    <select class="form-control form-control-sm" id="sexo" name="sexo" required>
				      <option value="M">Masculino</option>
				      <option value="F">Femenino</option>
				    </select>
		  		</div>
			</div>	
			<div class="form-row pb-5">

		  		<div class="form-group col-md-4">
				    <label>Telefono</label>
				    <input type="number" id="telefono" name="telefono" class="form-control form-control-sm" placeholder="Telefono" required>
		  		</div>
		  		
			</div>	
			<div hidden class="form-row pb-5">
		  		<div class="form-group col-md-4">
		  			<label>Foto para login</label>
					<button type="button" name="insertar" onclick="openCamera();" class="btn btn-secondary" style="background-color: #5882FA">Tomese una foto de usted</button>	
		  		</div>
		  		<input id="mydata" type="hidden" name="foto" value=""/>
			</div>		
			<div id="my_result"></div>
			
			<div class="form-group col-md-4">
                <label for="tipo">Tipo</label>
                <select class="form-control form-control-sm" required id="tipo" name="tipo" required>
                	<option value="0">Seleccionar tipo</option> 
					<option value="A">Odontologo</option> 
					<option value="B">Auxiliar</option> 
					<option value="D">Administrador</option> 
                </select>
            </div>	
        <div class="form-row  d-flex justify-content-between">
            <button type="submit" name="insertar" class="btn btn-secondary" style="background-color: #5882FA">Insertar</button>
            <button type="submit" name="eliminar" class="btn btn-danger mx-3" style="background-color: #ff6666">Eliminar</button>
            <button type="submit" name="actualizar" class="btn btn-info mx-3">Actualizar</button>
            <input class="form-control  form-control-sm col-md-4 mx-3" id="busqueda" type="text" placeholder="Buscar por nombre" aria-label="Search">
            <button type="button" id="limpiar" class="btn btn-info" style="background-color: #FF8000; float: right">Limpiar</button>
        </div>

		</form>
	</div>
	<div class="container mb-5 pb-5">	
		<h1 class="h2 text-center mt-4 mb-4">Lista de usuarios</h1>
		<div class="table-responsive-sm">
			<table id="resultado" class="table table-hover table-bordered table-sm" >

						<thead class="table-dark" >
							<tr>
								<th style="display:none;" scope="col">Id</th>
								<th scope="col">Nombre</th>
								<th scope="col">Apellido</th>
								<th scope="col">Cedula</th>
								<th scope="col">Correo</th>
								<th scope="col">Nit</th>
								<th scope="col">Sexo</th>
								<th scope="col">Telefono</th>	
								<th scope="col">Tipo</th>
							</tr>
						</thead>
						<tbody id="resultado_busqueda">
						<?php
						$resultado=$objetoCapaNegocio->mostrar();
						for ($i = count($resultado)-1; $i >=0 ; $i--) {
						
						?>
						
						<tr>
							<td style="display:none;"><?php print_r($resultado[$i]['id']) ?></td>
							<td ><?php print_r($resultado[$i]['nombre']) ?></td>
							<td ><?php print_r($resultado[$i]['apellido']) ?></td>
							<td ><?php print_r($resultado[$i]['cedula']) ?></td>
							<td ><?php print_r($resultado[$i]['correo']) ?></td>
							<td ><?php print_r($resultado[$i]['nit']) ?></td>
							<td ><?php print_r($resultado[$i]['sexo']) ?></td>
							<td ><?php print_r($resultado[$i]['telefono']) ?></td>
							<td ><?php print_r($resultado[$i]['tipo']) ?></td>
						</tr>
						
						<?php
						}
						?>
						</tbody>
					</table>
		</div>
	</div>	

	<div id="modal" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom">
			<header class="w3-container w3-teal"> 
			<span onclick="closeCamera();" 
			class="w3-button w3-display-topright">X</span>
			<h3 class="w3-center">Suba su fotografia para poder hacer el reconocimineto facial.</h3>        
			</header>
			<div class="w3-container w3-center">        
				<p>Tomese una foto en este momento donde se ecuentre solo usted.</p>
				
				<div class="w3-container w3-center">
					<div>
					<div id="my_camera" style="width:320px; height:240px;display:inline-block;"></div>	
					</div>
					<button class="w3-btn w3-teal w3-center" style="width:50%; margin-top: 20px;margin-bottom: 20px;" onclick="take_snapshot();">Tomarse foto</button>		
				</div>

			</div>

		</div>
	</div>

	<script>
		var table = document.getElementById("resultado");
		var rows = table.getElementsByTagName("tr");
		    for (i = 1; i < rows.length; i++) {
		        var row = table.rows[i];
				console.log(row);
		        row.onclick = function(){
                 	rIndex= this.rowIndex; 
                 	document.getElementById("id").value=this.cells[0].innerHTML;
                    document.getElementById("nombre").value=this.cells[1].innerHTML;
                    document.getElementById("apellido").value=this.cells[2].innerHTML;
                    document.getElementById("cedula").value=this.cells[3].innerHTML;
                    document.getElementById("correo").value=this.cells[4].innerHTML;
                    document.getElementById("nit").value=this.cells[5].innerHTML;
                    document.getElementById("telefono").value=this.cells[7].innerHTML;
					$('#tipo').val(this.cells[8].innerHTML);
					$('#sexo').val(this.cells[6].innerHTML);
		        };
		    }

		    document.getElementById("limpiar").onclick = function(){
		    		document.getElementById("id").value='';
                    document.getElementById("nombre").value='';
                    document.getElementById("apellido").value='';
                    document.getElementById("cedula").value='';
                    document.getElementById("correo").value='';
                    document.getElementById("nit").value='';
                    document.getElementById("sexo").value='';
                    document.getElementById("telefono").value='';
                    document.getElementById("tipo").value='';
		    }
		
	</script>
	<script>
		$(document).ready(function(){
		console.log('hola');
        var consulta;
                                                                              
        //comprobamos si se pulsa una tecla
	        $("#busqueda").keyup(function(e){
	                                      
	              //obtenemos el texto introducido en el campo de búsqueda
	              consulta = $("#busqueda").val();
	              //hace la búsqueda                                                                                  
	              $.ajax({
	                    type: "POST",
	                    url: "../CapaNegocio/usuario/buscarUsuario.php",
	                    data: "b="+consulta,
	                    dataType: "html",
	                    beforeSend: function(){
	                    //imagen de carga

	                    $("#resultado_busqueda").html("<p align='center'><img src='../Public/Imagen/ajax-loader.gif' /></p>");
	                    },
	                    error: function(){
	                    alert("error petición ajax");
	                    },
	                    success: function(data){                                                    
	                    $("#resultado_busqueda").empty();
	                    $("#resultado_busqueda").append(data); 
						var table = document.getElementById("resultado");
						var rows = table.getElementsByTagName("tr");
						    for (i = 1; i < rows.length; i++) {
						        var row = table.rows[i];
						        row.onclick = function(){
						         	rIndex= this.rowIndex; 
					                 	document.getElementById("id").value=this.cells[0].innerHTML;
					                    document.getElementById("nombre").value=this.cells[1].innerHTML;
					                    document.getElementById("apellido").value=this.cells[2].innerHTML;
					                    document.getElementById("cedula").value=this.cells[3].innerHTML;
					                    document.getElementById("correo").value=this.cells[4].innerHTML;
					                    document.getElementById("nit").value=this.cells[5].innerHTML;
					                    document.getElementById("sexo").value=this.cells[6].innerHTML;
					                    document.getElementById("telefono").value=this.cells[7].innerHTML;
					                    document.getElementById("tipo").value=this.cells[8].innerHTML;
						        };
						    }

						                                                          
	                    }
	              });                                                                         
	        });                                                     
		});         
	</script>

<script>
	
	
	function take_snapshot() {
		Webcam.snap( function(data_uri) {
			document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
			var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
		
			document.getElementById('mydata').value = raw_image_data;
		} );
		closeCamera();


	}

	function openCamera(){
		document.getElementById("modal").style.display = "block";
		Webcam.attach( '#my_camera' );
		Webcam.set({
			width: 320,
			height: 240,
			dest_width: 640,
			dest_height: 480,
			image_format: 'jpg',
			jpeg_quality: 90,
			force_flash: false,
			flip_horiz: true,
			fps: 45
		});
	}

	function closeCamera(){
		document.getElementById("modal").style.display = "none";
		//Webcam.reset()
	}

</script>	
<script src="../webcam.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>