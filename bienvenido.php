<?php 
session_start();
if (!isset($_SESSION['user'])) {
  header("location:index.php");
}
  echo $_SESSION['user'];
  echo $_SESSION['tipo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dr.LET</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<?php
include_once("plantilla.html");
?>    
<body>
 <div class="text-center pt-5 mt-2 ">
          <h1>BIENVENIDO</h1>
        </div>
<div class="container" style="width: 1400px; height: 700px; padding-top: 70px; ">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="Public/Imagen/bienvenido1.jpg" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
              <h5>Protesis</h5>
              <p>Protesis fija y removible</p>
              </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Public/Imagen/bienvenido2.jpg" alt="Second slide">
              <div class="carousel-caption d-none d-md-block">
              <h5>Ortodoncia</h5>
              <p>Brackets</p>
              </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Public/Imagen/bienvenido3.jpg" alt="Third slide">
              <div class="carousel-caption d-none d-md-block">
              <h5>Peridoncia</h5>
              <p>Limpeza</p>
              </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Public/Imagen/bienvenido4.jpg" alt="Third slide">
              <div class="carousel-caption d-none d-md-block">
              <h5>Diagnostico general</h5>
              <p>Consulta</p>
              </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


<script src="Public/js/jquery-3.3.1.min.js"></script>
<script src="Public/js/bootstrap.min.js"></script>
</body>

</html>