

<?php
	function getActividadDescription($id){
		$result="";
		$aid = (int)$id;
		$resultSet = Yii::app()->db->createCommand('select d.deporte,f.nombre from actividad a inner join deporte d on a.id_deporte=d.id_deporte inner join ficha_institucion f on a.id_institucion=f.id_institucion where id_actividad='.$aid)->queryAll();
			foreach($resultSet as $row) {	
			$result = $row['nombre']." - ".$row['deporte'];
		
		}
		
		return $result;
	}

    if ($resultSet != null) {
      foreach($resultSet as $row) {
          echo "
		  <script>ocultarEdicionInicial();</script>
      
      <!--<div class='espacio-paneles size-panel'>-->
		
	  <div class='panel-sized'>
        <div class='panel panel-white post panel-shadow' id='coment_n_".$row['id_posteo']."'>
        		<div id='actividad'>
				  <span>".getActividadDescription($row['id_actividad'])."</span>
				</div>
            <div class='post-heading'>
		      <div class='pull-left image'>";
			  if(($row['fotoPerfil'] == null) || ($row['fotoPerfil'] == 'profile_defect_picture.png')){
				echo "<img src='".Yii::app()->request->baseUrl."/images/profile_defect_picture.png' class='img-thumbnail avatar' width='120px' height='120px' alt='user profile image'>";
			  }
			  else{
				echo "<img src='".Yii::app()->request->baseUrl."/uploads/".$row['fotoPerfil']."' class='img-thumbnail avatar' width='120px' height='120px' alt='user profile image'>";	
			  }    
		echo "</div>
              <div class='pull-left meta'>
                <div class='title h5'>
                  <a href=''><b>".$row['nombre']." ".$row['apellido']."</b></a>
                </div>
                <!--<h6 class='text-muted time'>1 minute ago</h6>-->
              </div>

			  <div class='pull-left edicion e_size'>";
        if($usuario==$row["id_usuario"]){
          echo "<div class='dropdown'>
            <button class='btn-edit-post' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>...</button>
            <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
            <li><a href='javascript:editComment(".$row['id_posteo'].")'>Editar</a></li><!--data-toggle='modal' data-target='#popborrar'-->
            <li><a href='javascript:indicateIdPost(".$row['id_posteo'].")' >Eliminar</a></li>
            </ul>
          </div>";
        }
			 echo "
       </div>
  </div>

			<div class='post-description' id='post-description-".$row['id_posteo']."'> 
			  <p class='details'>".$row['posteo']."</p>
			  <div class='div-ed-comment'>
				<textarea class='edit-details-textarea'>".html_entity_decode($row['posteo'])."</textarea>
				<div class='div-btns-comment'>  
				  <input type='button' class='btn-ed-fin btn btn-success green' onclick='updateComent(".$row['id_posteo'].")' value='Edicion terminada'/>
				  <input type='button' class='btn-cancel-comment btn btn-default' onclick ='closeComment(".$row['id_posteo'].")' value='Cancelar'/>
				</div>
			  </div>

			  </div>


			  <div class='post-footer' id='post-footer-".$row['id_posteo']."'>
				<div class='input-group'> 
				  <input class='form-control' placeholder='Escribe un comentario' type='text' id='txt_post_".$row['id_posteo']."'>
				  <span class='input-group-addon'>
					<input type='submit' class='btn-comment' id='".$row['id_posteo']."' onclick='insertarRespuesta(this.id);' value='Comentar'/>
				  </span>
				</div>";
             
		  echo  "<script>$('#post-footer-".$row['id_posteo']."').load(getComentsByPost(".$row['id_posteo']."));</script>
                <ul class='comments-list' id='post_coment_".$row['id_posteo']."'></br>
                </ul>
             </div>
             </div>
		   
       <!--</div>-->
		   </div>";
                       
      }
    }

        

?>