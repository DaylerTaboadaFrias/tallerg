<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("../CapaNegocio/receta/capaNegocioReceta.php");
include_once("../CapaNegocio/tratamiento/capaNegocioTratamiento.php");
include_once("../CapaNegocio/medicamento/capaNegocioMedicamento.php");
$objetoCapaNegocio= new capaNegocioReceta();
$objetoCapaNegocioTratamiento= new capaNegocioTratamiento();
$objetoCapaNegocioMedicamento= new capaNegocioMedicamento();
try{
    if(!empty($_POST)){
        

        if(isset($_POST['insertar'])){
            $objetoCapaNegocio->insertar($_POST['recomendacion'],$_POST['fecha'],$_POST['idtratamiento'],$_POST['medicamentoreceta']);

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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>

<?php
include_once("../plantilla.html");
?>    
<body>
<h1 class="h2 text-center pt-5 mt-4">RECETAS</h1>
  <div class="container mt-3">
      <form action="receta.php" method="POST">
      <input id="id" name="id" type="hidden">
      <div class="form-row">
           
            <div class="form-group col-md-12">
              <label>Recomendacion</label>
               <input class="form-group col-md-12" type="text" id="recomendacion" name="recomendacion" placeholder="Recomendacion" required>
            </div>

      
      </div>  

      <div class="form-row">

            <div class="form-group col-md-4">
                <label>Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" placeholder="Fecha" required>
            </div>


            <div class="form-group col-md-8">
                <div class="form-row">
                  <label for="idtratamiento">Tratamiento</label>
                </div>
                  <select class="form-control form-control-sm" id="idtratamiento" name="idtratamiento" required>
                    <option value="0">Seleccionar tratamiento</option> 
                  <?php
                  $tratamiento=$objetoCapaNegocioTratamiento->getTratamiento();
                  for ($i = 0 ; $i < count($tratamiento) ; $i++) {

                      ?>
                       <option  value="<?php print_r($tratamiento[$i]['id'])?>"><?php print_r($tratamiento[$i]['descripcion']." Cliente: "); print_r($tratamiento[$i]['apellido']." "); print_r($tratamiento[$i]['nombre']);?></option> 
                      <?php
                  }
                  ?>
                  </select>

            </div>
      </div>  


            <h1 class="h2 text-center mt-4 mb-4">Agregar medicamentos a la receta</h1>
              <div class="form-row d-flex justify-content-xl-between mb-4">
                     
                      
                     
                          <div class="form-group col-md-8">
                          <label for="idmedicamento">Medicamento</label>
                          <select class="form-control form-control-sm col-md-4" id="idmedicamento" name="idmedicamento" required>
                          <option precio="0" value="0">Seleccionar medicamento</option> 
                          <?php
                          $medicamento=$objetoCapaNegocioMedicamento->getMedicamento();
                          for ($i = 0 ; $i < count($medicamento) ; $i++) {

                              ?>
                               <option value="<?php print_r($medicamento[$i]['id'])?>"><?php print_r($medicamento[$i]['nombre']);?></option> 
                              <?php
                          }
                          ?>
                          </select>
                          </div>
                    
                    
                      <div name="agregar" onclick="agregarMedicamentoReceta();" class="btn btn-secondary" style="background-color: #39AB73; height: 40px; margin-top: 25px;">Agregar</div>
              </div>
              
              <div class="table-responsive-sm">
              <table class="table table-hover table-bordered table-sm">
                <thead class="thead-dark" >
                <tr>
                  <th>Id</th>
                  <th>Medicamento</th>
                  <th>Frecuencia al consumir medicamento (hrs)</th>
                  <th>Opcion</th>
                </tr>
                </thead>
                
                <tbody id="tablamedicamentoreceta">
                  
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

    <h1 class="h2 text-center mt-4 mb-4">Lista de recetas</h1>
    <div class="table-responsive-sm">
      <table id="resultado" class="table table-hover table-bordered table-sm" >
            <thead class="thead-dark" >
            <tr>
                <th style="display:none;" scope="col">Id</th>
                <th scope="col">Recomendacion</th>
                <th scope="col">Fecha</th>
                <th scope="col">Descripcion tratamiento</th>
                <th scope="col">Usuario</th>
                <th scope="col">Opcion</th>
    

            </tr>
            </thead>
            <tbody id="resultado_busqueda">
            <?php
            $resultado=$objetoCapaNegocio->mostrar();
            for ($i = count($resultado)-1; $i >=0 ; $i--) {

                ?>

                <tr>
                    <td style="display:none;" class="align-middle"><?php print_r($resultado[$i]['id']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['recomendacion']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['fecha']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['tratamiento']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['apellido']." "); print_r($resultado[$i]['nombre']); ?></td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php print_r($resultado[$i]['id']) ?>">
                      Mostrar Detalle
                    </button>
                    <form name="form1" id="form1" method="POST" action="../capaNegocio/receta/generarPdfReceta.php">
                    <input type="text" name="id" hidden value="<?php print_r($resultado[$i]['id']) ?>">
                     <button type="submit" class="btn btn-info">Imprimir Receta</button>
                    </form>
                   
                    </td>
                </tr>

                <?php
            }
            ?>
            </tbody>
          </table>
    </div>
  </div> 


<?php
$n=$objetoCapaNegocio->getIdReceta();
for ($index = 0; $index <count($n); $index++) {
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal<?php print_r($n[$index]['id']) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Medicamento en la receta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      
        </button>
      </div>
      <div class="modal-body">


    <div class="table-responsive-sm">
      <table id="resultado" class="table table-hover table-bordered table-sm" >
            <thead class="thead-dark" >
            <tr>
 
                <th scope="col">Id Medicamento</th>
                <th scope="col">Medicamento</th>
                <th scope="col">Frecuencia al consumir (hrs)</th>

            </tr>
            </thead>

            <tbody id="resultado_busqueda">
<?php
$resultado=$objetoCapaNegocio->getMedicamentoRecetaByIdReceta($n[$index]['id']);
for ($i = 0; $i <count($resultado) ; $i++) {
?>

              
                <tr>
    
                    <td class="align-middle"><?php print_r($resultado[$i]['id']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['nombre']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['horafrecuencia']) ?></td>
                    
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

function agregarMedicamentoReceta() {
var select = document.getElementById("idmedicamento"),
        value = select.value, 
        texto = select.options[select.selectedIndex].text; 
        console.log(texto);


$("#tablamedicamentoreceta").append("<tr id="+id+"><td><input name='medicamentoreceta[]' type='text' class='form-control' value="+value+"></td><td><input id="+id+" type='text' class='form-control'></td><td><input name='medicamentoreceta[]' type='number' class='form-control' value='2'></td><td class='text-center'><button  class='btn btn-danger mx-3' style='background-color: #ff6666' onclick='removeMedicamentoReceta("+id+")'>Eliminar</button></td></tr>");

$("#tablamedicamentoreceta #"+id+" #"+id).attr("value",texto);
id = id+1;
}

function removeMedicamentoReceta(id){
$("#tablamedicamentoreceta #"+id).remove();
}
</script>
<script>
    var table = document.getElementById("resultado");
    var rows = table.getElementsByTagName("tr");
    var valorTramiento;
    var valorUsuario;
    for (i = 1; i < rows.length; i++) {
        var row = table.rows[i];
        row.onclick = function(){    
            document.getElementById("id").value=this.cells[0].innerHTML;
            document.getElementById("recomendacion").value=this.cells[1].innerHTML;
            document.getElementById("fecha").value=this.cells[2].innerHTML;
            var descripciontratamiento=this.cells[3].innerHTML;
                    //barramos comboboxtratamiento
                    var seecttratamiento =$('#idtratamiento option');
                    $.each(seecttratamiento,function(i,v){
                    seecttratamiento[i].remove();
                    })     
                    //creamos la lista insertando optiones con el selecionado
                    <?php
                    $listaapellido=  array();
                    $listanombre=  array();
                    $listatratamiento=  array();
                    $listaidtratamiento=  array();
                    $resultado=$objetoCapaNegocioTratamiento->getTratamiento();
                    $n= count($resultado);
                    for ($i = 0 ; $i < $n ; $i++) {
                        $listanombre[$i]=$resultado[$i]['nombre'];
                        $listaapellido[$i]=$resultado[$i]['apellido'];
                        $listatratamiento[$i]=$resultado[$i]['descripcion'];
                        $listaidtratamiento[$i]=$resultado[$i]['id'];
                    }
                    ?>
                    var listaN= <?php echo json_encode($listanombre);?>;
                    var listaA= <?php echo json_encode($listaapellido);?>;
                    var listaT= <?php echo json_encode($listatratamiento);?>;
                    var listaID= <?php echo json_encode($listaidtratamiento);?>;
                    var n=<?php echo $n;?>;
                    var select = document.getElementById("idtratamiento");
                    var option = document.createElement("option");
                    option.text = "Seleccionar Tratamiento";
                    option.value = "0";  
                    select.add(option); 
                    for (var i = 0; i <n; i++) {
                        var option = document.createElement("option");
                        option.text = listaT[i]+" Cliente: "+listaA[i]+" "+listaN[i];
                        option.value = listaID[i]; 
                        if (listaT[i]==descripciontratamiento) {option.setAttribute("selected", "");}  
                        select.add(option); 

                    }



        }
            
    }
    document.getElementById("limpiar").onclick = function(){
        document.getElementById("id").value='';
        document.getElementById("recomendacion").value='';
        document.getElementById("fecha").value='';



                    //barramos comboboxtratamiento
                    var seecttratamiento =$('#idtratamiento option');
                    $.each(seecttratamiento,function(i,v){
                    seecttratamiento[i].remove();
                    })     
                    //creamos la lista insertando optiones con el selecionado
                    <?php
                    $listaapellido=  array();
                    $listanombre=  array();
                    $listatratamiento=  array();
                    $listaidtratamiento=  array();
                    $resultado=$objetoCapaNegocioTratamiento->getTratamiento();
                    $n= count($resultado);
                    for ($i = 0 ; $i < $n ; $i++) {
                        $listanombre[$i]=$resultado[$i]['nombre'];
                        $listaapellido[$i]=$resultado[$i]['apellido'];
                        $listatratamiento[$i]=$resultado[$i]['descripcion'];
                        $listaidtratamiento[$i]=$resultado[$i]['id'];
                    }
                    ?>
                    var listaN= <?php echo json_encode($listanombre);?>;
                    var listaA= <?php echo json_encode($listaapellido);?>;
                    var listaT= <?php echo json_encode($listatratamiento);?>;
                    var listaID= <?php echo json_encode($listaidtratamiento);?>;
                    var n=<?php echo $n;?>;
                    var select = document.getElementById("idtratamiento");
                    var option = document.createElement("option");
                    option.text = "Seleccionar Tratamiento";
                    option.value = "0";  
                    select.add(option); 
                    for (var i = 0; i <n; i++) {
                        var option = document.createElement("option");
                        option.text = listaT[i]+" Cliente: "+listaA[i]+" "+listaN[i];
                        option.value = listaID[i];   
                        select.add(option); 

                    }
                 
    }

</script>
<script>
    $(document).ready(function(){
        var consulta;

        //comprobamos si se pulsa una tecla
        $("#busqueda").keyup(function(e){

            //obtenemos el texto introducido en el campo de búsqueda
            consulta = $("#busqueda").val();
            //hace la búsqueda
            $.ajax({
                type: "POST",
                url: "../CapaNegocio/receta/buscarReceta.php",
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
                        var valorEstado;
                        var valorTrabajo;
                        var valorUsuario;
                        for (i = 1; i < rows.length; i++) {
                            var row = table.rows[i];
                            row.onclick = function(){  
                                  document.getElementById("id").value=this.cells[0].innerHTML;
                                  document.getElementById("recomendacion").value=this.cells[1].innerHTML;
                                  document.getElementById("fecha").value=this.cells[2].innerHTML;
                                  var descripciontratamiento=this.cells[3].innerHTML;
                                          //barramos comboboxtratamiento
                                          var seecttratamiento =$('#idtratamiento option');
                                          $.each(seecttratamiento,function(i,v){
                                          seecttratamiento[i].remove();
                                          })     
                                          //creamos la lista insertando optiones con el selecionado
                                          <?php
                                          $listaapellido=  array();
                                          $listanombre=  array();
                                          $listatratamiento=  array();
                                          $listaidtratamiento=  array();
                                          $resultado=$objetoCapaNegocioTratamiento->getTratamiento();
                                          $n= count($resultado);
                                          for ($i = 0 ; $i < $n ; $i++) {
                                              $listanombre[$i]=$resultado[$i]['nombre'];
                                              $listaapellido[$i]=$resultado[$i]['apellido'];
                                              $listatratamiento[$i]=$resultado[$i]['descripcion'];
                                              $listaidtratamiento[$i]=$resultado[$i]['id'];
                                          }
                                          ?>
                                          var listaN= <?php echo json_encode($listanombre);?>;
                                          var listaA= <?php echo json_encode($listaapellido);?>;
                                          var listaT= <?php echo json_encode($listatratamiento);?>;
                                          var listaID= <?php echo json_encode($listaidtratamiento);?>;
                                          var n=<?php echo $n;?>;
                                          var select = document.getElementById("idtratamiento");
                                          var option = document.createElement("option");
                                          option.text = "Seleccionar tratamiento";
                                          option.value = "0";  
                                          select.add(option); 
                                          for (var i = 0; i <n; i++) {
                                              var option = document.createElement("option");
                                              option.text = listaT[i]+" Cliente: "+listaA[i]+" "+listaN[i];
                                              option.value = listaID[i]; 
                                              if (listaT[i]==descripciontratamiento) {option.setAttribute("selected", "");}  
                                              select.add(option); 

                                          }



                            }
                        }
                  
                }
            });
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>