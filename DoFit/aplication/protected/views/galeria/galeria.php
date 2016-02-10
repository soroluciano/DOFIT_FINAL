<div id="seccion_imagenes">
			<div id="img-seccion">
				<span class='title'>Imagenes</span>
				
				<div class="div-button">
				<?php
					echo "<button type='button' id='btnNuevo' title='Subir nueva imagen' class='btn btn-primary right' data-toggle='modal' data-target='#FORMULARIO-REGISTRO' data-whatever'@getbootstrap'>Nueva Foto</button>";
				?>
				</div>
				
			</div>
			
			<div class="imagenes">
						
						<?php $this->renderPartial('_imagenes'); ?>
						
			</div>
							
			<div  class="modal fade" id="FORMULARIO-REGISTRO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="true">
			   <div class="modal-dialog" role="document">
				   <div class="modal-content">
					   <div class="modal-header">
						   <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cleanAll()"><span aria-hidden="true">&times;</span></button>
						   <h4 class="modal-title" id="exampleModalLabel">Nueva Imagen</h4>
					   </div>
					   <div class="modal-body">
						   <form name="formulario" id="formulario" class="formulario">
							   
							   <div id="upload-file-container" class="form-group">
								   <label for="message-text" class="control-label">Imagen:</label>
								   <br>
								   <input name="file" type="file" id="imagen" title="Buscar imagen" class="btn btn-default"/>
							   <div class="messages oculto"></div>
							   <div class="showImage"></div>
							   <div class="modal-footer">	
								   <button type="button"  onclick="cleanAll();" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								   <input type="button" class="btn btn-primary" id="subirimagenbutton" value="Subir imagen" disabled/>
							   </div>		
						   </form>
					   </div>
				   </div>
			   </div>
			  </div>
			</div>
				
</div>

