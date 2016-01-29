<div class="cabecera-perfil">
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
						<li><span><a href="javascript:info();" >Edita tu perfil</a></span></li>		
				</ul>
		</div>
		<div class='profile_publicaciones'>
				<ul>
						<li><a href='<?php echo Yii::app()->request->baseUrl;?>/contact/index' style="cursor:pointer;"><span class="glyphicon glyphicon-user red"></span>Contactos</a></li>		
						<li><a href='<?php echo Yii::app()->request->baseUrl;?>/galeria/index' style="cursor:pointer;"><span class="glyphicon glyphicon-picture light-green"></span>Imagenes</a></li>		
				</ul>
		</ul>		
		<div class='profile_friends_fotos'>
				<ul>
						<li><a href='<?php echo Yii::app()->request->baseUrl;?>/contact/index' style="cursor:pointer;"><span class="glyphicon glyphicon-user red"></span>Contactos</a></li>		
						<li><a href='<?php echo Yii::app()->request->baseUrl;?>/galeria/index' style="cursor:pointer;"><span class="glyphicon glyphicon-picture light-green"></span>Imagenes</a></li>		
				</ul>
		</div>

</div>	<!-- fin cabecera perfil -->	
       </div>
       <div>