<style type="text/css">
    body {
        background: url(../../img/28.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<?php
    if(isset($_GET['email'])){
        $usuarios = Usuario::model()->findAll();
        foreach($usuarios as $usu){
            if(md5($usu->email) == $_GET['email']){
                $usuario = $usu;
                $ficusuario = FichaUsuario::model()->findByAttributes(array('id_usuario'=>$usuario->id_usuario));

            }
        }
    }
	if($usuario && $usuario->id_estado == 1){
    ?>
    <div class='modal fade'  id='usuarioactivo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
		<div class='modal-dialog' role='document'>
			<div class='modal-content'>
			   <div class='modal-header'>
				 <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  <h5 class='modal-title' id='myModalLabel'>Activar Usuario</h5>
				</div>
                <div class='modal-body'>
         		     <h5 class="sombra">
                      El usuario ya se encuentra activo.
                     </h5>
				</div>
                <div class='modal-footer'>
				    <button type='button' class='btn btn-primary' id='volver' data-dismiss='modal'>Volver</button>
				</div> 				
            </div>
        </div>
 </div>
<script type="text/javascript">
    $('#usuarioactivo').modal({
        backdrop: 'static',
        keyboard: false
	});
    $("#usuarioactivo").modal('show');
</script>       		 
  <?php 
    }
    if($usuario && $usuario->id_estado == 0){
        //Existe el objeto usuario y lo activo.
        $usuario->id_estado = 1;
        $usuario->saveAttributes(array('id_estado'=>$usuario->id_estado));      
        ?>
 <div class='modal fade'  id='activacionok' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
	    <div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<h5 class='modal-title' id='myModalLabel'>Activar Usuario</h5>
		    </div>
            <div class='modal-body'>
         		<h5 class="sombra">
                    Bienvenido a <b>Do fit!</b>, <?php echo $ficusuario->nombre."&nbsp".$ficusuario->apellido; ?>.<br />
                    Tu cuenta está activa.<br />
                    Ya puedes iniciar sesión en el sitio.
                </h5>
		    </div>
            <div class='modal-footer'>
				<button type='button' class='btn btn-primary' id='volver' data-dismiss='modal'>Volver</button>
		    </div> 				
        </div>
    </div>
</div>

 <script type="text/javascript">
    $("#activacionok").modal('show');
</script>  
<?php
    }
	if(!$usuario)
	{
        //No existe el código.
        ?>
<div class='modal fade'  id='activacionerror' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
		<div class='modal-dialog' role='document'>
			<div class='modal-content'>
			   <div class='modal-header'>
				 <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  <h5 class='modal-title' id='myModalLabel'>Activar Usuario</h5>
				</div>
                <div class='modal-body'>
         		     <h5 class="sombra">
                      No se encontro ningún usuario con ese mail. 
					  Asegurate de haber copiado correctamente el link<br />
                      para activar tu cuenta.
                     </h5>
				</div>
                <div class='modal-footer'>
				    <button type='button' class='btn btn-primary' id='volver' data-dismiss='modal'>Volver</button>
				</div> 				
            </div>
        </div>
 </div>
<script type="text/javascript">
    $("#activacionerror").modal('show');
</script>      
 <?php
    }
 ?>    

<script type="text/javascript">
    $("#volver").on("click",function(){
        location.href="../../";
    });
</script>  