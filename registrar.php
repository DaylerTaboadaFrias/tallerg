<?php
include_once("CapaDato/capaDatoUsuario.php");
$capaDatoUsuario= new capaDatoUsuario();	
try{
	if(!empty($_POST)){

	
		if(isset($_POST['insertar'])){
			$capaDatoUsuario->insertarCliente($_POST['nombre'],$_POST['apellido'],$_POST['cedula'],$_POST['correo'],$_POST['nit'],$_POST['sexo'],$_POST['telefono'],$_POST["foto"]);
		}
		
		
	}
}catch(PDOException $ex){
	echo  $ex->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CENTARLDENT</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<?php
include_once("plantilla.html");
?>		
<body>
<h1 class="h2 text-center pt-5 mt-4">Registrar usuario</h1>
	<div class="container mt-3">
  		<form action="registrar.php" method="POST">
  			<input id="id" name="id" type="hidden">
			<div class="form-row">
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

			<div class="form-row">
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

			<div class="form-row pb-5">
		  		<div class="form-group col-md-4">
		  			<label>Foto para login</label>
					<button type="button" name="insertar" onclick="openCamera();" class="btn btn-secondary" style="background-color: #5882FA">Tomese una foto de usted</button>	
		  		</div>
		  		<input id="mydata" type="hidden" name="foto" value=""/>
			</div>	
			<div class="form-row pb-5">
			<div id="my_result"></div>	
			</div>	
			
			
        <div class="form-row  d-flex justify-content-between">
            <button type="submit" name="insertar" class="btn btn-secondary" style="background-color: #5882FA;margin-top: 40px; margin-bottom: 40px;">Registrar</button>
        </div>

		</form>
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
<script src="webcam.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
