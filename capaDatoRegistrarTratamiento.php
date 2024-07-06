<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("CapaDato/capaDatoTratamiento.php");
include_once("CapaDato/capaDatoVisita.php");
include_once("CapaDato/capaDatoAgenda.php");
$objeto= new capaDatoTratamiento();
$objetovisita = new capaDatoVisita();
$objetoagenda = new capaDatoAgenda();


try{
    if(!empty($_POST)){
        

        if(isset($_POST['registrar'])){
            $objeto->insertarClienteTratamiento($_POST['fecha'],$_POST['descripcion'],$_POST['estado'],$_SESSION['user'],$_POST['idTrabajo'],$_POST['precio']);
            $resultado = $objeto->getIdUltimoTratamiento();
            $objetovisita->insertarClienteVisita($_POST['descripcion'],$resultado[0]['id']);
            $objetoagenda->insertarClienteAgenda($_POST['titulo'],$_POST['color'],$_POST['descripcion'],$_POST['start'],$_POST['end'],$_POST['idvisita']);

        }




    }
}catch(PDOException $ex){
    echo  $ex->getMessage();
}
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
        <h2 class="alert-info">Se ha realizado la transaccion correctamente</h2>
      </div>
     
     </div>    
  </div>
      
   </div>
</div>


<script src="Public/js/jquery-3.3.1.min.js"></script>
<script src="Public/js/bootstrap.min.js"></script>
</body>
</html>