<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("CapaDato/capaDatoAgenda.php");
include_once("CapaDato/capaDatoVisita.php");
$objetoCapaNegocio= new capaDatoAgenda();
$objetoCapaNegocioVisita= new capaDatoVisita();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CENTARLDENT</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="Public/js/moment.min.js"></script>
    <script src="Public/js/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="Public/css/fullcalendar.min.css">
    <script src="Public/js/es.js"></script>
</head>

<?php
include_once("plantilla.html");
?>    
<body>
<h1 class="h2 text-center pt-5 mt-4">REGISTRAR TRATAMIENTO</h1>



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

			<form action="capaDatoRegistrarTratamiento.php" method="POST" id="form">

                <div class="form-row col-md-8">
                    <div class="form-group col-md-8">
                        <label>Fecha</label>
                        <input type="text" id="fecha" name="fecha" value="">
                    </div>
                </div>
                <div class="form-group col-md-8">

                 
                  <?php
                  $visita=$objetoCapaNegocioVisita->getVisitaTratamiento();
                  

                      ?>
                      <input type="hidden " name="idvisita" name="idvisita" value="<?php echo ($visita[0]["id"]+1) ?>">
           
                      <?php
                  
                  ?>
        

                </div> 
                <div class="form-row col-md-12">
                    <div class="form-group col-md-8">
                   
                        <input type="hidden" id="titulo" name="titulo" value="Diagnostico via web">
                    </div>
                </div>
                 <div class="form-row col-md-8">
                    <div class="form-group col-md-8">
                        <label>Hora Inicio</label>
                        <input type="text" id="horainicio" value="07:30">
                        <input hidden type="text" id="start" name="start" value=""> 
                        <input hidden type="text" id="end" name="end" value=""> 
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
                        <input type="text" id="descripcion" name="descripcion" value="Diagnostico via web">
                    </div>
                </div>  
              
                <div class="form-row col-md-8">
                    <div class="form-group col-md-8">
                        <label>Color</label>
                        <input type="color" value="#ff0000" id="color" name="color">
                    </div>
                </div>

            <div class="form-group col-md-4">
			<input type="hidden" name="precio" id="precio" value="<?php echo($_POST['precio']) ?>">
            </div>
            <div class="form-group col-md-4">
			<input type="hidden" name="idTrabajo" id="idTrabajo" value="<?php echo($_POST['idTrabajo']) ?>">
            </div>      
            <div class="form-group col-md-4">
			<input type="hidden" name="estado" id="estado" value="En proceso">
            </div>      
            <div class="form-group col-md-4">
			<input type="hidden" name="registrar" id="registrar" value="registrar">
            </div>                  
           </form>      
          </div>

          <div class="modal-footer">
            <button type="button" id="registrar2" class="btn btn-success" >Registrar</button>
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
      <form action="capaDatoRegistrarTratamiento.php" method="POST" id="form2"  style="display: none">

      <div class="form-row">
           
             <div class="form-group col-md-4">
                <label>Trabajo</label>
                <input type="text" class="form-control form-control-sm" id="nombreTrabajo" value="<?php echo($_SESSION['trabajo'][($_POST['idTrabajo'])-1]) ?>">
            </div>
            <div class="form-group col-md-4">
                <label>Precio</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo($_POST['precio']) ?>">
            </div>
            <div class="form-group col-md-4">
			<input type="hidden" name="precio2" id="precio2" value="<?php echo($_POST['precio']) ?>">
            </div>
            <div class="form-group col-md-4">
			<input type="hidden" name="idTrabajo2" id="idTrabajo2" value="<?php echo($_POST['idTrabajo']) ?>">
            </div>      

      </div>  





        <div class="form-row  d-flex justify-content-between">
            
            <button type="button" name="insertar" id="insertar" class="btn btn-secondary" style="background-color: #5882FA">Registrar tratamiento</button>

        </div>
    </form>
    </div>




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



                $('#fecha').val(date.format());
                $('#modalEventos').modal();
                
            },
   
            events:<?= json_encode($objetoCapaNegocio->mostrar(),
              JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
            ) ?>


        });
    })
</script>
<script>
var nuevoEvento;
    $('#registrar2').click(function(){
        nuevoEvento=recolectarDatosInsertar(); 

        insertar(nuevoEvento);
        console.log("pasa");
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
        end:$('#fecha').val()+" "+$('#horafin').val()
        }; 
        document.getElementById("start").value = $('#fecha').val()+" "+$('#horainicio').val();
        document.getElementById("end").value = $('#fecha').val()+" "+$('#horafin').val();
return nuevoEvento;
}

function insertar(objEvento){

              $('#CalendarioWeb').fullCalendar('renderEvent',objEvento);  
              $('#modalEventos').modal('toggle');
              document.getElementById("form2").style.display="block";
       
            
            

 
}


</script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>

var precio = document.getElementById("precio2").value;
var trabajo = document.getElementById("nombreTrabajo").value;
var moneda = 6.96;
precio = precio / moneda;
precio = parseFloat(precio).toFixed(2);	

console.log(document.getElementById("estado").value);
console.log(document.getElementById("precio").value);
console.log(document.getElementById("idTrabajo").value);
paypal.Button.render({
  // Configure environment
  env: 'sandbox',
  client: {
    sandbox: 'demo_sandbox_client_id',
    production: 'demo_production_client_id'
  },
  // Customize button (optional)
  locale: 'en_US',
  style: {
    size: 'large',
    color: 'gold',
    shape: 'pill',
    label: 'pay',
    tagline: 'true',
    fundingicons: 'true'
  },
  // Set up a payment
payment: function (data, actions) {
  return actions.payment.create({
    transactions: [{
      amount: {
        total: precio,
        currency: 'USD',
        details: {
          subtotal: precio,
          tax: '0.00',
          shipping: '0.00',
          handling_fee: '1.00',
          shipping_discount: '-1.00',
          insurance: '0.00'
        }
      },
      description: 'The payment transaction description.',
      custom: '90048630024435',
      //invoice_number: '12345', Insert a unique invoice number
      payment_options: {
        allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
      },
      soft_descriptor: 'ECHI5786786',
      item_list: {
        items: [
          {
            name: trabajo,
            description: 'Diagnostico web',
            quantity: '1',
            price: precio,
            tax: '0.01',
            sku: '1',
            currency: 'USD'
          }
        ],
        shipping_address: {
          recipient_name: 'Brian Robinson',
          line1: '4th Floor',
          line2: 'Unit #34',
          city: 'San Jose',
          country_code: 'US',
          postal_code: '95131',
          phone: '011862212345678',
          state: 'CA'
        }
      }
    }],
    note_to_payer: 'Contact us for any questions on your order.'
  });
},
  // Execute the payment
  onAuthorize: function (data, actions) {
    return actions.payment.execute()
      .then(function () {
        // Show a confirmation message to the buyer

       document.forms["form"].submit();
      });
  }
}, '#insertar');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>