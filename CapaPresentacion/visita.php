<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("../CapaNegocio/visita/capaNegocioVisita.php");
include_once("../CapaNegocio/tratamiento/capaNegocioTratamiento.php");
$objetoCapaNegocio= new capaNegocioVisita();
$objetoCapaNegocioTratamiento= new capaNegocioTratamiento();
try{
    if(!empty($_POST)){
       

        if(isset($_POST['insertar'])){
            $objetoCapaNegocio->insertar($_POST['descripcion'],$_POST['pagoadelanto'],$_POST['idtratamiento']);
        }
        if(isset($_POST['eliminar'])){

            $objetoCapaNegocio->eliminar($_POST['id']);
        }

        if(isset($_POST['actualizar'])){
            $objetoCapaNegocio->actualizar($_POST['id'],$_POST['descripcion'],$_POST['pagoadelanto'],$_POST['idtratamiento']);
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
<h1 class="h2 text-center pt-5 mt-4">VISITAS</h1>
<div class="container mt-3">
    <form action="visita.php" method="POST" enctype="multipart/form-data">
        <input id="id" name="id" type="hidden">
        <div class="form-row pb-5">
            <div class="form-group col-md-6">
                <label>Descripcion</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" placeholder="Descripcion" required>
            </div>
            <div class="form-group col-md-6">
                <label>Pago adelanto</label>
                <input type="number" step="0.1" id="pagoadelanto" name="pagoadelanto" class="form-control form-control-sm" placeholder="Pago adelanto">
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

        <div class="form-row  d-flex justify-content-between">
            <button type="submit" name="insertar" class="btn btn-secondary" style="background-color: #527a7a">Insertar</button>
            <button type="submit" name="eliminar" class="btn btn-danger mx-3" style="background-color: #ff6666">Eliminar</button>
            <button type="submit" name="actualizar" class="btn btn-info mx-3">Actualizar</button>
            <input class="form-control  form-control-sm col-md-4 mx-3" id="busqueda" type="text" placeholder="Buscar por descripcion de visita" aria-label="Search">
            <button type="button" id="limpiar" class="btn btn-info" style="background-color: #ffb366; float: right">Limpiar</button>
        </div>
    
    </form>
</div>
<div class="container mb-5 pb-5">
    <h1 class="h2 text-center mt-4 mb-4">Lista de visitas</h1>
    <div class="table-responsive-sm">
        <table id="resultado" class="table table-hover table-bordered table-sm" >

            <thead class="thead-dark" >
            <tr>
                <th style="display:none;" scope="col">Id</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Pago adelanto</th>
                <th scope="col">Monto total tratamiento</th>
                <th scope="col">Monto pagado tratamiento</th>
                <th scope="col">Monto a cobrar tratamiento</th>
                <th scope="col">Tratamiento</th>
            </tr>
            </thead>
            <tbody id="resultado_busqueda">
            <?php
            $resultado=$objetoCapaNegocio->mostrar();
            for ($i = count($resultado)-1; $i >=0 ; $i--) {

                ?>

                <tr>
                    <td style="display:none;" class="align-middle"><?php print_r($resultado[$i]['id']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['descripcion']) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['pagoadelanto']) ?></td>
                    <td class="align-middle"><?php print_r(round($resultado[$i]['montototal'],1)) ?></td>
                    <td class="align-middle"><?php print_r(round($resultado[$i]['montopagado'],1)) ?></td>
                    <td class="align-middle"><?php print_r(round($resultado[$i]['montoacobrar'],1)) ?></td>
                    <td class="align-middle"><?php print_r($resultado[$i]['tratamiento']) ?></td>
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
            document.getElementById("descripcion").value=this.cells[1].innerHTML;
            document.getElementById("pagoadelanto").value=this.cells[2].innerHTML;   
            var descripciontratamiento=this.cells[6].innerHTML;
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
        document.getElementById("descripcion").value='';
        document.getElementById("pagoadelanto").value='';
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
                url: "../CapaNegocio/visita/buscarVisita.php",
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
                                document.getElementById("descripcion").value=this.cells[1].innerHTML;
                                document.getElementById("pagoadelanto").value=this.cells[2].innerHTML;   
                                var descripciontratamiento=this.cells[6].innerHTML;
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