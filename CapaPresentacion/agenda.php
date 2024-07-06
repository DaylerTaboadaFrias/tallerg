<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("../CapaNegocio/agenda/capaNegocioAgenda.php");
include_once("../CapaNegocio/visita/capaNegocioVisita.php");
$objetoCapaNegocio= new capaNegocioAgenda();
$objetoCapaNegocioVisita= new capaNegocioVisita();

try{
    if(!empty($_POST)){
        
    if (empty($_POST['id'])) {
       $objetoCapaNegocio->insertar($_POST['title'],$_POST['color'],$_POST['descripcion'],$_POST['start'],$_POST['end'],$_POST['idvisita']);
      
    }

    if (!empty($_POST['id'])) {
       $objetoCapaNegocio->actualizar($_POST['id'],$_POST['title'],$_POST['color'],$_POST['descripcion'],$_POST['start'],$_POST['end'],$_POST['idvisita']);

    }

    if (empty($_POST['title']) && empty($_POST['color']) && empty($_POST['descripcion']) && empty($_POST['start']))  {
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
    <script src="../Public/js/jquery.min.js"></script>
    <script src="../Public/js/moment.min.js"></script>
    <script src="../Public/js/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="../Public/css/fullcalendar.min.css">
    <script src="../Public/js/es.js"></script>
</head>

<?php
include_once("../plantilla.html");
?>
<body>

    <!-- Modal -->
    <div class="modal fade" id="modalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tituloEvento"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div id="descripcionEvento">
                    
                </div>

                <input hidden type="text" id="id" name="id">
                <div class="form-row col-md-8">
                    <div class="form-group col-md-8">
                        <label>Fecha</label>
                        <input type="text" id="fecha" name="fecha">
                    </div>
                </div>
                <div class="form-group col-md-8">
                <div class="form-row">
                  <label for="idvisita">Visita</label>
                </div>
                  <select class="form-control form-control-sm" id="idvisita" name="idvisita" onchange="setTitulo()" required>
                    <option value="0">Seleccionar visita</option> 
                  <?php
                  $visita=$objetoCapaNegocioVisita->getVisita();
                  for ($i = 0 ; $i < count($visita) ; $i++) {

                      ?>
                       <option nombre="<?php print_r($visita[$i]['descripcion']." Cliente: "); print_r($visita[$i]['apellido']." "); print_r($visita[$i]['nombre']);?>" value="<?php print_r($visita[$i]['id'])?>"><?php print_r($visita[$i]['descripcion']." Cliente: "); print_r($visita[$i]['apellido']." "); print_r($visita[$i]['nombre']);?></option> 
                      <?php
                  }
                  ?>
                  </select>

                </div> 
                <div class="form-row col-md-12">
                    <div class="form-group col-md-8">
                        <label>Titulo</label>
                        <input type="text" id="titulo" name="titulo">
                    </div>
                </div>
                 <div class="form-row col-md-8">
                    <div class="form-group col-md-8">
                        <label>Hora Inicio</label>
                        <input type="text" id="horainicio" value="07:30">
                    </div>
                </div>   
                <div class="form-row col-md-8">
                    <div class="form-group col-md-8">
                        <label>Hora Fin</label>
                        <input type="text" id="horafin" value="08:30">
                    </div>
                </div>              
                <div class="form-row col-md-8">
                    <div class="form-group col-md-8">
                        <label>Descripcion</label>
                        <input type="text" id="descripcion" name="descripcion">
                    </div>
                </div>  
              
                <div class="form-row col-md-8">
                    <div class="form-group col-md-8">
                        <label>Color</label>
                        <input type="color" value="#ff0000" id="color" name="color">
                    </div>
                </div>                  
                 
          </div>
          <div class="modal-footer">
            <button type="button" id="registrar" class="btn btn-success" >Registrar</button>
            <button type="button" id="actualizar" class="btn btn-primary" >Actualizar</button>
            <button type="button" id="eliminar" class="btn btn-danger" >Eliminar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5 pt-5">
        <div class="row">
            <dv class="col"></dv>
            <dv class="col-7"><div id="CalendarioWeb"></div></dv>
            <dv class="col"></dv>
        </div>
    </div>
<div class="container mb-5 pb-5">
    <h1 class="h2 text-center mt-4 mb-4">Lista de agenda</h1>
    <div class="table-responsive-sm">
        <table id="resultado" class="table table-hover table-bordered table-sm" >

            <thead class="thead-dark" >
            <tr>
                <th style="display:none;" scope="col">Id</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Color</th>
                <th scope="col">Fecha hora inicio</th>
                <th scope="col">Fecha hora fin</th>
                <th scope="col">Visita</th>
                <th scope="col">Usuario</th>

            </tr>
            </thead>
            <tbody id="resultado_busqueda">
            <?php
            $resultado=$objetoCapaNegocio->mostrar();
            for ($i = count($resultado)-1; $i >=0 ; $i--) {

                ?>

                <tr>
                    <td style="display:none;" class="align-middle"><?php print_r($resultado[$i]['id'])?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['title'])?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['descripcion'])?></td>
                    <td class="align-middle"><input type="color" value="<?php print_r($resultado[$i]['color'])?>"></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['start'])?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['end'])?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['visita'])?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['apellido']." "); print_r($resultado[$i]['nombre']);?></td>
             
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function setTitulo()
{
/* Para obtener el valor */
var nombre = $('#idvisita option:selected').attr('nombre');
document.getElementById("titulo").value=nombre;
}

