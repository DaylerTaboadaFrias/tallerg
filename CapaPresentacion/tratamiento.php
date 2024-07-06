<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("../CapaNegocio/tratamiento/capaNegocioTratamiento.php");
include_once("../CapaNegocio/evaluacion/capaNegocioEvaluacion.php");
include_once("../CapaNegocio/trabajo/capaNegocioTrabajo.php");
$objetoCapaNegocio= new capaNegocioTratamiento();
$objetoCapaNegocioEvaluacion= new capaNegocioEvaluacion();
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

      <div class="form-row">
            <div class="form-group col-md-4">
                <div class="form-row">
                  <label for="idusuario">Consulta</label>
                </div>
                  <select class="form-control form-control-sm" id="idusuario" name="idusuario" required>
                  <option value="0">Seleccionar consulta</option> 
                  <?php
                  $usuario=$objetoCapaNegocioEvaluacion->getEvaluacion();
                  for ($i = 0 ; $i < count($usuario) ; $i++) {

                      ?>
                       <option value="<?php print_r($usuario[$i]['id'])?>">Consulta #<?php print_r($usuario[$i]['id']." ");?> de <?php print_r($usuario[$i]['nombre_completo_cliente']." ");?></option> 
                      <?php
                  }
                  ?>
                  </select>

            </div>
      </div>  
        



            <h1 class="h2 text-center mt-4 mb-4">Agregar trabajos a tratamiento</h1>
              <div class="form-row d-flex justify-content-xl-between mb-4">
                     
                      
                     
                          <div class="form-group col-md-8">
                          <label for="idtrabajo">Trabajo</label>
                          <select class="form-control form-control-sm col-md-4" id="idtrabajo" name="idtrabajo" onchange="getPrecioTrabajo();" required>
                          <option precio="0" value="0">Seleccionar trabajo</option> 
                          <?php
                          $trabajo=$objetoCapaNegocioTrabajo->getTrabajo();
                          for ($i = 0 ; $i < count($trabajo) ; $i++) {

                              ?>
                               <option precio="<?php print_r($trabajo[$i]['precio'])?>" value="<?php print_r($trabajo[$i]['id'])?>"><?php print_r($trabajo[$i]['nombre']);?></option> 
                              <?php
                          }
                          ?>
                          </select>
                          </div>
                    
                          <div class="form-group col-md-3">
                          <label>Precio</label>
                          <input type="number" id="precio" name="precio" step="0.1" class="form-control form-control-sm" placeholder="Precio" >
                          </div>
                      <div name="agregar" onclick="agregarTrabajoTratamiento();" class="btn btn-secondary" style="background-color: #39AB73; height: 40px; margin-top: 25px;">Agregar</div>
              </div>
              
              <div class="table-responsive-sm">
              <table class="table table-hover table-bordered table-sm">
                <thead class="thead-dark" >
                <tr>
                  <th>Id</th>
                  <th>Trabajo</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Opcion</th>
                </tr>
                </thead>
                
                <tbody id="tablatrabajotratamiento">
                  
                </tbody>
              </table>
              </div>




        <div class="form-row  d-flex justify-content-between">
            
            <button type="submit" name="insertar" class="btn btn-secondary" style="background-color: #5882FA">Insertar</button>
            <button type="submit" name="eliminar" class="btn btn-danger mx-3" style="background-color: #ff6666">Eliminar</button>
            <input class="form-control  form-control-sm col-md-4 mx-3" id="busqueda" type="text" placeholder="Buscar por apellido de usuario" aria-label="Search">
            <button type="button" id="limpiar" class="btn btn-info" style="background-color: #FF8000; float: right">Limpiar</button>
        </div>
    </form>
</div>
<div class="container mb-5 pb-5"> 

    <h1 class="h2 text-center mt-4 mb-4">Lista de tratamientos</h1>
    <div class="table-responsive-sm">
      <table id="resultado_tratamiento" class="table table-hover table-bordered table-sm" >
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
            <tbody id="resultado_busqueda_tratamiento">
            <?php
            $resultado=$objetoCapaNegocio->mostrar();
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
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php print_r($resultado[$i]['id']) ?>">
                      Mostrar detalle
                    </button>
                    </td>
                    <td class="align-middle"><?php print_r($resultado[$i]['id_evaluacion']) ?></td>
                </tr>

                <?php
            }
            ?>
            </tbody>
          </table>
    </div>
  </div> 
  <!-- Button trigger modal -->
<?php
$n=$objetoCapaNegocio->getIdTratamiento();
for ($index = 0; $index <count($n); $index++) {
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal<?php print_r($n[$index]['id']) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Trabajos en el Tratamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      
        </button>
      </div>
      <div class="modal-body">


    <div class="table-responsive-sm">
      <table id="resultado" class="table table-hover table-bordered table-sm" >
            <thead class="thead-dark" >
            <tr>
 
                <th scope="col">Id Tratamiento</th>
                <th scope="col">Trabajo</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>

    

            </tr>
            </thead>

            <tbody id="resultado_busqueda">
<?php
$resultado=$objetoCapaNegocio->getTrabajoTratamientoByIdTratamiento($n[$index]['id']);
for ($i = 0; $i <count($resultado) ; $i++) {
?>

              
                <tr>
    
                    <td class="align-middle"><?php print_r($resultado[$i]['idtratamiento']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['trabajo']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['precio']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['cantidad']) ?></td>
                    
                </tr>

<?php
}
?>

            </tbody>
          </table>
    </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div> 

<?php
}
?>
   
<script>
var id=0;

function agregarTrabajoTratamiento() {
var select = document.getElementById("idtrabajo"), //El <select>
        value = select.value, //El valor seleccionado
        texto = select.options[select.selectedIndex].text; 
        console.log(texto);

var precio=document.getElementById("precio").value;
$("#tablatrabajotratamiento").append("<tr id="+id+"><td><input name='trabajotratamiento[]' type='text' class='form-control' value="+value+"></td><td><input id="+id+" type='text' class='form-control'></td><td><input name='trabajotratamiento[]' type='number' class='form-control' step='0.1' value="+precio+"></td><td><input name='trabajotratamiento[]' type='number' value='1' class='form-control'></td><td class='text-center'><button  class='btn btn-danger mx-3' style='background-color: #ff6666' onclick='removeTrabajoTratamiento("+id+")'>Eliminar</button></td></tr>");

$("#tablatrabajotratamiento #"+id+" #"+id).attr("value",texto);
id = id+1;
}

function removeTrabajoTratamiento(id){
$("#tablatrabajotratamiento #"+id).remove();
}
</script>
<script>
function getPrecioTrabajo()
{
/* Para obtener el valor */
var precio = $('#idtrabajo option:selected').attr('precio');
document.getElementById("precio").value=precio;
}

</script>
<script>
        $(document).ready(function() {
            var rows = $("#resultado_tratamiento tr");
            console.log(rows.length);
            
            rows.each(function(index) {
                if (index !== 0) { // Omite el encabezado
                    $(this).on("click", function() {
                        var cells = $(this).children("td");
                        $("#id").val(cells.eq(0).text());
                        $("#fecha").val(cells.eq(1).text());
                        $("#descripcion").val(cells.eq(5).text());
                        $("#estado").val(cells.eq(6).text());
                        $("#idusuario").val(cells.eq(9).text());
                    });
                }
            });
        });
    </script>
<script>
    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>