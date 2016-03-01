<html>
<style type="text/css">
	body {
		background: url(../img/32.jpg) no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
        opacity: .9;
	}

</style>
<body>
<div class="modal fade" id="myModal">
	<?php  $this->renderPartial('../menu/_menuInstitucion');?>
	<div class="modal-dialog" style="margin-top:190px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" aria-label="Close"><span aria-hidden="true"><a href="../site/login">&times;</a></span></button>
				<h4 class="modal-title">Modifica tu contraseña</h4>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div><b>Contrase&ntilde;a actual</b></div>
								<input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña"></input>
								<label class="error_pw" for="inputError" id="mensajeerror"></label>
								<br/>
								<div><b>Nueva Contrase&ntilde;a</b></div>
								<input type="password" id="recpass1" name="recpass1" class="form-control" placeholder="Nueva Contraseña"></input>
								<label class="error_pw" for="inputError" id="mensajeerror1"></label>
								<br/>
								<div><b>Confirmar nueva contrase&ntilde;a</b></div>
								<input type="password" id="recpass2" name="recpass2" class="form-control" placeholder="Confirmar nueva contraseña"></input>
								<label class="error_pw" for="inputError" id="mensajeerror2"></label>
								<br/>
								<br/>
								<input type="button" value="Confirmar" id="confirmar" name="confirmar" class="btn btn-primary"></input>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="button" value="Volver" class="btn btn-primary" id="volver" name="volver"></input>
			</div>
		</div>
	</div>
</div>
</div>
</div>

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
		$("#mensajeerror").hide();
		$("#mensajeerror1").hide();
		$("#mensajeerror2").hide();
	});
</script>

<script type="text/javascript">
	$("#volver").on("click",function(){
		location.href="../institucion/home";
	});
</script>

<script type="text/javascript">
	$("#confirmar").on("click",function(){
		$("#mensajeerror").empty();
		$("#mensajeerror1").empty();
		$("#mensajeerror2").empty();
		var pass = $('#pass').val();
		var recpass1 = $('#recpass1').val();
		var recpass2 = $('#recpass2').val();
		var passok = "";
		var passok1 = "";
		var passok2 = "";
		var passokgen = "";
		if(pass != ""){
			var fun = validarpassword(pass);
			if(fun == "errorpass"){
				$("#mensajeerror").append("La contraseña ingresada no coincide con la de su cuenta");
				$("#mensajeerror").show();
			}
			else{
				passok= "ok";
			}
		}
		else{
			$("#mensajeerror").append("Ingrese un contraseña");
			$("#mensajeerror").show();
		}

		if(recpass1 != ""){
			if(validarexpregContraseña(recpass1) == 1)
			{
				$("#mensajeerror1").append("La contraseña debe tener entre 6 y 15 caracteres");
				$("#mensajeerror1").show();
			}
			if(validarexpregContraseña(recpass1) == 2)
			{
				$("#mensajeerror1").append("La contraseña debe tener al menos una mayúscula y dos números");
				$("#mensajeerror1").show();
			}
			else{
				passok1 = "ok";
			}
		}
		else
		{
			$("#mensajeerror1").append("Ingrese un contraseña");
			$("#mensajeerror1").show();
		}
		if(recpass2 != ""){
			if(validarexpregContraseña(recpass2) == 1)
			{
				$("#mensajeerror2").append("La contraseña debe tener entre 6 y 15 caracteres");
				$("#mensajeerror2").show();
			}
			if(validarexpregContraseña(recpass2) == 2)
			{
				$("#mensajeerror2").append("La contraseña debe tener al menos una mayúscula y dos números");
				$("#mensajeerror2").show();
			}
			else{
				passok2 = "ok";
			}
		}
		else
		{
			$("#mensajeerror2").append("Ingrese un contraseña");
			$("#mensajeerror2").show();
		}
		if(passok == "ok" && passok1 == "ok" && passok2 == "ok"){
			if(recpass1 != recpass2){
				$("#mensajeerror1").append("La contraseñas ingresadas deben ser iguales");
				$("#mensajeerror1").show();
				$("#mensajeerror2").append("La contraseñas ingresadas deber ser iguales");
				$("#mensajeerror2").show();
			}
			else {
				passokgen = "ok";
			}
		}
		if(passokgen == "ok"){
			var data = {'recpass1': recpass1};
			$.ajax({
				url :  baseurl + '/institucion/Modificarpassword3',
				type: "POST",
				dataType : "html",
				data : data,
				cache: false,
				success: function (response) {
					debugger;
					if(response == "actualizado"){
						$("#mensajepassok").modal('show');
					}
				} ,
				error: function (e) {
					console.log(e);
				}
			});
		}
	});

	function validarexpregContraseña(pass)
	{
		expr_regular = /^(?=.*\d{2})(?=.*[A-Z]).{0,20}$/;
		if(pass.length < 6  || pass.length > 15){
			return 1;
		}


		if(!(expr_regular.test(pass))){
			return 2;
		}
	}

	function validarpassword(pass)
	{
		var data = {'pass':pass};
		var errorpasstxt = "";
		alert(errorpasstxt);
		$.ajax({
			url :  baseurl + '/institucion/Modificarpassword2',
			type: "POST",
			dataType : "html",
			data : data,
			async : false,
			success: function (response){
				if(response == "errorpass"){
					errorpasstxt = "errorpass";
				}
			},
			error: function (e) {
				console.log(e);
			}
		});
		alert(errorpasstxt);
		return errorpasstxt;
	}
</script>