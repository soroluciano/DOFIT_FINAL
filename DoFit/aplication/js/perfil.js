       function cleanAll(){       document.getElementById("formulario").reset();       $(".file-input-name").html('');        $(".messages").html('');        $(".showImage").html('');        $("#subirimagenbutton").prop('disabled', true);       }        function registerMessages() {				var idusuarioori = $("#idusuarioori").val();        var idusuariodes = $("#idusuariodes").val();         var idusuario = $("#idusuario").val();         var mensaje = $("#mensaje").val();         $.ajax({             type : "POST",             url :  baseurl+'/perfilSocial/registrarMensaje',             data:'idusuariodes='+idusuariodes+'&mensaje='+mensaje,         }).done(function(info){             $("#mensaje").val("");         })         			}	function cargarMensajesAntiguos() {		var idusuario = $("#idusuariodes").val();         if (typeof idusuario === "undefined") {            idusuario =0;         }          if (idusuario != 0) {             $.ajax({             type : "POST",             url :  baseurl+'/perfilSocial/mostrarConversaciones',             data : {idusuariodes:idusuario}         }).done(function(info){             $("#conversaciones").html(info);         });         }      	}        function borrarMensajes(){      	$("#borrarmensajes").on("click",function(){		var valor = $("#valor").val(0);		var idusuarioborr = $("#idusuario").val();		confirmar=confirm("¿Esta seguro que desea borrar todos los mensajes?");		if (confirmar) {			valor.val(1);		}		var valorcar = valor.val();		var data = { "idusuario":idusuarioborr,"valor":valorcar};		$.ajax({			url : baseurl+'/perfilSocial/borrarMensajes',			type: "POST",			dataType : "json",			data : data		})	});    }        $(function(){      fillProvincia();      fillLocalidad(0);      //provincia      $('#provincia').on('change', function() {      var str = "";      $( "#provincia option:selected" ).each(function() {        fillLocalidad(this.id)      });});   /*     registerMessages();		$.ajaxSetup({"cache":false});		setInterval("cargarMensajesAntiguos()",500);     */                 });      	    function info(){            showLoader = setTimeout("$('#loadingImage').show()", 300);        $("#btn_galeria").removeClass("active");        $("#btn_info").addClass("active");        $.ajax({            url: baseurl+'/perfilSocial/informacion',            type: 'post',            data: { /*raza: valor, sexo: sx */},            success:function(response){                $('#respuesta_ajax').html(response);            },            error: function(e){                $('#logger').html(e.responseText);            }        });    }    function edicion(){        showLoader = setTimeout("$('#loadingImage').show()", 300);        $.ajax({            url: baseurl+'/perfilSocial/edicion',            type: 'post',            data: { /*raza: valor, sexo: sx */},            success:function(response){                $('#respuesta_ajax').html(response);            },            error: function(e){                $('#logger').html(e.responseText);            }        });    }    function edicionInfo(){        showLoader = setTimeout("$('#loadingImage').show()", 300);        $.ajax({            url: baseurl+'/perfilSocial/edicionInfo',            type: 'post',            data: { /*raza: valor, sexo: sx */},            success:function(response){                $('#respuesta_ajax').html(response);            },            error: function(e){                $('#logger').html(e.responseText);            }        });    }  function fillProvincia(){        $.ajax({            url: baseurl+'/perfilSocial/fillProvincia',            type: 'post',            data: { /*raza: valor, sexo: sx */},            success:function(response){                $('#provincia').append(response);            },            error: function(e){                $('#logger').html(e.responseText);            }        });  }  function fillLocalidad(valor) {             $.ajax({            url: baseurl+'/perfilSocial/fillLocalidad',            type: 'post',            data: 'id='+ valor,            success:function(response){                          $('#localidad')                .find('option')                .remove()                .end()                .append(response);            },            error: function(e){                $('#logger')                                .html(e.responseText);            }        });  }       function validateData() {     $.ajax({            url: baseurl+'/perfilSocial/updateDatos',            type: 'post',            async:true,            dataType: "json",            data: 'telfijo='+ $("#a_6").val()+'&celular='+$("#a_7").val()+'&conemer='+$("#a_8").val()+'&telemer='+$("#a_9").val()+'&direccion='+$("#b_3").val()+'&piso='+$("#b_4").val()+'&depto='+$("#b_5").val(),            success:function(response){            $('.alert').remove();            if(response.saved=="no"){              $("#columnas-inputs").prepend("<div class='alert alert-danger alert-size'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Lo sentimos!</strong> Revise su informaci&oacute;n y vuelva a intentar</div>");              if (response.telefono!="ok") {                $(".a_6").empty();                $(".a_6").append(response.telefono);              }else{                 $(".a_6").empty();              }              if (response.celular!="ok") {                  $(".a_7").empty();                  $(".a_7").append(response.celular);              }else{                 $(".a_7").empty();              }                if (response.conemer!="ok") {                  $(".a_8").empty();                  $(".a_8").append(response.conemer);              }else{                 $(".a_8").empty();              }              if (response.telemer!="ok") {                  $(".a_9").empty();                  $(".a_9").append(response.telemer);              }else{                 $(".a_9").empty();              }              if (response.direccion!="ok") {                  $(".b_3").empty();                  $(".b_3").append(response.direccion);              }else{                 $(".b_3").empty();              }              if (response.piso!="ok") {                  $(".b_4").empty();                 $(".b_4").append(response.piso);              }else{                 $(".b_4").empty();              }              if (response.depto!="ok") {                  $(".b_5").empty();                 $(".b_5").append(response.depto);              }else{                 $(".b_5").empty();              }            }else{                  $("#columnas-inputs").prepend("<div class='alert alert-success alert-size'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Exitos!</strong> Su informacion se ha guardado exitosamente</div>");                            }            },            error: function(e){            }        });          }    function addDescription(){      $(".desc").remove();    $("#descripcion_personal").append("<div id='area-edit'><textarea  maxlength='185'></textarea><input type='button' class='btn btn-success btn-xs but'value='guardar'><input type='button' class='btn btn-primary btn-xs but'value='cancelar'></div>");      }      	function saveImagen(imgName){		debugger;				$.ajax({            url: baseurl+'/perfilSocial/saveImagen',            type: 'POST',            data: 'name='+imgName,            success:function(response){                  alert("respuesta grabar imagen "+response)            },            error: function(e){              alert("error");            }        });	}			    function isImage(extension)    {        switch(extension.toLowerCase())        {            case 'jpg': case 'gif': case 'png': case 'jpeg':                return true;            break;            default:                return false;            break;        }    }        $(function(){      var fileExtension = "";      var saved = false;      $(':file').change(function()        {            debugger;            //obtenemos un array con los datos del archivo            var file = $("#imagen")[0].files[0];            //obtenemos el nombre del archivo            var fileName = file.name;            //obtenemos la extensión del archivo            fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);            //obtenemos el tamaño del archivo            var fileSize = file.size;            //obtenemos el tipo de archivo image/png ejemplo            var fileType = file.type;            //mensaje con la información del archivo            //showMessage("<span class='info'>"+fileName+".</span>");            $("#subirimagenbutton").prop('disabled', false);                       });    });                   function saveImagen(){            //información del formulario            debugger;            var formData = new FormData($(".formulario")[0]);                  var message = "";            //hacemos la petición ajax            var saved = false;            $.ajax({                url: baseurl+'/php/upload.php',                  type: 'POST',                data: formData,                async: true,                cache: false,                contentType: false,                processData: false,                beforeSend: function(){                   var message = "Subiendo la imagen, por favor espere...";                    alert(message)                        },                success: function(data){                    var message = "La imagen ha subido correctamente.";                    alert(message);                                  //if(isImage(fileExtension)){                        if(saved == false) {                            saveImagen(data);                            saved = true;                        }                                          //}                                         setTimeout(function(){                        saved=false;                        closeModal();                        resetUploader();                                             }, 2000                     );                },                //si ha ocurrido un error                error: function(){                    saved=false;                    message = "Ha ocurrido un error";                    alert(message);                }            });     }        function resetUploader(){      $(".showImage").html("");          }   function showModal(){          $('#FORMULARIO-REGISTRO').attr("aria-hidden","false");          $('#FORMULARIO-REGISTRO').attr("display","true");   }   function closeModal() {          $('#FORMULARIO-REGISTRO').modal('hide');         $('body').removeClass('modal-open');         $('.modal-backdrop').remove();         reloadImagePerfil();   }     function reloadImagePerfil(){           $.ajax({            url: baseurl+'/perfilSocial/getImage',            type: 'post',            data: '',            success:function(response){              $("#iprofile").remove();              $("#img-profile").prepend(response);            },            error: function(e){                $('#logger').html(e.responseText);            }        });  }    function chatToFriend(id) {             $.ajax({            url: baseurl+'/perfilSocial/chat',            type: 'post',            data: 'id='+id,            success:function(response){                  $("#chat").remove();                  $("#friend-chat").html(response);               },            error: function(e){                $('#logger').html(e.responseText);            }        });             }