</script>
<script>
    $(document).ready(function(){
        $('#CalendarioWeb').fullCalendar({
            header:{
                left:   'today,prev,next',
                center: 'title',
                right:  'month,basicWeek,basicDay,agendaWeek,agendaDay'
            },
            dayClick: function(date, jsEvent, view) {
                $('#registrar').show();
                $('#actualizar').hide();
                $('#eliminar').hide();
                $('#tituloEvento').html('');
                $('#descripcion').val('');
                $('#id').val('');
                $('#titulo').val('');
                $('#fecha').val(date.format());
                $('#modalEventos').modal();
                
            },
   
            events:<?= json_encode($objetoCapaNegocio->mostrar(),
              JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
            ) ?>
            ,
            eventClick:function(callEvent,jsEvent,view){
                $('#eliminar').show();
                $('#registrar').hide();
                $('#actualizar').show();
                $('#tituloEvento').html(callEvent.title);
                $('#descripcion').val(callEvent.descripcion);
                $('#id').val(callEvent.id);
                $('#titulo').val(callEvent.title);
                $('#color').val(callEvent.color);
                FechaHora= callEvent.start._i.split(" ");
                $('#fecha').val(FechaHora[0]);
                $('#hora').val(FechaHora[1]);
                $('#modalEventos').modal();
            }

        });
    })
</script>
<script>
var nuevoEvento;
    $('#registrar').click(function(){
        nuevoEvento=recolectarDatosInsertar(); 

        insertar(nuevoEvento);
        
    });

    $('#actualizar').click(function(){
        nuevoEvento=recolectarDatosActualizar(); 

        actualizar(nuevoEvento);
    });

    $('#eliminar').click(function(){
        nuevoEvento=recolectarDatosEliminar(); 

        eliminar(nuevoEvento);
    });    

function recolectarDatosInsertar(){
        $('#id').val('');
        var nuevoEvento={
        id:'',
        title:$('#titulo').val(),
        start:$('#fecha').val()+" "+$('#horainicio').val(),
        color:$('#color').val(),
        descripcion:$('#descripcion').val(),
        textColor:"#ffffff",
        end:$('#fecha').val()+" "+$('#horafin').val(),
        idvisita:$('#idvisita option:selected').attr('value')
        }; 
return nuevoEvento;
}
function recolectarDatosActualizar(){
        var nuevoEvento={
        id:$('#id').val(),
        title:$('#titulo').val(),
        start:$('#fecha').val()+" "+$('#horainicio').val(),
        color:$('#color').val(),
        descripcion:$('#descripcion').val(),
        textColor:"#ffffff",
        end:$('#fecha').val()+" "+$('#horafin').val(),
        idvisita:$('#idvisita option:selected').attr('value')
        }; 
return nuevoEvento;
}
function recolectarDatosEliminar(){
        var nuevoEvento={
        id:$('#id').val(),
        title:'',
        start:'',
        color:'',
        descripcion:'',
        end:''
        }; 
return nuevoEvento;
}

function insertar(objEvento){
    $.ajax({
        type:'POST',
        url:'agenda.php',
        data:objEvento,
        success:function(msg){
            if (msg){
              $('#CalendarioWeb').fullCalendar('renderEvent',objEvento);  
              $('#modalEventos').modal('toggle');
              location.reload(true);
            }
            
        },
        error:function(){
            alert('hay un error');
        }
    });
}

function actualizar(objEvento){
    $.ajax({
        type:'POST',
        url:'agenda.php',
        data:objEvento,
        success:function(msg){
            if (msg){
 
              $('#modalEventos').modal('toggle');
              location.reload(true);
            }
            
        },
        error:function(){
            alert('hay un error');
        }
    });
}
function eliminar(objEvento){
    $.ajax({
        type:'POST',
        url:'agenda.php',
        data:objEvento,
        success:function(msg){
            if (msg){
 
              $('#modalEventos').modal('toggle');
              location.reload(true);
            }
            
        },
        error:function(){
            alert('hay un error');
        }
    });
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>