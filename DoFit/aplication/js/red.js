    function galeria(){
            var algo = baseurl;
            //showLoader = setTimeout("$('#loadingImage').show()", 300);
            $("#btn_galeria").addClass("active");
            $("#btn_info").removeClass("active");
    
            $.ajax({
                url: baseurl+'/red/galeria',
                type: 'post',
                //data: { },
                success:function(response){
                  debugger;
                  
                    $('#respuesta_ajax').html(response);
                   // no funciona $('#comentarios').empty();
    
                },
                error: function(e){
                    $('#logger').html(e.responseText);
                }
            });
      }
    
      function uploaderMax(){
      var file = {};
      var file = $('#FileUpload_foto')[0];
      
      var formData = new FormData(file);
    
         $.ajax({
                url: baseurl+'/red/prueba2',
                type: 'POST',
                data:  formData,
    
                success:function(response){
                    $('#respuesta_ajax').html(response);
                },
                error: function(e){
                    $('#logger').html(e.responseText);
                },
          cache: false,
          contentType: false,
          processData: false
            });
        return false;
      }

      function nuevaImagen(){
          $.ajax({
                url: baseurl+'/red/nuevaImagen',
                type: 'post',
                data: { },
                success:function(response){
                    $('#respuesta_ajax').html(response);
    
                },
                error: function(e){
                    $('#logger').html(e.responseText);
                }
            });
      }
	
    /*cristian*/
    
	function grabarImagen(imgName){
		debugger;
		
		$.ajax({
            url: baseurl+'/red/saveImagen',
            type: 'POST',
            data: 'data='+imgName,
            success:function(response){
            },
            error: function(e){
              
            }
        });
	}
	
	
	
    function isImage(extension)
    {
        switch(extension.toLowerCase())
        {
            case 'jpg': case 'gif': case 'png': case 'jpeg':
                return true;
            break;
            default:
                return false;
            break;
        }
    }
    
    
    
   $(document).ready(function(){
      //queremos que esta variable sea global 
      var fileExtension = "";
      var saved = false;
      //función que observa los cambios del campo file y obtiene información
        
        $(':file').change(function()
        {
            debugger;
            //obtenemos un array con los datos del archivo
            var file = $("#imagen")[0].files[0];
            //obtenemos el nombre del archivo
            var fileName = file.name;
            //obtenemos la extensión del archivo
            fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
            //obtenemos el tamaño del archivo
            var fileSize = file.size;
            //obtenemos el tipo de archivo image/png ejemplo
            var fileType = file.type;
            //mensaje con la información del archivo
            //showMessage("<span class='info'>"+fileName+".</span>");
            $("#subirimagenbutton").prop('disabled', false);   
            
        });
     
        //al enviar el formulario
        $('#subirimagenbutton').click(function(){
            //información del formulario
            debugger;
            var formData = new FormData($(".formulario")[0]);      
            var message = "";
            //hacemos la petición ajax
            var saved = false;
            $.ajax({
                url: baseurl+'/php/upload.php',  
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                    alert(message)        
                },
                success: function(data){
                    message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                    alert(message);
              
                    if(isImage(fileExtension))
                    {
                        //alert(data);
                        $(".showImage").html("<img  width='150px' height='150px' src='"+baseurl+"/uploads/"+data+"' />");
                        $("#imagendeperfil").val(data);
                        if(saved == false) {
                            grabarImagen(data);
                            saved = true;
                        }
                      
                    }
                    
                     setTimeout(function(){
                        saved=false;
                        closeModal();
                        resetUploader();
                     
                        }, 2000
                     );
                     
	
                },
                //si ha ocurrido un error
                error: function(){
                    saved=false;
                    message = $("<span class='error'>Ha ocurrido un error.</span>");
                    alert(message);
                }
            });
        });
    })
    
    function resetUploader(){
      $(".showImage").html("");
      
    }


   function showModal(){
      debugger;
            $('#FORMULARIO-REGISTRO').attr("aria-hidden","false");
            $('#FORMULARIO-REGISTRO').attr("display","true");
            //$('#FORMULARIO-REGISTRO').css("position","static");
   }

   function closeModal() {
   
         debugger;
         //$('#FORMULARIO-REGISTRO').modal('hide');
         //$('#FORMULARIO-REGISTRO').removeClass('in');
         //$('#FORMULARIO-REGISTRO').attr('style','display: none;');
         //$('#FORMULARIO-REGISTRO').attr('aria-hidden','true;');
         
         $('#FORMULARIO-REGISTRO').modal('hide');
         $('body').removeClass('modal-open');
         //$('.modal-backdrop').remove();
         
         //$('.modal-backdrop').removeClass('in');
         $('.modal-backdrop').remove();
       //  $('#FORMULARIO-REGISTRO').modal()
           mostrarImagenes();
     
   }
   

   
   function mostrarImagenes() {
      getPage(0);
   }

   
  
   
   function cleanComentarios(){
          $('#comentarios').html("");
          $('#boton_mas_comentarios').html("");    
   }
   
   function cleanCompaneros() {
         $('#comentarios').html("");
   }
   
   
   function getProfileFriend (id){
          $.ajax({
            url: baseurl+'/red/amigo',  
            type: 'POST',
            data: 'id='+id,
            success:function(response){
                 
            },
            error: function(e){
               alert(e);
            }
        });
   }
  
  function addImage(args) {
        //code
  }
  function addVideo(args) {
      
  }
  
  function addTagVideo(){
        debugger;
        res = "[youtube]"+$("#video").val()+"[/youtube]";      
        $('#input_mensaje').append(res);
  }
  
  
  
  