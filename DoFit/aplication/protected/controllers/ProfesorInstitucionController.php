<?php

class ProfesorInstitucionController extends Controller
{

	public function actionAdhesiongimnasio()
	{
		$localidad =  new Localidad;
		$this->render('Adhesiongimnasio',array('localidad'=>$localidad));
	}

	public function actionMostrarInstituciones()
	{
		$localidadsel = $_POST['localidad'];
		$cantveces = 0;
		$id_usuario = Yii::app()->user->id;
		$localidad = Localidad::model()->find('id_localidad=:id_localidad',array(':id_localidad'=>$localidadsel));
		$id_provincia = $localidad->id_provincia;
		$provincia = Provincia::model()->find('id_provincia=:id_provincia',array(':id_provincia'=>$id_provincia));
		$criteria = new CDbCriteria;
		$criteria->select = 't.id_institucion,t.nombre,t.cuit,t.direccion,t.id_localidad,t.telfijo,t.celular,t.depto,t.piso';
		$criteria->condition = 't.id_localidad = ' . $localidadsel;
		$ficinstituciones = FichaInstitucion::model()->findAll($criteria);
		$cantinstituciones = count($ficinstituciones);
		if($ficinstituciones != NULL){
			foreach($ficinstituciones as $fi){
				$profinstituciones = ProfesorInstitucion::model()->findByAttributes(array('id_usuario'=>$id_usuario,'id_institucion'=>$fi->id_institucion));
				if($profinstituciones != NULL){
					$cantveces++;  // Contador para ver si el profesor ya le envio una solicitud a esa institucion
				}
			}
			if($cantveces == $cantinstituciones){
				echo "solcompletas";
			}
		}
		if($ficinstituciones != NULL && $cantveces < $cantinstituciones){
			echo "<table id='mosinstituciones' class='display' cellspacing='0' width='100%'>
                     <thead class='fuente'>
                     <tr>
				     <th>Nombre</th><th>Dirección</th><th>Tel. fijo</th><th>Celular</th><th>Google maps</th><th>Enviar solicitud</th></tr></thead>";
			foreach($ficinstituciones as $ficins){
				$profins = ProfesorInstitucion::model()->findByAttributes(array('id_usuario'=>$id_usuario,'id_institucion'=>$ficins->id_institucion));
				if($profins == NULL){
					echo  "<tbody class='fuente'>";
					echo  "<tr>";
					echo  "<td id='nombre'>" . $ficins->nombre . "</td>";
					echo  "<td id='direccion'>" . $ficins->direccion ."</td>";
					echo  "<td id='telfijo'>" . $ficins->telfijo . "</td>";
					echo  "<td id='celular'>" . $ficins->celular . "</td>";
					echo  "<td id='google'><input type='button' class='btn btn-primary' onclick='Mostrarubicacion(\"".$ficins->nombre."\",\"".$ficins->direccion."\",\"".$localidad->localidad."\",\"".$provincia->provincia."\");' value='Ver mapa'></input></td>";
					echo  "<td id='ad'><input type='button' class='btn btn-primary' onclick='javascript:Enviarsolicitud($ficins->id_institucion)' value='Enviar solicitud!'></input></td>";
				}
			}
			echo "</tbody>
			           </table>";
			echo "<script type='text/javascript'>
	                $('#mosinstituciones').DataTable( {
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
		}

		if($ficinstituciones == NULL)
		{
			echo "errorbusqueda";
		}
	}

	public function actionEnviarSolicitud()
	{
		if(isset($_POST['id_institucion'])){
			$profins = new ProfesorInstitucion;
			$id_institucion = $_POST['id_institucion'];
			$id_usuario = Yii::app()->user->id;
			$profins->id_usuario = $id_usuario;
			$profins->id_institucion = $id_institucion;
			$profins->id_estado = 0;
			$profins->fhcreacion = new CDbExpression('NOW()');
			$profins->fhultmod = new CDbExpression('NOW()');
			$usuario = Usuario::model()->findByAttributes(array('id_usuario'=>$id_usuario));
			$profins->cusuario = $usuario->email;
			if($profins->validate()){
				if($profins->save()){
					echo "solicitudok";
				}
				else{
					echo "solicituderror";
				}
			}
		}
	}

	public function actionListadoProfesores()
	{
		$this->render('ListadoProfesores');
	}

	public function actionMostrarTelefonos()
	{
		$idusuario = $_POST['idusuario'];
		$fichausuario = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$idusuario));
		echo "<center><b>Datos tel&eacute;fonicos de&nbsp;" .$fichausuario->nombre."&nbsp".$fichausuario->apellido."</b></center>|";
		echo "<center>";
		echo "<br><b>Tel&eacute;fono Fijo: </b>" . substr($fichausuario->telfijo,0,4)."-".substr($fichausuario->telfijo,0,4);
		echo "<br><b>Celular: </b>" . $fichausuario->celular;
		echo "<br><b>Contacto Emergencia: </b>" . $fichausuario->conemer;
		echo "<br><b>Tel&eacute;fono Emergencia: </b>" . substr($fichausuario->telemer,0,4)."-".substr($fichausuario->telemer,-4);
		echo "</center>";
	}

