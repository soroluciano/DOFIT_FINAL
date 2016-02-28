<div class="cabecera-perfil" style="margin-top:40px; font-size: large;">
		<?php if($perfil->fotoperfil){ ?>
				<div class="profile_img">
				<img src="<?php echo Yii::app()->request->baseUrl;echo "/uploads/".$perfil->fotoperfil; ?>" alt="Generic placeholder image" class="img-circle img-profile">
				</div>
		<?php } else{ ?>
				<div class="profile_img">
						<img src="<?php echo Yii::app()->request->baseUrl;echo "/images/profile_defect_picture.png"; ?>" alt="Generic placeholder image" width="60" height="60" class="img-circle img-profile">
				</div>	
		<?php } ?>

		<div class="profile_info">	
				<ul>
						<li><span id='nap'><?php echo $nombre." ".$apellido; ?></span></li>		
						<li><a href='<?php echo Yii::app()->request->baseUrl;?>/perfilSocial/index' style="cursor:pointer;font-size:14px;">Edita tu perfil</a></li>		
				</ul>
		</div>
		<div id="secciones" class="">
			<a href='<?php echo Yii::app()->request->baseUrl;?>/contact/index' style="cursor:pointer;"><span class="glyphicon glyphicon-user" style="padding-right:2px;"></span>Contactos</a>
			<a href='<?php echo Yii::app()->request->baseUrl;?>/galeria/index' style="cursor:pointer;"><span class="glyphicon glyphicon-picture" style="padding-right:2px;"></span>Imagenes</a>
		    <span class="glyphicon glyphicon-globe" onclick="getMensajesFromBase();resetAlertas();" style="cursor:pointer;"></span><span onclick="getMensajesFromBase();resetAlertas();" style="cursor:pointer;" class="alerta_new" id="notificacion"></span> <a href='<?php echo Yii::app()->request->baseUrl;?>/red/index' style="cursor:pointer;">Notificaciones</a>	
			<input type='hidden' id='canalselected'/>	
</div>	<!-- fin cabecera perfil -->	
