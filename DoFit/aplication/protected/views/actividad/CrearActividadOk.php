
<style type="text/css">
    body {
        background: url(../img/23.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>


<div class='modal fade' id='ModalVentana' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <?php  $this->renderPartial('../menu/_menuInstitucion'); ?>
    <br>
    <br>
    <br>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>¡Felicitaciones!</h4>
            </div>
            <div class='modal-body'>
                <p>Has creado correctamente la actividad.</p>
            </div>
            <div class='modal-footer'>
                <a href="CrearActividad" class='btn btn-primary' >Cerrar</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#principal').modal('show');
        $('#ModalVentana').modal('show');
    });

</script>