	public function actionMostrarDireccion()
	{
		$idusuario = $_POST['idusuario'];
		$fichausuario = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$idusuario));
		echo "<center><b>Datos domiciliarios de&nbsp;" .$fichausuario->nombre."&nbsp".$fichausuario->apellido."</b></center>|";
		echo "<center>";
		echo "<br><b>Direcci&oacute;n: </b>" . $fichausuario->direccion;
		echo "<br><b>Piso: </b>". $fichausuario->piso;
		echo "<br><b>Departamento: </b>" . $fichausuario->depto;
		echo "<br><b>Localidad: </b>";
		$localidad = Localidad::model()->findByAttributes(array('id_localidad'=>$fichausuario->id_localidad));
		echo  $localidad->localidad;
		echo "<br><b>Provincia: </b>";
		$provincia = Provincia::model()->findByAttributes(array('id_provincia'=>$localidad->id_provincia));
		echo $provincia->provincia;
		echo "</center>";
	}

	public function actionMostrarActividades()
	{
		$idusuario = $_POST['idusuario'];
		$idinstitucion = Yii::app()->user->id;
		$fichainstitucion = FichaInstitucion::model()->findByAttributes(array('id_institucion'=>$idinstitucion));
		$fichausuario = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$idusuario));
		// busco la actividad para luego encnotrar el Deporte, día y horario que las dicta el profesor.
		$queryact = Yii::app()->db->createCommand('SELECT id_actividad,valor_actividad FROM actividad where id_institucion= '.$idinstitucion.' and id_usuario = '.$idusuario)->queryAll();
		if($queryact != NULL){
			echo "<h4><b>Actividades que dicta " .$fichausuario->nombre."&nbsp".$fichausuario->apellido."&nbspen&nbsp".$fichainstitucion->nombre."<b></h4>|";
			echo "<br/><table class='table table-hover' id='actiprof' class='display' cellspacing='0' width='100%'>
				    <thead>
				        <tr><th>Deporte</th><th>Días y Horarios</th><th>Valor actividad</th></tr>
				    </thead>
				    <tbody>";
			foreach($queryact as $act){
				echo "<tr>
				      <td id='depo'>";
				$dep = Yii::app()->db->createCommand('SELECT deporte FROM deporte where id_deporte IN(SELECT id_deporte FROM actividad where id_actividad= '.$act['id_actividad'].')')->queryRow();
				echo $dep['deporte'];
				echo "</td>";
				$diashorarios = ActividadHorario::model()->findAllByAttributes(array('id_actividad'=>$act['id_actividad']));
				echo "<td id='diahor'>";
				foreach($diashorarios as $diashor){
					$dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
					$id_dia = $diashor->id_dia-1;
					echo $dias[$id_dia]."&nbsp;".$diashor->hora .':'.($diashor->minutos == '0' ? '0'.$diashor->minutos : $diashor->minutos)."&nbsp&nbsp";
				}
				echo "</td>";
				$valoract = Yii::app()->db->createCommand('SELECT valor_actividad  FROM  actividad WHERE id_actividad='.$act['id_actividad'])->queryRow();
				echo  "<td id='valor'>" . $valoract['valor_actividad'] . "</td>";
				echo "</tr>";
			}
			echo"</tbody>
			     </table>";
			echo "<script type='text/javascript'>
                $('#actiprof').DataTable( {
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
		}
		else {
			echo "erracti|<h5><b>$fichausuario->nombre $fichausuario->apellido no dicta ninguna actividad en $fichainstitucion->nombre.</b></h5>";
		}
	}

	public function actionBorrarProfesor()
	{
		$idprofesor = $_POST['idprofesor'];
		$idinstitucion = Yii::app()->user->id;
		$del_act_hor = Yii::app()->db->createCommand('DELETE from actividad_horario where id_actividad IN(SELECT id_actividad from actividad where id_usuario='.$idprofesor.' and id_institucion='.$idinstitucion.')')->execute();
		$del_act_pago = Yii::app()->db->createCommand('DELETE from pago where id_actividad IN(SELECT id_actividad from actividad where id_usuario='.$idprofesor.' and id_institucion='.$idinstitucion.')')->execute();
		$del_resp = Yii::app()->db->createCommand('DELETE from respuesta where id_posteo IN (SELECT id_posteo from perfil_muro_profesor where id_actividad IN (SELECT id_actividad from actividad where id_usuario='.$idprofesor.' and id_institucion='.$idinstitucion.'))')->execute();
		$del_per_muro = Yii::app()->db->createCommand('DELETE from perfil_muro_profesor where id_actividad IN(SELECT id_actividad from actividad where id_usuario='.$idprofesor.' and id_institucion='.$idinstitucion.')')->execute();
		$del_act_alumn = Yii::app()->db->createCommand('DELETE from actividad_alumno where id_actividad IN(SELECT id_actividad from actividad where id_usuario='.$idprofesor.' and id_institucion='.$idinstitucion.')')->execute();
		$del_act = Yii::app()->db->createCommand('DELETE from actividad where id_institucion='.$idinstitucion.' and id_usuario='.$idprofesor)->execute();

		$del_ins_prof = Yii::app()->db->createCommand('DELETE from profesor_institucion where id_usuario='.$idprofesor.' and id_institucion='.$idinstitucion)->execute();
		if($del_ins_prof){
			echo "ok";
		}
		else
		{
			echo "error";
		}
	}

	public function actionListadoActividades()
	{
		$id_usuario = Yii::app()->user->id;
		$criteria = new CDbCriteria;
		$instituciones = Yii::app()->db->createCommand('select id_institucion,nombre FROM ficha_institucion WHERE id_institucion IN(SELECT id_institucion FROM profesor_institucion WHERE id_institucion IN(select id_institucion FROM actividad WHERE id_usuario = '.$id_usuario.' AND id_estado = 1))')->queryAll();
		if($instituciones != NULL){
			$this->render('ListadoActividadesProfesor',array('instituciones'=>$instituciones));
		}
	}

	public function actionConsultarActividadesInscripto()
	{
		$id_usuario = Yii::app()->user->id;
		$id_institucion = $_POST['idinstitucion'];
		$actividades = Actividad::model()->findAllByAttributes(array('id_usuario'=>$id_usuario,'id_institucion'=>$id_institucion));
		if($actividades != NULL){
			echo "<table id='lisactividades' class='display' cellspacing='0' width='100%'>
	         <thead>
                <th>Deporte</th><th>Días y Horarios</th><th>Alumnos Inscriptos</th>
			 </thead>
	         <tbody>";
			foreach($actividades as $act){
				echo "<tr>";
				$deporte = Deporte::model()->findByAttributes(array('id_deporte'=>$act->id_deporte));
				echo "<td id='deporte'>" . $deporte->deporte . "</td>";
				$diashorarios = ActividadHorario::model()->findAllByAttributes(array('id_actividad'=>$act->id_actividad));
				echo "<td id='diahor'>";
				foreach($diashorarios as $diashor){
					$dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
					$id_dia = $diashor->id_dia-1;
					echo $dias[$id_dia]."&nbsp;".$diashor->hora .':'.($diashor->minutos == '0' ? '0'.$diashor->minutos : $diashor->minutos)."&nbsp&nbsp";
				}
				echo "</td>";
				echo "<td><input type='button' class='btn btn-primary' value='Ver alumnos Inscriptos' onclick='javascript:AlumnosInscriptos($act->id_actividad)'></input></td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "<script type='text/javascript'>
                $('#lisactividades').DataTable( {
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
		}
		else {
			echo "error";
		}
	}

	public function actionAlumnosInscriptosActividad()
	{
		$idactividad = $_POST['idactividad'];
		$actividad = Actividad::model()->findByAttributes(array('id_actividad'=>$idactividad));
		$deporte = Deporte::model()->findByAttributes(array('id_deporte'=>$actividad->id_deporte));
		$fichainstitucion = FichaInstitucion::model()->findByAttributes(array('id_institucion'=>$actividad->id_institucion));
		$actividadalumno = ActividadAlumno::model()->findAllByAttributes(array('id_actividad'=>$idactividad,'id_estado'=>1));
		if($actividadalumno != NULL){
			echo "<table id='lisinscriptos'  class='display' cellspacing='0' width='100%'>
               <thead class='fuente'>
                <th>Nombre</th><th>Apellido</th><th>Dni</th><th>Email</th><th>Fecha Nacimiento</th><th>Tel&eacute;fono Fijo</th><th>Celular</th></thead>
            <tbody class='fuente'>";
			foreach($actividadalumno as $actalum){
				$fichausuario = FichaUsuario::model()->findByAttributes(array('id_usuario'=>$actalum->id_usuario));
				$usuario = Usuario::model()->findByAttributes(array('id_usuario'=>$actalum->id_usuario));
				echo "<tr>";
				echo "<td id='nombre'>".$fichausuario->nombre ."</td>";
				echo "<td id='apellido'>".$fichausuario->apellido. "</td>";
				echo "<td id='dni'>".$fichausuario->dni . "</td>";
				echo "<td id='email' width='50%'>" .$usuario->email . "</td>";
				$fechanac = date("d-m-Y",strtotime($fichausuario->fechanac));
				echo "<td id='fecnac'>". $fechanac ."</td>";
				echo "<td id='telfijo'>". $fichausuario->telfijo . "</td>";
				echo "<td id='celular'>". $fichausuario->celular . "</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "<script type='text/javascript'>
                $('#lisinscriptos').DataTable( {
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
			echo "|$deporte->deporte|$fichainstitucion->nombre";
		}
		if($actividadalumno == null){
			echo "sinalumnos|$deporte->deporte|$fichainstitucion->nombre";
		}	
	}

	// Funcion para consultar si las instutuciones aceptaron o no la solicitud de adhesion
	public function actionConsultarEstadosInstituciones()
	{
		$id_profesor = Yii::app()->user->id;
		$profesor_institucion = ProfesorInstitucion::model()->findAllByAttributes(array('id_usuario'=>$id_profesor));
		$this->render('MostrarEstadosInstituciones',array('profesor_institucion'=>$profesor_institucion));
	}
}
?>