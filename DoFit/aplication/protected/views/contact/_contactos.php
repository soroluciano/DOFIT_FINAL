
            <div class="panel modified col-md-8 col-xs-8">
<!--                <div class="panel-heading c-list">

                </div>-->
                
				 <ul class="list-group" id="contact-list">
						<?php
								$val = new ArrayObject();
								foreach($contactos as $cn){
										$usuario = Usuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$cn['id_usuario']));  
										$ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$cn['id_usuario']));
									echo"<li class='list-group-item'>
												 <div id='foto' class='col-xs-4 col-sm-3'>";
												 //$imagen = Imagen::model()->find('id_usuario=id_usuario',array(':id_usuario'=>$cn['id_usuario']));
												 $perfil = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$cn['id_usuario']));
												 if($perfil->fotoperfil!=null){
														 echo "<img src='".Yii::app()->request->baseUrl."/uploads/".$perfil->fotoperfil."' onclick='getProfileFriend(".$cn['id_usuario'].")' width='150px' height='150px' class='img-circle' style='cursor:pointer' />";
												 }else{
														 echo "<img src='".Yii::app()->request->baseUrl."/images/profile_defect_picture.png'  width='120px' height='120px' class='img-circle' style='cursor:pointer' />";
												 }
												 
											 echo"</div>
												 <div class='col-xs-12 col-sm-9'>
															   <div id='data'>
																	  <span class='name'>".$ficha->nombre." ".$ficha->apellido."</span><br/>
																	  <span class='glyphicon glyphicon-envelope' data-toggle='tooltip'> <a href='mailto:".$usuario->email."'>".$usuario->email."</a></span><br/>
																	  <span class='glyphicon glyphicon-earphone' data-toggle='tooltip'> ".$ficha->celular."</span><br/>	  
																	  <span class='glyphicon glyphicon-camera'   data-toggle='tooltip'><input type='button' onclick='getGaleria($usuario->id_usuario);' value='galeria'></span><br/>	  
																	  
																	  <!--<span class='glyphicon glyphicon-camera' data-toggle='tooltip'> Mensaje privado</span><br/>-->
															  </div>
												 </div>
												 
												 <div class='clearfix'></div>
										</li>";
											
						
								}
						?>
						

                </ul>

            </div>

	</div>
		<div id="galeria"></div>
    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
    
</div>
