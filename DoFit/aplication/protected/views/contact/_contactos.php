
            <div class="panel modified col-md-8 col-xs-8">
<!--                <div class="panel-heading c-list">

                </div>-->
                <!--
				 <ul class="list-group" id="contact-list">-->
						<?php
								$val = new ArrayObject();
								foreach($contactos as $cn){
										$usuario = Usuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$cn['id_usuario']));  
										$ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$cn['id_usuario']));
											
											echo "<div id='left'>";
												 echo "<div id='foto' class='col-xs-4 col-sm-3'>";
													  //$imagen = Imagen::model()->find('id_usuario=id_usuario',array(':id_usuario'=>$cn['id_usuario']));
													  $perfil = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$cn['id_usuario']));
													  if($perfil->fotoperfil!=null){
															  echo "<img src='".Yii::app()->request->baseUrl."/uploads/".$perfil->fotoperfil."' onclick='getProfileFriend(".$cn['id_usuario'].")' class='img-circle' style='cursor:pointer' />";
													  }else{
															  echo "<img src='".Yii::app()->request->baseUrl."/images/profile_defect_picture.png' class='img-circle' style='cursor:pointer' />";
													  }
												 echo "</div>";	 
												 echo  "<div id='datos'>
															 <span class='glyphicon glyphicon-envelope' data-toggle='tooltip'> <a style='cursor:pointer;' href='mailto:".$usuario->email."'>".$usuario->email."</a></span><br/>
															 <span class='glyphicon glyphicon-earphone' data-toggle='tooltip'> ".$ficha->celular."</span><br/>	  
															 <span class='glyphicon glyphicon-camera'   data-toggle='tooltip'> <a style='cursor:pointer;' onclick='return getGaleria($usuario->id_usuario);';'>Galeria</a></span><br/>	  																	  
													   </div>";	 
											 echo "</div>";
										     
											 echo "<div id='right'>";
												 echo "<div id='data'>";				  
														echo "<span class='name'>".$ficha->nombre." ".$ficha->apellido."</span><br/>";
														 echo "<span id='descrip_span'>".$perfil->descripcion."</span></br>";
												 echo "</div>";
											 echo "</div>";
										     
											 echo "<div class='clearfix'></div>";
										
											
						
								}
						?>
						

        <!--        </ul>-->

            </div>

	</div>
		<div id="galeria"></div>
    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
    
</div>
