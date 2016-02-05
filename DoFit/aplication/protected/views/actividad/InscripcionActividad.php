<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/carrousel.css" rel="stylesheet">

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if(!Yii::app()->user->isGuest){
    //Es un usuario logueado.
    $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
    $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
}
?>

</div>
<style type="text/css">
    body {
        height:0px;
    }
</style>
<?php $this->renderPartial('../menu/_menu');?>

<!--<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner"> solo comentado borrar todo si quedo bien
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../"><img class="navbar-brand-img" src="<?php //echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide"></a>
            <a href="../" class="navbar-brand"></a>
        </div>
        <nav id="bs-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="">Bienvenido! Rabufeti</a></li>
                <li><?php //echo CHtml::link('Salir', array('site/logout')); ?></li>
            </ul>
        </nav>
    </div>
</header>
<div id="map"  style="width: 100%; height: 740px; z-index:-1; position:absolute;">
</div>
<br>
<br>
<br>
<br>
<br>-->
<div id="map"  style="width: 100%; height: 740px; z-index:-1; position:absolute;">
</div>
<br>
<br>
<br>
<br>
<div class="container" style="z-index:300; width:300px; margin-left:13%;">
    <form class="form" method="post" action="ListaDeInscripcion" >
        <?php $form=$this->beginWidget('CActiveForm', array('id'=>'actividad-form', 'enableAjaxValidation'=>false, 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true,),));?>
        <div class="col-md-12">
            <?php echo CHtml::beginForm('InscripcionActividad','post'); ?>
            <br>
            <div class="form-group">
                <?php echo $form->dropDownList($deportes,'id_deporte',CHtml::listData(Deporte::model()->findAll(),'id_deporte','deporte'),array('empty'=>'Seleccione el deporte','class'=>"form-control","onchange"=>"BuscadorGimnasios();","id"=>"ListaDeporte","name"=>"deporte"));?>
                <?php echo $form->error($deportes,'deporte')?>
            </div>
            <br>
            <div class="form-group">
                <?php echo $form->dropDownList($localidad,'id_provincia',CHtml::listData(Provincia::model()->findAll(),'id_provincia','provincia'),
                    array('ajax'=>array('type'=>'POST',
                        'url'=>CController::createUrl('Usuario/SeleccionarLocalidad'),
                        'update'=>'#'.CHtml::activeId($localidad,'id_localidad'),
                    ),'prompt'=>'Seleccione una Provincia','class'=>"form-control","onchange"=>"BuscadorGimnasios();"));?>
                <?php echo $form->error($localidad,'id_provincia'); ?>
            </div>
            <br>
            <div class="form-group">
                <div>
                    <?php echo $form->dropDownList($localidad,'id_localidad',array(''=>"Selecciona tu localidad"),array('class'=>"form-control","onchange"=>"BuscadorGimnasios();")); ?>
                </div>
                <?php echo $form->error($localidad,'id_localidad'); ?>
                <br>
                <br>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="boton" style="display:none" value="Seguir con la inscripción"/>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Lo sentimos :( </h4>
                            </div>
                            <div class="modal-body">
                                ¡No encontramos resultados para tu búsqueda!
                                Intentá de nuevo
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
<?php echo CHtml::endForm(); ?>
<?php $this->endWidget(); ?>

<script 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDGuKpwaC15M3ivyOjCgU6_yvwpI8UWWE&callback=initMap">
</script>

<script type="text/javascript">
    $(function(){
        $("#map").show();
        var map;
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.382365, lng: -64.315731},
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    });
</script>


<script type="text/javascript">
    function BuscadorGimnasios(){
        var deporte = $("#ListaDeporte").val();
        var localidad = $("#Localidad_id_localidad").val();
        var provincia = $("#Localidad_id_provincia").val();
        $("#boton").hide();
        if(deporte != ""){
            if(provincia != ""){
                if(localidad != ""){
                    var data = {'deporte': deporte, 'provincia': provincia, 'localidad': localidad};
                    $.ajax({
                        url: baseurl + '/actividad/InscripcionActividad',
                        type: "POST",
                        data: data,
                        dataType: "html",
                        cache: false,
                        success: function (response) {
                            if (response == "error") {
                                $('#myModal').modal('show');
                            }
                            else {
                                debugger;
                                $("#map").show();
                                alert(response);

                                //var locations = JSON.stringify( "[" + response + "]" );
                                locations = JSON.parse("["+response+"]");
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 13,
                                    center: new google.maps.LatLng(locations[0][1], locations[0][2] ),
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                });

                                var infowindow = new google.maps.InfoWindow();

                                var marker, i;

                                for (i = 0; i < locations.length; i++) {
                                    marker = new google.maps.Marker({
                                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                        map: map,
                                        animation: google.maps.Animation.BOUNCE


                                    });

                                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                        return function() {
                                            infowindow.setContent(locations[i][0]);
                                            infowindow.open(map, marker);
                                        }
                                    })(marker, i));

                                }
                                $("#boton").show();
                            }

                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                }
            }
        }


    }


</script>