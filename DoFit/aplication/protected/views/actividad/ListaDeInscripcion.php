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

<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href='../site/index'><img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="navbar-form navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="active"><a>Hola!  <?php echo $ficha->nombre."&nbsp".$ficha->apellido; ?></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuraci�n <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Anotarme en actividades</a></li>
                                    <li><a href="#">Ver mis actividades</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Privacidad</li>
                                    <li><a href="#">Configuraci�n</a></li>
                                    <li><a href="#"><?php echo CHtml::link('Salir', array('site/logout')); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Carousel
================================================== -->

<div id="myCarousel" class="carousel_min slide" data-ride="carousel">
    <div class="carousel-inner_min" role="listbox">
        <div class="item active">
            <img class="first-slide_min" src="<?php echo Yii::app()->request->baseUrl; ?>/img/16.jpg" alt="First slide">
        </div>
    </div>
</div>

<div class="container">
    <div class="form-group">
    <?php
        echo    "<div><h2>Deportes</h2></div>";
        $cant = 0;
        if($list != null) {
            $actividad_ant = 0;
            foreach($list as $gim){
                $actividad = $gim['id_actividad'];
                if($cant = 0){
                    $actividad_ant = $gim['id_actividad'];
                    $cant = 1;
                    echo "<button type='submit' onclick='Anotarme();' value='".$actividad."' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'>
                            Anotarme
                          </button>";
                    echo "<input type='hidden' name='actividad' id='actividad' value='".$actividad."'/>'";
                    echo "Gimnasio: ".$gim['nombre'];
                    echo "Dirección: ".$gim['direccion'];
                    echo "Telefono: ".$gim['telfijo'];
                    echo "Dia: ".$gim['id_dia'];
                    echo "Horario: ".$gim['hora'].':'.$gim['minutos'];
                    echo $actividad;
                }
                else{
                    if($gim['id_actividad']== $actividad_ant){
                        echo "Dia: ".$gim['id_dia'];
                        echo "Horario: ".$gim['hora'].':'.$gim['minutos'];
                        $actividad_ant = $gim['id_actividad'];
                    }
                    else{
                        echo "<br>";
                        echo "<button type='submit' onclick='Anotarme(this.value);' value='".$actividad."' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'>
                            Anotarme
                          </button>";
                        echo "Gimnasio: ".$gim['nombre'];
                        echo "Dirección: ".$gim['direccion'];
                        echo "Telefono: ".$gim['telfijo'];
                        echo "Dia: ".$gim['id_dia'];
                        echo "Horario: ".$gim['hora'].':'.$gim['minutos'];
                        $actividad_ant = $gim['id_actividad'];
                        echo "<input type='hidden' id='actividad' name='actividad' value='".$actividad."'/>'";
                        echo $actividad;

                    }
                }
                echo "</form>";


             }
         }
        else{
            echo "nada";
        }
    ?>
        <!-- Modal -->

    </div>
</div>

<script type="text/javascript">


    function Anotarme(value){

        var actividad = $("#submit").value;
        alert(value); }

                    //var data = {'deporte': deporte, 'provincia': provincia, 'localidad': localidad};
                    /* $.ajax({
                        url: baseurl + '/actividad/InscripcionActividad',
                        type: "POST",
                        data: data,
                        dataType: "html",
                        cache: false,
                        success: function (response) {
                            if (response == "error") { */


</script>