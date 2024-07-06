<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("../CapaNegocio/categoria/capaNegocioCategoria.php");
$objetoCapaNegocio= new capaNegocioCategoria();
try{
    if(!empty($_POST)){
       

        if(isset($_POST['insertar'])){
            $objetoCapaNegocio->insertar($_POST['nombre'],$_POST['descripcion']);
        }
        if(isset($_POST['eliminar'])){

            $objetoCapaNegocio->eliminar($_POST['id']);
        }

        if(isset($_POST['actualizar'])){
            $objetoCapaNegocio->actualizar($_POST['id'],$_POST['nombre'],$_POST['descripcion']);
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
<h1 class="h2 text-center pt-5 mt-4">CATEGORIAS</h1>
<div class="container mt-3">
    <form action="categoria.php" method="POST" enctype="multipart/form-data">
        <input id="id" name="id" type="hidden">
        <div class="form-row pb-5">
            <div class="form-group col-md-4">
                <label>Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control form-control-sm" placeholder="Nombre" required>
            </div>
            <div class="form-group col-md-8">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripcion" required></textarea>
            </div>
            
        </div>

        <div class="form-row  d-flex justify-content-between">
            <button type="submit" name="insertar" class="btn btn-secondary" style="background-color: #527a7a">Insertar</button>
            <button type="submit" name="eliminar" class="btn btn-danger mx-3" style="background-color: #ff6666">Eliminar</button>
            <button type="submit" name="actualizar" class="btn btn-info mx-3">Actualizar</button>
            <input class="form-control  form-control-sm col-md-4 mx-3" id="busqueda" type="text" placeholder="Buscar por nombre" aria-label="Search">
            <button type="button" id="limpiar" class="btn btn-info" style="background-color: #ffb366; float: right">Limpiar</button>
        </div>
    
    </form>
</div>
<div class="container mb-5 pb-5">
    <h1 class="h2 text-center mt-4 mb-4">Lista de categorias</h1>
    <div class="table-responsive-sm">
        <table id="resultado" class="table table-hover table-bordered table-sm" >

            <thead class="thead-dark" >
            <tr>
                <th style="display:none;" scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
            </tr>
            </thead>
            <tbody id="resultado_busqueda">
            <?php
            $resultado=$objetoCapaNegocio->mostrar();
            for ($i = count($resultado)-1; $i >=0 ; $i--) {

                ?>

                <tr>
                    <td style="display:none;" class="align-middle"><?php print_r($resultado[$i]['id']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['nombre']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['descripcion']) ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    var table = document.getElementById("resultado");
    var rows = table.getElementsByTagName("tr");
    var valor;
    for (i = 1; i < rows.length; i++) {
        var row = table.rows[i];
        row.onclick = function(){
            document.getElementById("id").value=this.cells[0].innerHTML;
            document.getElementById("nombre").value=this.cells[1].innerHTML;
            document.getElementById("descripcion").value=this.cells[2].innerHTML;   
        }
            
    }
    document.getElementById("limpiar").onclick = function(){
        document.getElementById("id").value='';
        document.getElementById("nombre").value='';
        document.getElementById("descripcion").value='';
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
                url: "../CapaNegocio/categoria/buscarCategoria.php",
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
                                document.getElementById("id").value=this.cells[0].innerHTML;
                                document.getElementById("nombre").value=this.cells[1].innerHTML;
                                document.getElementById("descripcion").value=this.cells[2].innerHTML;
                        }
                    };
                }
            });
        });
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>