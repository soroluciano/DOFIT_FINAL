<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
if(!Yii::app()->user->isGuest){
    //Es un usuario logueado.
    $usuarioins = Institucion::model()->findByPk(Yii::app()->user->id);
}

?>

<style type="text/css">
    body {
        background: url(../img/24.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>


<div class="modal fade" tabindex="-1" role="dialog" id="principal" aria-labelledby="myModalLabel">
    <?php  $this->renderPartial('../menu/_menuInstitucion'); ?>
    <br>
    <br>
    <br>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eliminar Actividad</h4>
            </div>
            <div class="container">
                <div class="form">
                    <div class="col-md-6">
                        <br>
                        <div class="form-group">
                            <?php
                            $query = "select actividad.id_actividad, concat(ficha_usuario.nombre,' ',ficha_usuario.apellido) profesor, deporte.deporte from actividad, ficha_usuario, deporte where actividad.id_usuario = ficha_usuario.id_usuario and actividad.id_deporte = deporte.id_deporte and actividad.id_institucion = ".Yii::app()->user->id;
                            $listaActividades = Yii::app()->db->createCommand($query)->queryAll();
                            $respuesta=" <select class='form-control' style='margin-top:5px;' id='actividades' name='options'>
                                         <option id='0'>Selecciona actividad</option>";
                            foreach($listaActividades as $act ){
                                $query_horario = "select CASE id_dia WHEN 1 THEN 'Lunes' WHEN 2 THEN 'Martes' WHEN 3 THEN 'Miercoles' WHEN 4 THEN 'Jueves' WHEN 5 THEN 'Viernes' WHEN 6 THEN 'Sabado' WHEN 7 THEN 'Domingo' END dia,concat(lpad(hora,2,'0'),':',lpad(minutos,2,'0'))horario from actividad_horario where id_actividad = ".$act['id_actividad'];
                                $horario = Yii::app()->db->createCommand($query_horario)->queryAll();
                                $hora = "";
                                foreach($horario as $h) {
                                    $hora = $hora . ' - '.$h['dia'].' - '.$h['horario'];
                                }
                                $respuesta.="<option id='".$act['id_actividad']."'><a href='#'>".$act['profesor']." - ".$act['deporte'].$hora."</a></option>";
                            }
                            $respuesta.="</select>";
                            echo $respuesta;
                            ?>
                            <br>
                            <button  onclick='Eliminar();' class='btn btn-primary' id='boton'>Eliminar Actividad</button>
                            <a href="index" class="btn btn-primary">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='error' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>¡Oops!</h4>
            </div>
            <div class='modal-body' id="modal-error">
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal OK -->
<div class='modal fade' id='Ok' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>Felicidades</h4>
            </div>
            <div class='modal-body'>
                ¡Has eliminado la actividad correctamente!
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error -->
<div class='modal fade' id='Error' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>¡Error!</h4>
            </div>
            <div class='modal-body'>
                No se ha podido eliminar la actividad :(
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#principal').modal({
           backdrop: 'static',
           keyboard: false
		});
		$('#principal').modal('show');
    })
</script>

<script type="text/javascript">
    function Eliminar(){
        var actividad = $('#actividades option:selected').attr("id");
        if(actividad != 0){
            var data = {'actividad': actividad};
            $.ajax({
                url: '../actividad/Eliminar',
                type: 'POST',
                data: data,
                dataType: "html",
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        $("#actividades").find('option:selected').removeAttr("selected");
                        $('#Ok').modal('show');

                    }
                    else {
                        $('#Error').modal('show');
                    }
                }})}
        else{
            $('#modal-error').html("¡Debe seleccionar al menos una actividad!");
            $('#error').modal('show');
        }
    }
</script>