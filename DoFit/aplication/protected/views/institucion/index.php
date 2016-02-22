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
                    <img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide">
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="navbar-form navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="active"><a>Hola! Administrador</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuración <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../site/indexAdmin">Home</a></li>
                                    <li><a href="../deporte/index">ABM Deportes</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?php echo CHtml::link('Salir', array('site/logout')); ?></li>
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
            <img class="first-slide_min" src="<?php echo Yii::app()->request->baseUrl; ?>/img/10.jpg" alt="First slide">
        </div>
    </div>
</div>

<div class="container">
    <?php
        echo  "<div><h2>Gimnasios</h2></div>";
        echo    "<table class='table table-hover'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>.</th>
                                <th>.</th>
                            </tr>
                        </thead>";
        echo "<tbody>";
                    if($institucion != null) {
                        foreach ($institucion as $d) {
                            echo "<tr>
                                    <td>$d->id_institucion</td>
                                    <td>$d->email</td>
                                    <td><a href='../institucion/update/$d->id_institucion' class='btn btn-default'>Modificar<a/></td>
                                  <tr>";
                        }
                    }
                    else {
                        echo "<td>No hay gimnasios creados aún</td>";
                    }
        echo "</tbody></table>";
    ?>
    <a href="../institucion/create" class="btn btn-primary btn-lg">
        Crear institución
    </a>
    <br>
    <br>
    <br>
    <div class="form-group">
        <a href="../site/indexAdmin">Volver</a>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <p>
            &copy; 2015 DoFit.
            &middot;
            <a href="#">Privacidad</a>
            &middot;
            <a href="#">Terminos</a>
        </p>
    </div>
</footer>
