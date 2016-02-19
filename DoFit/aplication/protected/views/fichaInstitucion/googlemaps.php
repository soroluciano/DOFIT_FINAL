<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <link href="css/screen.css" rel="stylesheet" type ="text/css" />
    <script type="text/javascript">
        function initialize(address) {
            var geoCoder = new google.maps.Geocoder(address)
            var request = {address:address};
            geoCoder.geocode(request, function(result, status){
                var latlng = new google.maps.LatLng(result[0].geometry.location.lat(), result[0].geometry.location.lng());
                var myOptions = {
                    zoom: 15,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
                var marker = new google.maps.Marker({position:latlng,map:map,title:'title'});
            })
        }
    </script>

    <script>

        function mostrarDireccion(val){
            initialize($('#address').val());

        }
    </script>
    <style type="text/css">
        html { height: 100% }
        body { height: 100%; margin: 0px; padding: 0px;}
        #map_canvas {
            width:529px;
            height:400px;
        }
        .box{
            width:529px;
            height:400px;
            padding:10px;
        }
        .search input[type=text]{
            float:left;
            width:460px;
            padding:8px;
            border:1px solid #4B8EFA;
        }
        .search input[type=button]{
            margin-top: 7px;
            float:right;
            background-color:#4B8EFA;
            border:0;
            display:block;
            color:white;
            padding:8px;
            cursor: pointer;
        }
        h1{
            text-align: center;
            font-family: cursive;
            margin-top:15px;
            font-size: 45px;
        }
        h2{
            margin-top:15px;
        }
    </style>
    <?php
    $nombre = $_GET["nombre"];
    $direccion = $_GET["direccion"];
    $localidad = $_GET["localidad"];
    $provincia = $_GET["provincia"];
    $locali = str_replace("%20"," ",$localidad);
    $direcc = str_replace("%20"," ",$direccion);
    $provin = str_replace("%20"," ",$provincia);
    $lugargimnasio = $direcc.", ".$localidad.", ".$provin;

    ?>
    <title>jQueryLoad.com</title>
</head>
<body onload="mostrarDireccion(this.value)">
<div class='modal fade' id='googlemaps' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4> Ubicaci&oacute;n de <?php echo $nombre ?></h4>
            </div>
            <div class='modal-body'>
                <input type="hidden" id="address" value="<?php echo $lugargimnasio;?>"  placeholder="Ingrese su direccion"/>
                <div id="map_canvas"></div>
            </div>
			<div class='modal-footer'>
                <button type='button' class='btn btn-primary' data-dismiss='modal' onclick="window.close();">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#googlemaps").modal('show');
    });
</script>	