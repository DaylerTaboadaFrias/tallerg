<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("../CapaNegocio/tratamiento/capaNegocioTratamiento.php");
$objetoCapaNegocioTratamiento= new capaNegocioTratamiento();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dr.LET</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>

<?php
include_once("../plantilla.html");
?>    
<body>
<h1 class="h2 text-center pt-5 mt-4">FACTURAS</h1>

<div class="container mb-5 pb-5"> 

    <h1 class="h2 text-center mt-4 mb-4">Lista de tratamientos</h1>
    <div class="table-responsive-sm">
      <table id="resultado" class="table table-hover table-bordered table-sm" >
            <thead class="thead-dark" >
            <tr>
                <th style="display:none;" scope="col">Id</th>
                <th scope="col">Fecha</th>
                <th scope="col">Monto Total</th>
                <th scope="col">Monto Pagado</th>
                <th scope="col">Monto a cobrar</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Estado</th>
                <th scope="col">Usuario</th>
                <th scope="col">Opcion</th>
    

            </tr>
            </thead>
            <tbody id="resultado_busqueda">
            
            <?php
            $resultado=$objetoCapaNegocioTratamiento->mostrar();
            for ($i = count($resultado)-1; $i >=0 ; $i--) {

                ?>

                <tr>
                    <td style="display:none;" class="align-middle"><?php print_r($resultado[$i]['id']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['fecha']) ?></td>
                    <td class="align-middle" ><?php print_r($resultado[$i]['montototal']) ?></td>
                    <td class="align-middle" ><?php print_r(round($resultado[$i]['montopagado'],1)) ?></td>
                    <td class="align-middle" ><?php print_r(round($resultado[$i]['montoacobrar'],1)) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['descripcion']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['estado']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['apellido']." "); print_r($resultado[$i]['nombre']); ?></td>
                    <td>
                    <?php
                    if ($resultado[$i]['montoacobrar']<=0) {
                     ?>
                    
                    <form name="form1" id="form1" method="POST" action="../capaNegocio/factura/generarPdfFactura.php">
                    <input type="text" name="id" hidden value="<?php print_r($resultado[$i]['id']) ?>">
                    <button type="submit" class="btn btn-info">Generar Factura</button>
                    </form>
                     <?php
                    }
                    ?>
                    </td>
                </tr>

                <?php
            }
            ?>
            </tbody>
          </table>
    </div>
  </div> 



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>