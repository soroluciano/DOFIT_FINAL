<?php

class ActividadController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCrearActividad()
    {

        $usuarioins = Institucion::model()->findByPk(Yii::app()->user->id);
        $actividad = new Actividad;
        $deporte = new Deporte;
        $ficha_usuario = new FichaUsuario;
        $actividad_horario = new ActividadHorario;


        if (isset($_POST['Actividad'])) {

            $actividad->attributes = $_POST['Actividad'];
            $actividad->id_institucion = $usuarioins->id_institucion;
            $actividad->fhcreacion = new CDbExpression('NOW()');
            $actividad->fhultmod = new CDbExpression('NOW()');
            $actividad->cusuario = $usuarioins->email;
            $actividades = 0;
            if ($actividad->save()) {
                $cant = count($_POST['dia']);
                for ($i = 0; $i <= $cant - 1; $i++) {

                    $actividad_horario = new ActividadHorario;
                    $actividad_horario->id_actividad = $actividad->id_actividad;
                    $actividad_horario->id_dia = $_POST['dia'][$i];
                    $actividad_horario->hora = $_POST['hora'][$actividad_horario->id_dia - 1];
                    $actividad_horario->minutos = $_POST['minutos'][$actividad_horario->id_dia - 1];
                    $actividad_horario->fhcreacion = new CDbExpression('NOW()');
                    $actividad_horario->fhultmod = new CDbExpression('NOW()');
                    $actividad_horario->cusuario = $usuarioins->email;
                    if ($actividad_horario->save()) {
                        $actividades++;
                    }
                }
                if ($actividades = $cant) {
                    $this->redirect('CrearActividadOk');

                }
            }
        }

        $this->render('CrearActividad', array('deporte' => $deporte, 'actividad' => $actividad, 'actividad_horario' => $actividad_horario, 'ficha_usuario' => $ficha_usuario));
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Actividad'])) {
            $model->attributes = $_POST['Actividad'];
            if ($model->save()){
                $this->redirect(array('view', 'id' => $model->id_actividad));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {

        $this->render('index');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Actividad('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Actividad']))
            $model->attributes = $_GET['Actividad'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Actividad the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Actividad::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionInscripcion()
    {
        if(isset($_POST['usuario']) && isset($_POST['actividad'])){
            $act_alum = new actividadAlumno();
            $act_alum->id_usuario = $_POST['usuario'];
            $act_alum->id_estado = 0;
            $act_alum -> id_actividad =  $_POST['actividad'];
            $act_alum->fhcreacion = new CDbExpression('NOW()');
            $act_alum->fhultmod = new CDbExpression('NOW()');
            $act_alum->cusuario = 'sysadmin';
            if ($act_alum->save()){
                echo "ok";
            }
            else {
                echo "error";
            }

        }

    }

    public function actionObtenerActividad()
    {
        if(isset($_POST['actividad'])){
            $query="select concat('<center><b>Gimnasio: </b>',ficha_institucion.nombre,' ','<br><b>Deporte: </b>',deporte,' ','<br><b>Profesor: </b>',' ',ficha_usuario.nombre,' ',ficha_usuario.apellido, ' ') as desc1 from ficha_institucion, deporte, ficha_usuario, actividad where ficha_institucion.id_institucion = actividad.id_institucion and deporte.id_deporte = actividad.id_deporte and actividad.id_usuario = ficha_usuario.id_usuario and actividad.id_actividad = ".$_POST['actividad'];
            $list = Yii::app()->db->createCommand($query)->queryAll();
            if($list){
                foreach ($list as $d) {
                    $descripcion = '<center>¿Estás seguro que deseas anotarte? <br></center>'.$d['desc1'];
                    $query_horario = "select CASE id_dia WHEN 1 THEN 'Lu' WHEN 2 THEN 'Ma' WHEN 3 THEN 'Mi' WHEN 4 THEN 'Ju' WHEN 5 THEN 'Vi' WHEN 6 THEN 'Sa' WHEN 7 THEN 'Do' END dia,concat(lpad(hora,2,'0'),':',lpad(minutos,2,'0'))horario from actividad_horario where id_actividad = " . $_POST['actividad'];
                    $listado = Yii::app()->db->createCommand($query_horario)->queryAll();
                    $hora = "";
                    foreach ($listado as $h) {
                        if ($hora == "") {
                            $hora = '<br><b>Horario: ' . $h['dia'] . '</b> ' . $h['horario'];
                        } else {
                            $hora = $hora . ' <b>' . $h['dia'] . '</b> ' . $h['horario'];
                        }

                    }
                }
                echo  $descripcion = $descripcion . $hora;

            }
            else{
                echo "error";
            }
        }
        else{
            echo "error";
        }
    }

    /**
     * Performs the AJAX validation.
     * @param Actividad $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'actividad-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionInscripcionActividad()
    {
        $deportes = new Deporte();
        $provincia = new Provincia();
        $localidad = new Localidad();
        // echo "error";
        if (isset($_POST['deporte']) && isset($_POST['provincia']) && isset($_POST['localidad'])) {
            $id_usuario = Yii::app()->user->id;
            $criteria = new CDbCriteria;
            $criteria->condition = 'id_localidad = :localidad and id_institucion IN (select id_institucion from actividad where id_deporte = :deporte)';
            $criteria->params = array(':localidad' => $_POST['localidad'], ':deporte' => $_POST['deporte']);
            $gimnasio = FichaInstitucion:: model()->findAll($criteria);
            //$locations = '[';
            $i = 1;
            $locations = "";

            foreach ($gimnasio as $gim) {
                if ($gim->acepta_mp == 'S') {
                    $gim->acepta_mp = 'Si';
                }
                if ($gim->acepta_mp == 'N') {
                    $gim->acepta_mp = 'No';
                }
                $list = Yii::app()->db->createCommand('select 1 from dual where (select count(*) from actividad where actividad.id_institucion =' . $gim->id_institucion . ' and  id_deporte = ' . $_POST['deporte'] . ')  - (select count(*) from actividad_alumno where id_usuario = ' . $id_usuario . ' and id_actividad in (select id_actividad from actividad where id_institucion = ' . $gim->id_institucion . ' and id_deporte = ' . $_POST['deporte'] . ')) > 0 ')->queryAll();
                $flag = 0;
                if ($list) {
                    $flag = 1;
                    if ($locations == "") {
                        $locations = $locations . '["<center><b>' . $gim->nombre . '</center></b><br>' .
                            ' <b>►Dirección: </b>' . $gim->direccion . '<br>' .
                            ' <b>►Teléfono: </b>' . $gim->telfijo . '<br>' .
                            '<b>►Mercado Pago: </b>' . $gim->acepta_mp . '<br><br><b>▲Actividades: </b><br><br>';

                        $query = "select actividad.id_actividad, concat(ficha_usuario.nombre,' ',ficha_usuario.apellido) profesor, deporte.deporte from actividad, ficha_usuario, deporte where actividad.id_usuario = ficha_usuario.id_usuario and actividad.id_deporte = deporte.id_deporte and actividad.id_deporte = ". $_POST['deporte']." and actividad.id_institucion = " . $gim->id_institucion . " and actividad.id_usuario not in (". $id_usuario . ")and actividad.id_actividad not in (select id_actividad from actividad_alumno where id_usuario = ". $id_usuario .")";
                        $listaActividades = Yii::app()->db->createCommand($query)->queryAll();
                        foreach ($listaActividades as $act) {
                            $query_horario = "select CASE id_dia WHEN 1 THEN 'Lu' WHEN 2 THEN 'Ma' WHEN 3 THEN 'Mi' WHEN 4 THEN 'Ju' WHEN 5 THEN 'Vi' WHEN 6 THEN 'Sa' WHEN 7 THEN 'Do' END dia,concat(lpad(hora,2,'0'),':',lpad(minutos,2,'0'))horario from actividad_horario where id_actividad = " . $act['id_actividad'];
                            $horario = Yii::app()->db->createCommand($query_horario)->queryAll();
                            $hora = "";
                            foreach ($horario as $h) {
                                if($hora == ""){
                                    $hora = '<b>' . $h['dia'] . '</b> ' . $h['horario'];
                                }
                                else{
                                    $hora = $hora . ' <b>' . $h['dia'] . '</b> ' . $h['horario'];
                                }
                            }
                            $locations = $locations . '<b>►Profesor: </b>' . $act['profesor'] . ' <b>Horario: </b>' . $hora . '   <br><b><a href='.$act['id_actividad'].'>¡Hacé click acá para anotarte! </a></b><br><br>';

                        }
                        $locations = $locations . '",' . $gim->coordenada_x . ',' . $gim->coordenada_y . ',' . $i++ . ']';
                    }

                    else {
                        $locations = $locations . ',["<center><b>' . $gim->nombre . '</center></b><br>' .
                            ' <b>►Dirección: </b>' . $gim->direccion . '<br>' .
                            ' <b>►Teléfono: </b>' . $gim->telfijo . '<br>' .
                            '<b>►Mercado Pago: </b>' . $gim->acepta_mp . '<br><br><b>▲Actividades: </b><br><br>';

                        $query = "select actividad.id_actividad, concat(ficha_usuario.nombre,' ',ficha_usuario.apellido) profesor, deporte.deporte from actividad, ficha_usuario, deporte where actividad.id_usuario = ficha_usuario.id_usuario and actividad.id_deporte = deporte.id_deporte and actividad.id_deporte = ". $_POST['deporte']." and actividad.id_institucion = " . $gim->id_institucion;
                        $listaActividades = Yii::app()->db->createCommand($query)->queryAll();
                        foreach ($listaActividades as $act) {
                            $query_horario = "select CASE id_dia WHEN 1 THEN 'Lu' WHEN 2 THEN 'Ma' WHEN 3 THEN 'Mi' WHEN 4 THEN 'Ju' WHEN 5 THEN 'Vi' WHEN 6 THEN 'Sa' WHEN 7 THEN 'Do' END dia,concat(lpad(hora,2,'0'),':',lpad(minutos,2,'0'))horario from actividad_horario where id_actividad = " . $act['id_actividad'];
                            $horario = Yii::app()->db->createCommand($query_horario)->queryAll();
                            $hora = "";
                            foreach ($horario as $h) {
                                if($hora == ""){
                                    $hora = '<b>' . $h['dia'] . '</b> ' . $h['horario'];
                                }
                                else{
                                    $hora = $hora . ' <b>' . $h['dia'] . '</b> ' . $h['horario'];
                                }
                            }
                            $locations = $locations . '<b>►Profesor: </b>' . $act['profesor'] . ' <b>Horario: </b>' . $hora . '   <br><b><a href='.$act['id_actividad'].'>¡Hacé click acá para anotarte! </a></b><br><br>';

                        }
                        $locations = $locations . '",' . $gim->coordenada_x . ',' . $gim->coordenada_y . ',' . $i++ . ']';
                    }
                }

            }

            if ($gimnasio == null || $flag == 0) {
                echo "error";
            } else {
                echo $locations;
            }

        } else {
            $this->render('InscripcionActividad', array('deportes' => $deportes, 'provincia' => $provincia, 'localidad' => $localidad));

        }


    }


    public function actionListaDeInscripcion()
    {
        if (isset($_POST['deporte']) && isset($_POST['Localidad'])){
            //   $criteria = new CDbCriteria;
            //   $criteria->condition = 'id_localidad = :localidad and id_institucion IN (select id_institucion from actividad where id_deporte = :deporte)';
            //  $criteria->params = array(':localidad'=>$_POST['localidad'],'deporte'=>$_POST['deporte']);
            //  $gimnasio = FichaInstitucion:: model()->findAll($criteria);
            //print_r($_POST['Localidad']['id_localidad']);
            $list = Yii::app()->db->createCommand('select nombre,direccion,telfijo,CASE id_dia WHEN 1 THEN "Lunes" WHEN 2 THEN "Martes" WHEN 3 THEN "Miercoles" WHEN 4 THEN "Jueves" WHEN 5 THEN "Viernes" WHEN 6 THEN "Sábado" WHEN 7 THEN "Domingo" END as id_dia,lpad(hora,2,"0") as hora,lpad(minutos,2,"0") as minutos,actividad.id_actividad from ficha_institucion,actividad, actividad_horario where actividad.id_actividad not in (select id_actividad from actividad_alumno where id_usuario = '.Yii::app()->user->id.') and actividad.id_institucion = ficha_institucion.id_institucion and actividad.id_actividad = actividad_horario.id_actividad and ficha_institucion.id_institucion = (select id_institucion from ficha_institucion where id_localidad = ' . $_POST['Localidad']['id_localidad'] . ') and actividad.id_deporte = ' . $_POST['deporte'] . ' order by nombre')->queryAll();
            //print_r($list);
            // return $list;
            //$this->render('admin');
            $this->render('ListaDeInscripcion', array('list' => $list));
        }
        else{
            $this->render('admin');
        }



    }

    public function actionInscripcionFinal()
    {

        if(isset($_POST['actividad'])){

            $id_usuario = Yii::app()->user->id;
			$act_alum = new actividadAlumno();
            $act_alum->id_usuario = $id_usuario;
            $act_alum->id_estado = 0;
            $act_alum -> id_actividad =  $_POST['actividad'];
            $act_alum->fhcreacion = new CDbExpression('NOW()');
            $act_alum->fhultmod = new CDbExpression('NOW()');
            $act_alum->cusuario = 'sysadmin';
            if ($act_alum->save()){
                echo "ok";
            }
            else {
                echo "error";
            }
        }
    }

    public function actionEliminar()
    {
        if(isset($_POST['actividad'])){
            Pago::model()->deleteAll("id_actividad='" . $_POST['actividad']."'");
            ActividadHorario::model()->deleteAll("id_actividad='" . $_POST['actividad']."'");
            ActividadAlumno::model()->deleteAll("id_actividad='" . $_POST['actividad']."'");
            Actividad::model()->deleteAll("id_actividad='" . $_POST['actividad']."'");
            echo "ok";
        }
    }

    public function actionCrearActividadOk()
    {
        $actividad = new Actividad;
        $deporte = new Deporte;
        $ficha_usuario = new FichaUsuario;
        $actividad_horario = new ActividadHorario;
        $this->render('CrearActividadOk', array('deporte' => $deporte, 'actividad' => $actividad, 'actividad_horario' => $actividad_horario, 'ficha_usuario' => $ficha_usuario));
    }

    public function actionEliminarActividades()
    {
        $this->render('EliminarActividades');
    }

    public function actionModificarActividades()
    {
        $actividad = new Actividad;
        $deporte = new Deporte;
        $ficha_usuario = new FichaUsuario;
        $actividad_horario = new ActividadHorario;
        $this->render('ModificarActividades', array('deporte' => $deporte, 'actividad' => $actividad, 'actividad_horario' => $actividad_horario, 'ficha_usuario' => $ficha_usuario));
    }
}
