<?php

class PagoController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionEliminarPago()
    {
        $fu = new FichaUsuario();
        $ac = new Actividad();
        $pa = new Pago();
        $this->render('EliminarPago', array('ficha_usuario' => $fu, 'actividad' => $ac, 'pago' => $pa));
    }

    public function actionVerificarActividad()
    {
        $var = "";
        $dia = "";
        IF(isset($_POST['valor'])){
            $actividad = Actividad::model()->findByPk($_POST['valor']);
            $id_deporte = $actividad->id_deporte;
            $deporte = Deporte::model()->findByPk($id_deporte);
            $actividad_horario = ActividadHorario::model()->findAll('id_actividad = :id',array(':id'=>126));
            $var = 'Deporte: '.$deporte->deporte.' ';
            foreach($actividad_horario as $ah){
                if($ah->id_dia == 1){$dia = "Lunes";};
                if($ah->id_dia == 2){$dia = "Martes";};
                if($ah->id_dia == 3){$dia = "Miercoles";};
                if($ah->id_dia == 4){$dia = "Jueves";};
                if($ah->id_dia == 5){$dia = "Viernes";};
                if($ah->id_dia == 6){$dia = "Sabado";};
                if($ah->id_dia == 7){$dia = "Domingo";};

                $var = $var . ' Dia: '.$dia. ' Horario: '.str_pad($ah->hora,2,'0',STR_PAD_LEFT).':'.str_pad($ah->minutos,2,'0',STR_PAD_LEFT);
            }
            echo $var;

        }

    }

    public function actionEliminar(){
        IF(isset($_POST['usuario']) && isset($_POST['anio']) && isset($_POST['mes']) && isset($_POST['id'])){
            $pagos = Pago::model()->findByPk(array('id_actividad'=>126,'id_usuario' => $_POST['usuario'], 'anio' => $_POST['anio'], 'mes' => $_POST['mes']));
            if($pagos->delete()){
                echo "ok";
            }
            else {
                echo "error";
            }
        }
    }

    public function actionListarPagos(){
        IF(isset($_POST['usuario'])&& isset($_POST['anio'])){
            $criteria = new CDbCriteria;
            $criteria->condition = 'id_usuario = :id and anio = :anio and mes = :mes';
            $criteria->params = array(':id' => $_POST['usuario'], ':anio' => $_POST['anio'], ':mes' => $_POST['mes']);
            $pagos = Pago::model()->findAll($criteria);
            $result = array();

            foreach($pagos as $p) {
                $horario = "";
                $dia = "";
                $mes = "";
                $actividad = Actividad::model()->findByPk($p->id_actividad);
                $deporte = Deporte::model()->findByPk($actividad->id_deporte);
                $actividad_horario = ActividadHorario::model()->findAll('id_actividad = :id',array(':id'=>$p->id_actividad));

                foreach($actividad_horario as $ah){
                    if($ah->id_dia == 1){$dia = "Lunes";};
                    if($ah->id_dia == 2){$dia = "Martes";};
                    if($ah->id_dia == 3){$dia = "Miercoles";};
                    if($ah->id_dia == 4){$dia = "Jueves";};
                    if($ah->id_dia == 5){$dia = "Viernes";};
                    if($ah->id_dia == 6){$dia = "Sabado";};
                    if($ah->id_dia == 7){$dia = "Domingo";};

                    $horario = $horario . "Dia: ".$dia . " Horario: ".str_pad($ah->hora,2,'0',STR_PAD_LEFT).":" .str_pad($ah->minutos,2,'0',STR_PAD_LEFT);
                }

                if($p->mes == 1){$mes = "Enero";}
                if($p->mes == 2){$mes = "Febrero";}
                if($p->mes == 3){$mes = "Marzo";}
                if($p->mes == 4){$mes = "Abril";}
                if($p->mes == 5){$mes = "Mayo";}
                if($p->mes == 6){$mes = "Junio";}
                if($p->mes == 7){$mes = "Julio";}
                if($p->mes == 8){$mes = "Agosto";}
                if($p->mes == 9){$mes = "Septiembre";}
                if($p->mes == 10){$mes = "Octubre";}
                if($p->mes == 11){$mes = "Noviembre";}
                if($p->mes == 12){$mes = "Diciembre";}

                $result[] = array(
                    'usuario' => $p->id_usuario,
                    'actividad' => 'Deporte: '.$deporte->deporte.' '.$horario,
                    'anio' => $p->anio,
                    'mes' => $mes,
                    'monto' => "$".$p->monto,
                    'id'=> $p->id_actividad,
                    'm'=> $p->mes,
                );
            }
            echo CJSON::encode($result);
        }
    }

    public function actionCrearPago()
    {
        $fu = new FichaUsuario();
        $ac = new Actividad();
        $pa = new Pago();

        IF(isset($_POST['id_usuario']) && isset($_POST['actividad']) && isset($_POST['anio']) && isset($_POST['meses'])){
            $pa->anio = $_POST['anio'];
            $pa->cusuario = 'sysadmin';
            $pa->id_usuario = $_POST['id_usuario'];
            $pa->id_actividad = $_POST['actividad'];
            $pa->fhcreacion =  new CDbExpression('NOW()');
            $pa->fhultmod =  new CDbExpression('NOW()');
            $pa->mes = $_POST['meses'];
            $pa->monto = $_POST['monto'];

            $criteria = new CDbCriteria;
            $criteria->condition = 'id_usuario = :id_usuario and id_actividad = :id_actividad and anio = :anio and mes = :meses';
            $criteria->params = array(':id_usuario' => $_POST['id_usuario'], ':id_actividad' => $_POST['actividad'], ':anio'=> $_POST['anio'], ':meses'=> $_POST['meses']);
            $Actividad = Pago:: model()->findAll($criteria);

            if($Actividad != null){
                echo "duplicado";
            }
            else{
                if($pa->save()){
                    echo "ok";
                }
                else{
                    echo "error";
                }

            }


        }
        else{
            $this->render('CrearPago', array('ficha_usuario' => $fu, 'actividad' => $ac, 'pago' => $pa));
        }


    }

    public function actionSeleccionarActividad()
    {

        $id_usuario = $_POST['FichaUsuario']['id_usuario'];
        $actividades = ActividadAlumno::model()->findAll('id_usuario= :id_usuario', array(':id_usuario' => $id_usuario));
        $actividades = CHtml::listData($actividades, 'id_actividad', 'id_actividad');

        echo CHtml::tag('option', array('value' => ''), 'Seleccione una actividad', true);

        foreach ($actividades as $valor => $act) {

            echo CHtml::tag('option', array('value' => $valor), 'Actividad número: '.CHtml::encode($act), true);
        }


    }

    public function actionSeleccionarPago()
    {

        $id_usuario = $_POST['FichaUsuario']['id_usuario'];
        $pagos = Pago::model()->findAll('id_usuario= :id_usuario', array(':id_usuario' => $id_usuario));
        $pagos = CHtml::listData($pagos, 'id_pago', 'id_pago');

        echo CHtml::tag('option', array('value' => ''), 'Seleccione el pago', true);


        foreach ($pagos as $valor => $p) {

            echo CHtml::tag('option', array('value' => $valor), 'Pago número: '.CHtml::encode($p), true);
        }


    }


}

