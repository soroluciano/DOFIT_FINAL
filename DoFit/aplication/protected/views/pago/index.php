<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->renderPartial('../menu/_menuInstitucion');
?>

<style type="text/css">
    body {
        background: url(../img/36.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }


</style>
<br>
<br>
<br>
<br>
<br>
<div class="container marketing">
    <!-- Three columns of text below the carousel -->
    <div class="modal-dialog modal-lg" style="margin-top:140px;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-lg-4">
                        <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/1.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2><a href="../pago/CrearPago" class="btn btn-primary">Crear Pago</a></h2>
                        <p>Generá los pagos de tus clientes</a></p>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2><a href="../pago/EliminarPago" class="btn btn-primary">Eliminar Pago</a></h2>
                        <p>Eliminá pagos</p>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/3.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2><a href="../pago/ListaPagos" class="btn btn-primary">Consultar Pagos</a></h2>
                        <p>Consulta los pagos de tus clientes</p>
                    </div>
                </div>
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