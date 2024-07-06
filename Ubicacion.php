<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
?>

<html>
<head>
<meta charset="utf-8">
<title>CENTRALDENT</title>


<link rel="stylesheet" href="Public/css/bootstrap.min.css">
<?php
include_once("plantilla.html");
?> 
</head>
<style>
.center {
    margin: auto;
    width: 50%;
    border: 3px solid black;
    padding: 10px;
}  
</style>

<body>
<div class="container"> 	
	<input type="hidden" name="latitudOrigen" id="latitudOrigen">
	<input type="hidden" name="longitudOrigen" id="longitudOrigen">
	<input type="hidden" name="latitudDestino" id="latitudDestino">
	<input type="hidden" name="longitudDestino" id="longitudDestino">
	<h1 class="text-center mt-5 pt-5">Como llegar a la clinica</h1>
	<div id="map" class="center" style="width: 350px; height: 350px;"></div>

</div>
<script>
var markerOrigen;   //variable del marcador
var markerDestino;  //variable del marcador
var map;
var coords = {};    //coordenadas obtenidas con la geolocalización
var directionsDisplay;
var directionsService;
//Funcion principal
initMap = function () 
{
navigator.geolocation.getCurrentPosition(function (position){
            coords =  {
              lng: position.coords.longitude,
              lat: position.coords.latitude
            };
            console.log(coords);
            setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
            document.getElementById('latitudOrigen').value=coords.lat;
            document.getElementById('longitudOrigen').value=coords.lng;
           	document.getElementById('latitudDestino').value=-17.800351; 
           	document.getElementById('longitudDestino').value=-63.198391;
          }, function(error){
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("permiso denegado");
            break;
        case error.POSITION_UNAVAILABLE:
            // La ubicación no está disponible.
            break;
        case error.TIMEOUT:
            // Se ha excedido el tiempo para obtener la ubicación.
            break;
        case error.UNKNOWN_ERROR:
            // Un error desconocido.
            break;
    }
});

    
}



function setMapa (coords)
{   
      directionsDisplay = new google.maps.DirectionsRenderer();
      //Se crea una nueva instancia del objeto mapa
      map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 13,
        center:new google.maps.LatLng(coords.lat,coords.lng),

      });
    
      directionsDisplay.setMap(map);
      //Creamos el marcador en el mapa con sus propiedades
      //para nuestro obetivo tenemos que poner el atributo draggable en true
      //position pondremos las mismas coordenas que obtuvimos en la geolocalización
      markerOrigen = new google.maps.Marker({
        map: map,
        draggable: false,
        title: 'Tu ubicacion actual',
        position: new google.maps.LatLng(coords.lat,coords.lng),

      });

      markerDestino = new google.maps.Marker({
        map: map,
        draggable: false,
        title: 'Clinica dental CENTRAL DENT',
        position: new google.maps.LatLng(-17.800351,-63.198391),

      });
  	setTimeout(function(){ createRute(); }, 3000);

}



function createRute(){
	markerOrigen.setMap(null);
	markerDestino.setMap(null);
    var request = {
    origin: document.getElementById("latitudOrigen").value+','+document.getElementById("longitudOrigen").value,
    destination: document.getElementById("latitudDestino").value+','+document.getElementById("longitudDestino").value,
    travelMode: 'DRIVING'
  };
  directionsService = new google.maps.DirectionsService();
  directionsService.route(request, function(result, status) {
    if (status == 'OK') {
      directionsDisplay.setDirections(result);
    }
    console.log(result);
    console.log(status);
  });
}


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjdMOrxzeavM10XqfyrPB21N5kZAoKQQk&callback=initMap"></script>
<script src="Public/js/jquery-3.3.1.min.js"></script>
<script src="Public/js/bootstrap.min.js"></script>
</body>
</html>
			