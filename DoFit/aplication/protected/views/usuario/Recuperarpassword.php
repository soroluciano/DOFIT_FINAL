<style type="text/css">
    body {
        background: url(../img/19.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>


<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><a href="../site/login">&times;</a></span></button>
                <h4 class="modal-title">Recuperá tu contraseña</h4>
            </div>
            <div class="modal-body">
                <div class="form">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <br>
                                <div>Ingresa tu usuario para poder recuperarla</div>
                                <br>
                                <div class="form-group">
                                    <form action="">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="E-mail"></input>
                                        <br/>
                                        <input type="button" value="Enviar" class="btn btn-primary" id="enviardatos" name="Enviar"></input>
                                    </form>
                                </div>
                            </div>
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
echo "<div class='modal fade'  id='mensajemailblanco' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
		    <div class='modal-dialog' role='document'>
			    <div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<h4 class='modal-title' id='myModalLabel'>Recuperar contraseña</h4>
					</div>
			        <div class='modal-body'>
				        Ingrese una dirección de email.
				    </div>
			        <div class='modal-footer'>
					   <button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
				    </div>
		        </div>
		    </div>
	    </div>";
		
echo "<div class='modal fade'  id='mensajemailerror' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
		    <div class='modal-dialog' role='document'>
			    <div class='modal-content'>
					<div class='modal-header'>
					    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<h4 class='modal-title' id='myModalLabel'>Recuperar contraseña</h4>
					</div>
					<div class='modal-body'>
						No se encontro ninguna cuenta con ese email.
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
					</div>
				</div>
			</div>
		</div>";
		
echo "<div class='modal fade'  id='mensajemailexitoso' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
			<div class='modal-dialog' role='document'>
			    <div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<h4 class='modal-title' id='myModalLabel'>Recuperar contraseña</h4>
				    </div>
					<div class='modal-body'>
					    Se envió un correo a su cuenta para recueperar su contraseña.
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
					</div>
				</div>
			</div>";
?>

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
        location.href="../";
    });
</script>

<script type="text/javascript">
    $("#enviardatos").on("click",function(){
        var email = $('#email').val();
        var data = {'email':email};
        $.ajax({
            url :  baseurl + '/usuario/Recuperarpassword',
            type: "POST",
            dataType : "html",
            data : data,
            cache: false,
            success: function (response) {
                if(response == "emailblanco"){
                    $('#mensajemailblanco').modal('show');
                }
                if(response == "error"){
                    $('#mensajemailerror').modal('show');
                }
                if(response == "exitoso") {
                    $('#mensajemailexitoso').modal('show');
                }
            } ,
            error: function (e) {
                console.log(e);
            }
        });
    })
</script>