<div class="cabecera-perfil" style="margin-top:40px;">
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
						<li><span><?php echo $nombre." ".$apellido; ?></span></li>		
						<li><span><a href='<?php echo Yii::app()->request->baseUrl;?>/perfilSocial/index' style="cursor:pointer;">Edita tu perfil</a></span></li>		
				</ul>
		</div>
		<div id="secciones" class="">
			<a href='<?php echo Yii::app()->request->baseUrl;?>/contact/index' style="cursor:pointer;"><span class="glyphicon glyphicon-user" style="padding-right:2px;"></span>Contactos</a>
			<a href='<?php echo Yii::app()->request->baseUrl;?>/galeria/index' style="cursor:pointer;"><span class="glyphicon glyphicon-picture" style="padding-right:2px;"></span>Imagenes</a>
			<a href='<?php echo Yii::app()->request->baseUrl;?>/red/index' style="cursor:pointer;"><span class="glyphicon glyphicon-globe"></span><span class="alerta_new" id="notificacion"></span>Notificaciones</a>	


</div>	<!-- fin cabecera perfil -->	
