
<?php
		if ($respuestas != null) {
		foreach ($respuestas as $respuesta) {
				
				
		    $fhultmod = strtotime($respuesta['fhultmod']);
		    $fhcreacion = strtotime($respuesta['fhcreacion']);
			$fhultmodFormated = date('d/m/Y g:i A', $fhultmod);
			$fhcreacionFormated = date('d/m/Y g:i A', $fhcreacion);
			$timeInZero = date('d/m/Y g:i A', strtotime('0000-00-00 00:00:00'));
			$finaltime;
		    if($fhultmodFormated == $timeInZero){$finaltime=$fhcreacionFormated;}else{$finaltime=$fhultmodFormated;}
		
				
			echo "
			<li class='comment'>
				<a class='pull-left' href='#'>";
					if(($respuesta['fotoPerfil']!=null)&&($respuesta['fotoPerfil']!="profile_defect_picture.png")){
						echo "<img src='".Yii::app()->request->baseUrl."/uploads/".$respuesta['fotoPerfil']."' class='avatar' alt='avatar'>";
				   }else{
						echo "<img src='".Yii::app()->request->baseUrl."/images/profile_defect_picture.png' "."class='avatar' alt='avatar'>";
				  }	
				     
					  
			echo"</a>
				<div class='comment-body'>
					<div class='comment-heading'>
						<h4 class='user'>".$respuesta['nombre']." ".$respuesta['apellido']."</h4>
						<h5 class='time'>".$finaltime."</h5>
					</div>
				    <p class='description-respuesta'>".$respuesta['respuesta']."</p>
				    <!--<a href='#' class='editresp' title='Editar' role='button' data-toggle='dropdown' aria-haspopup='true'><span><i class='glyphicon glyphicon-edit'/></span></a> 
					   <ul class='dropdown-menu editresp-menu' aria-labelledby='dropdownMenu'>
						   <li><a href='javascript:alert(".$respuesta['id_respuesta'].")'>Editar</a></li>
						   <li><a href='' onclick='alert(".$respuesta['id_respuesta'].")' data-toggle='modal' data-target='#popborrar')'>Eliminar</a></li>
					   </ul>-->
				</div>
			</li>";
		}
			if($show){
				echo "<input type='hidden' value='$position' id='position_post_$idposteo'/>";
				echo "<input type='button' class='btn-like-link' onclick='getComentsByPost($idposteo);' value='Ver mas comentarios'/>";  
			}
		}
        
?> 