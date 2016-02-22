<html>
<style type="text/css">
    body {
        background: url(../../img/28.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<body>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><a href="../site/login">&times;</a></span></button>
                <h4 class="modal-title">Recuperá tu contraseña</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <br/>
                            <div> Ingrese la contraseña que desea establecer para su cuenta</div>
                            <?php $email = $_GET['email'];?>
                            <br>
                            <div class="form-group">
                                <form action="">
                                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña"></input>
                                    <input type="hidden" id="email" value="<?php echo $email?>"></input>
                                    <br>
                                    <input type="button" value="Enviar" id="recuperarpass" name="recpass" class="btn btn-primary"></input>
                                </form>
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button"  value="Volver" class="btn btn-primary" id="volver" name="volver"></input>
            </div>
        </div>
    </div>
</div>
<?php
echo "<div class='modal fade'  id='mensajepassblanco' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
		  <div class='modal-dialog' role='document'>
			 <div class='modal-content'>
			   <div class='modal-header'>
				 <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<h4 class='modal-title' id='myModalLabel'>Recuperar contraseña</h4>
				</div>
				<div class='modal-body'>
				  Ingrese una contraseña.
				</div>
			    <div class='modal-footer'>
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
				</div>
			 </div>
		  </div>
		</div>
	  </div>";
?>
<?php
echo "<div class='modal fade'  id='mensajelongerronea' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
		  <div class='modal-dialog' role='document'>
			 <div class='modal-content'>
			   <div class='modal-header'>
				 <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<h4 class='modal-title' id='myModalLabel'>Recuperar contraseña</h4>
				</div>
				<div class='modal-body'>
				  La contraseña debe tener entre 6 y 15 carácteres.
				</div>
			    <div class='modal-footer'>
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
				</div>
			 </div>
		  </div>
		</div>
	  </div>";
?>
<?php
echo "<div class='modal fade'  id='mensajeexpregerronea' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
		  <div class='modal-dialog' role='document'>
			 <div class='modal-content'>
			   <div class='modal-header'>
				 <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<h4 class='modal-title' id='myModalLabel'>Recuperar contraseña</h4>
				</div>
				<div class='modal-body'>
				 La contraseña debe tener al menos una mayuscula y dos números.
				</div>
			    <div class='modal-footer'>
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
				</div>
			 </div>
		  </div>
		</div>
	  </div>";
?>
<?php
echo "<div class='modal fade'  id='mensajepassok' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
		  <div class='modal-dialog' role='document'>
			 <div class='modal-content'>
			   <div class='modal-header'>
				 <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<h4 class='modal-title' id='myModalLabel'>Recuperar contraseña</h4>
				</div>
				<div class='modal-body'>
				  Se actualizo correctamente la contraseña de su cuenta.
				</div>
			    <div class='modal-footer'>
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
				</div>
			 </div>
		  </div>
		</div>
	  </div>";
?>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myModal').modal({
           backdrop: 'static',
           keyboard: false
		});
		$('#myModal').modal('show');
    });
</script>

<script type="text/javascript">
    $("#volver").on("click",function(){
        location.href="../../";
    });
</script>

<script type="text/javascript">
    $("#recuperarpass").on("click",function(){
        var pass = $('#pass').val();
        var email = $('#email').val();
        var data = {'pass':pass,'email':email};
        $.ajax({
            url :  baseurl + '/usuario/Recuperarpassword2',
            type: "POST",
            dataType : "html",
            data : data,
            cache: false,
            success: function (response) {
                if(response == "ok"){
                    $('#mensajepassok').modal('show');
                }
                if(response == "passblanco"){
                    $('#mensajepassblanco').modal('show');
                }
                if(response == "longerronea"){
                    $('#mensajelongerronea').modal('show');
                }
                if(response == "expregerronea"){
                    $('#mensajeexpregerronea').modal('show');
                }
            } ,
            error: function (e) {
                console.log(e);
            }
        });
    })
</script>