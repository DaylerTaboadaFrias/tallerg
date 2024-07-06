<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("CapaNegocio/tratamiento/capaNegocioTratamiento.php");
include_once("CapaNegocio/usuario/capaNegocioUsuario.php");
include_once("CapaNegocio/trabajo/capaNegocioTrabajo.php");
$objetoCapaNegocio= new capaNegocioTratamiento();
$objetoCapaNegocioUsuario= new capaNegocioUsuario();
$objetoCapaNegocioTrabajo= new capaNegocioTrabajo();
try{
    if(!empty($_POST)){
        

        if(isset($_POST['insertar'])){
            $objetoCapaNegocio->insertar($_POST['fecha'],$_POST['descripcion'],$_POST['estado'],$_POST['idusuario'],$_POST['trabajotratamiento']);

        }
        if(isset($_POST['eliminar'])){

            $objetoCapaNegocio->eliminar($_POST['id']);
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
</head>

<?php
include_once("../plantilla.html");
?>    
<body>
<h1 class="h2 text-center pt-5 mt-4">TRATAMIENTOS</h1>
  <div class="container mt-3">
      <form action="tratamiento.php" method="POST">
      <input id="id" name="id" type="hidden">
      <div class="form-row">
           
            <div class="form-group col-md-4">
                <label>Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" placeholder="Fecha" required>
            </div>
            <div class="form-group col-md-4">
                <label>Descripcion</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" placeholder="Descripcion" required>
            </div>
            <div class="form-group col-md-4">
                <label>Estado</label>
                <select class="form-control form-control-sm" id="estado" name="estado" required>
                    <option value="Sin estado">Seleccione estado</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Concluido">Concluido</option>
                </select>
            </div>      
      </div>  




          



        <div class="form-row  d-flex justify-content-between">
            
            <button type="submit" name="insertar" class="btn btn-secondary" style="background-color: #5882FA">Insertar</button>
            
        </div>
    </form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>