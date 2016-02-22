<html>
<head>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/chat.js"></script>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/css/chat.css"></link>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/bootstrap.min.js"></script>
	<style type="text/css">
		body {
			background: url(../img/fondo1.jpg) no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
	</style>
</head>
<header class="navbar navbar-static-top bs-docs-nav" id="bloque" role="banner">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="../chat/index" class="navbar-brand">Chat - Do Fit</a>
		</div>
		<nav id="bs-navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="">Bienvenido! <?php
						if(!Yii::app()->user->isGuest){
							//Es un usuario logueado.
							$Us = Usuario::model()->findByPk(Yii::app()->user->id);
							$ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
							echo $ficha->nombre."&nbsp".$ficha->apellido;

						} ?></a></li>
				<li><?php echo CHtml::link('Salir', array('site/logout')); ?></li>
			</ul>
		</nav>
	</div>
</header>
<body>
<div class="container">
	<form id="formChat" name="formChat">
		<div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">
			<div class="col-xs-12 col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading top-bar">
						<div class="col-md-8 col-xs-8">
							<h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span>
								<?php
								$nombre = $_POST['nombre'];
								$apellido = $_POST['apellido'];
								$idusuario = $_POST['idusuario'];
								echo "<input type='hidden'  id='idusuario' value='$idusuario' name='idusuario'></input>";

								if(isset($nombre) && isset($apellido)){
									echo $nombre."&nbsp".$apellido;
								}
								?>
								<input type="hidden" id="usuario" name="user" value="<?php echo $ficha->nombre;?>"></input>

							</h3>
						</div>
						<div class="col-md-4 col-xs-4" >
							<a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
							<a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
						</div>
					</div>
					<div class="panel-body msg_container_base">
						<div id="conversaciones"></div>
					</div>
					<div class="panel-footer">
						<div class="input-group">
							<input id="mensaje" name="mensaje" type="text" class="form-control input-sm chat_input" placeholder="Escribe tu mensaje aquí..." />
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="enviar" name="enviar" onclick="registerMessages();">Enviar</button>
                        </span>
						</div>
					</div>
				</div>
			</div>
	</form>
</div>
<div class="btn-group dropup">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		<span class="glyphicon glyphicon-cog"></span>
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<li><a href="#" id="new_chat"><span class="glyphicon glyphicon-plus"></span> Novo</a></li>
		<li><a href="#"><span class="glyphicon glyphicon-list"></span> Ver outras</a></li>
		<li><a href="#"><span class="glyphicon glyphicon-remove"></span> Fechar Tudo</a></li>
		<li class="divider"></li>
		<li><a href="#"><span class="glyphicon glyphicon-eye-close"></span> Invisivel</a></li>
	</ul>
</div>
</div>
</body>
</html>
<script type="text/javascript">
	$(document).on("ready", function(){
		registerMessages();
		$.ajaxSetup({"cache":false});
		setInterval("cargarMensajesAntiguos()",500);
	});

	var registerMessages = function(){
		$("#enviar").on("click",function(e){
			e.preventDefault();
			var frm = $("#formChat").serialize();
			$.ajax({
				type : "POST",
				url : 'Registrarmensaje',
				data: frm
			}).done(function(info){
				$("#mensaje").val("");
			})
		});
	}
	var cargarMensajesAntiguos = function() {
		var idusuario = $("#idusuario").val();
		$.ajax({
			type : "POST",
			url : 'MostrarConversaciones',
			data : {idusuario:idusuario}
		}).done(function(info){
			$("#conversaciones").html(info);
		});
	}
	$("#borrarmensajes").on("click",function(){
		var valor = $("#valor").val(0);
		var idusuarioborr = $("#idusuario").val();
		confirmar=confirm("¿Esta seguro que desea borrar todos los mensajes?");
		if (confirmar) {
			valor.val(1);
		}
		var valorcar = valor.val();
		var data = { "idusuario":idusuarioborr,"valor":valorcar};
		$.ajax({
			url : "BorrarMensajes",
			type: "POST",
			dataType : "json",
			data : data
		})

	});
</script>