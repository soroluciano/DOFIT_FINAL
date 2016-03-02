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

    public function actionFactura(){
        $factura = new FacturaService();
        $factura->GenerarFactura($_GET['idactividad'],$_GET['idusuario'],$_GET['anio'],$_GET['mes']);

    }

    public function actionVerificarExistencia()
    {
        $usuario = Yii::app()->user->id;
        $actividad = Actividad::model()->findAll('id_institucion = :id_institucion',array(':id_institucion'=>$usuario));
        if($actividad == null){
            echo "error_act";
        }
        else{
            $list = Yii::app()->db->createCommand('select 1 from dual where ((select count(*) from actividad where id_actividad in ( select id_actividad from actividad_alumno )and id_institucion = '.$usuario.' )= ( select count(*) from actividad where id_institucion = '.$usuario.') or ((select count(*) from actividad where id_actividad in ( select id_actividad from actividad_alumno )and id_institucion = '.$usuario.' ) > 0))')->queryAll();
            if($list){
                echo "ok";
            }
            else{
                echo "error_alum";
            }
        }

    }

    public function actionVerificarQueExistanPagos()
    {
        $usuario = Yii::app()->user->id;
        $list = Yii::app()->db->createCommand('select 1 from pago where id_actividad in (select id_actividad from actividad where id_institucion = '.$usuario.')')->queryAll();
        if($list){
            echo "ok";
        }
        else{
            echo "error";
        }
    }
    public function actionListaPagos()
    {
        $fu = new FichaUsuario();
        $ac = new Actividad();
        $pa = new Pago();
        $this->render('ListaPagos', array('ficha_usuario' => $fu, 'actividad' => $ac, 'pago' => $pa));
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
        if(isset($_POST['valor'])){
            $actividad = Actividad::model()->findByPk($_POST['valor']);
            $actividad_horario = ActividadHorario::model()->findAll('id_actividad = :id_actividad',array(':id_actividad'=>$actividad->id_actividad));
            $var = '';
            foreach($actividad_horario as $ah){
                if($ah->id_dia == 1){$dia = "Lunes";};
                if($ah->id_dia == 2){$dia = "Martes";};
                if($ah->id_dia == 3){$dia = "Miercoles";};
                if($ah->id_dia == 4){$dia = "Jueves";};
                if($ah->id_dia == 5){$dia = "Viernes";};
                if($ah->id_dia == 6){$dia = "Sabado";};
                if($ah->id_dia == 7){$dia = "Domingo";};

                $var = $var . '<b>Dia: </b>'.$dia.'&nbsp'.'<b>Horario: </b>'.str_pad($ah->hora,2,'0',STR_PAD_LEFT).':'.str_pad($ah->minutos,2,'0',STR_PAD_LEFT).'&nbsp';
            }
            $var = $var . '|' . $actividad->valor_actividad;

            echo $var;

        }

    }

    public function actionEliminar(){
        IF(isset($_POST['usuario']) && isset($_POST['anio']) && isset($_POST['mes']) && isset($_POST['id'])){
            $pagos = Pago::model()->findByPk(array('id_actividad'=>$_POST['id'],'id_usuario' => $_POST['usuario'], 'anio' => $_POST['anio'], 'mes' => $_POST['mes']));
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

                    $horario = $horario . " <b>Dia:</b> ".$dia . " <b>Horario:</b> ".str_pad($ah->hora,2,'0',STR_PAD_LEFT).":" .str_pad($ah->minutos,2,'0',STR_PAD_LEFT).'<br>';
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
                    'actividad' => '<b>Deporte:</b>'.$deporte->deporte.'<br> '.$horario,
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
            $suma = 0;
            $criteria = new CDbCriteria;
            $criteria->condition = 'id_usuario = :id_usuario and id_actividad = :id_actividad and anio = :anio and mes = :meses';
            $criteria->params = array(':id_usuario' => $_POST['id_usuario'], ':id_actividad' => $_POST['actividad'], ':anio'=> $_POST['anio'], ':meses'=> $_POST['meses']);
            $Actividad = Pago:: model()->findAll($criteria);
            $valoractividad = Actividad::model()->findByAttributes(array('id_actividad'=>$_POST['actividad']));
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
        $id_institucion = Yii::app()->user->id;
        $acti = ActividadAlumno::model()->findAll('id_usuario= :id_usuario', array(':id_usuario' => $id_usuario));
        echo CHtml::tag('option', array('value' => ''), 'Seleccione una actividad', true);
        foreach($acti as $act){
            if($acti != null){
                $actividades = Actividad::model()->findAllByAttributes(array('id_institucion'=>$id_institucion,'id_actividad'=>$act->id_actividad));
                //$actividadeselec = CHtml::listData($actividades, 'id_actividad', 'id_actividad');
                foreach ($actividades as $act) {
                    $deporte = Deporte::model()->findByAttributes(array('id_deporte'=>$act->id_deporte));
                    echo CHtml::tag('option', array('value' => $act->id_actividad), CHtml::encode($deporte->deporte), true);
                }
            }
        }
    }

    public function actionSeleccionarAño()
    {

        $id_usuario = $_POST['FichaUsuario']['id_usuario'];
        $pagos = Pago::model()->findAll('id_usuario= :id_usuario', array(':id_usuario' => $id_usuario));
        $pagos = CHtml::listData($pagos, 'anio', 'anio');

        echo CHtml::tag('option', array('value' => ''), 'Seleccione el año', true);


        foreach ($pagos as $valor => $p) {

            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($p), true);
        }


    }

    public function actionSeleccionarMes()
    {
        $id_usuario = $_POST['FichaUsuario']['id_usuario'];
        $anio = $_POST['Pago']['anio'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'id_usuario = :id_usuario and  anio = :anio';
        $criteria->params = array(':id_usuario' => $id_usuario, ':anio'=> $anio);
        $pagos = Pago:: model()->findAll($criteria);
        $pagos = CHtml::listData($pagos, 'mes', 'mes');

        echo CHtml::tag('option', array('value' => ''), 'Seleccione el mes', true);

        foreach ($pagos as $valor => $p) {

            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($p), true);
        }


    }

    public function actionConsultarPagosAlumno()
    {
        $id_usuario = Yii::app()->user->id;
		if(isset(Yii::app()->session['id_usuario'])){
            $instituciones = Yii::app()->db->createCommand('select id_institucion,nombre from ficha_institucion WHERE id_institucion IN(SELECT id_institucion from actividad where id_actividad IN(SELECT id_actividad from actividad_alumno WHERE id_actividad IN (SELECT id_actividad FROM pago WHERE id_usuario = '.$id_usuario.' )))')->queryAll();
            $anio = Yii::app()->db->createCommand('select distinct anio from pago where id_usuario ='. $id_usuario)->queryAll();
			$meses = Yii::app()->db->createCommand('select distinct mes from pago where id_usuario ='. $id_usuario)->queryAll();
			$this->render('Consultarpagosalumno',array('instituciones'=>$instituciones,'anio'=>$anio,'meses'=>$meses));            					
        }	
    }

    public function actionMostrarPagosAlumno()
    {
        $id_institucion = $_POST['idinstitucion'];
        $mes = $_POST['mes'];
        $anio = $_POST['anio'];
        $fic_ins = FichaInstitucion::model()->findByAttributes(array('id_institucion'=>$id_institucion));
        $id_usuario = Yii::app()->user->id;
        $cant_pago = 0;
        // Busco todas las actividades que tenga esa institucion donde esta inscripto el alumno
        $actividad_alumno = Yii::app()->db->createCommand('SELECT * FROM actividad_alumno WHERE id_usuario = '.$id_usuario .' AND id_actividad IN(SELECT id_actividad FROM actividad where id_institucion = '.$id_institucion.')')->queryAll();
		foreach($actividad_alumno as $act_alum){
            $pago = Pago::model()->findByAttributes(array('id_actividad'=>$act_alum['id_actividad'],'mes'=>$mes,'anio'=>$anio,'id_usuario'=>$id_usuario));
            if($pago != null){
                $cant_pago++;
            }
        }
        if($cant_pago > 0){
            echo "<table id='lispagos' class='display' cellspacing='0' width='100%'>
			          <thead>
                      <th>Deporte</th><th>Días y Horarios</th><th>Monto</th><th>Ver Factura</th>
				      </thead>
					   <tbody>";
            foreach($actividad_alumno as $act_alum){
                $pago = Pago::model()->findByAttributes(array('id_actividad'=>$act_alum['id_actividad'],'mes'=>$mes,'anio'=>$anio,'id_usuario'=>$id_usuario));
                if($pago != NULL){
                    $act = Actividad::model()->findByAttributes(array('id_actividad'=>$act_alum['id_actividad']));
                    $dep = Deporte::model()->findByAttributes(array('id_deporte'=>$act->id_deporte));
                    echo "<tr>
                            <td id='deporte'>" .$dep->deporte . "</td>";
                    $diashorarios = ActividadHorario::model()->findAllByAttributes(array('id_actividad'=>$act->id_actividad));
                    echo "<td id='dias y horarios'>";
                    foreach($diashorarios as $diashor){
                        $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
                        $id_dia = $diashor->id_dia-1;
                        echo $dias[$id_dia]."&nbsp;".$diashor->hora .':'.($diashor->minutos == '0' ? '0'.$diashor->minutos : $diashor->minutos)."&nbsp&nbsp";
                    }
                    echo "</td>";
                    echo "<td id='importe'>$ ".$pago->monto."</td>";
                    echo "<td><input type='button' id='factura' class='btn btn-primary' value='Ver Factura' onclick='ver_factura($act->id_actividad, $id_usuario, $pago->mes, $pago->anio);'></input>"; 
                    echo "</tr>";
                }
            }
            echo "</tbody>
			      </table>";
            echo "<script type='text/javascript'>
                $('#lispagos').DataTable( {
		            'language' : {
			            'sProcessing':     'Procesando...',
			            'sLengthMenu':     'Mostrar _MENU_ registros',
			            'sZeroRecords':    'No se encontraron resultados',
			            'sEmptyTable':     'Ningún dato disponible en esta tabla',
			            'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
			            'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
			            'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
			            'sInfoPostFix':    '',
			            'sSearch':         'Buscar:',
			            'sUrl':            '',
			            'sInfoThousands':  ',',
			            'sLoadingRecords': 'Cargando...',

			            'oPaginate': {
				            'sFirst':    'Primero',
				            'sLast':     'Ultimo',
				            'sNext':     'Siguiente',
				            'sPrevious': 'Anterior'
			            },
			                
			            'oAria': {
				            'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
				            'sSortDescending': ': Activar para ordenar la columna de manera descendente'
			            }
		            }
	            } );
            </script>";
            echo "|$fic_ins->nombre";

        }
        if($cant_pago == 0){
            echo "errorpago|$fic_ins->nombre";
        }
    }
}

