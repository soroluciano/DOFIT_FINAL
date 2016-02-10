        
  
  $(function(){
    $( "#sel1" ).change(function() {
      var id = $(this).children(":selected").attr("id");
      $("#id_actividad_selected").val(id);
    });
  }).trigger( "change" );
  
  function showComents(idpost){
    $("#post-footer-"+idpost).removeAttr("style");
  }
  
  /* function pusher para enviar los mensajes a todos los contactos  */
  
 
  function pushearMensaje(a){
    var _a = a;
    var pusher = new Pusher('c48d59c4cb61c7183954');    
    var canalnom = $('#canal').val();
    var canal  = pusher.subscribe(canalnom);
    canal.bind(_a, function(respuesta){
    });
    
    $.post(baseurl+'/php/ajax.php', {
      msj : this._a,
      canal : $('#canal').val(),
      socket_id : pusher.connection.socket_id
      },function(respuesta){
          getMensajesFromBase();
    });
    
      pusher.disconnect();
  }
  
  /*Traer las respuestas/comentarios por el id del post*/

  function getComentsByPost(idpost){  // trae los comentarios por id de post
    var position = $("#position_post_"+idpost).val();
    $.ajax({
      url:  baseurl+'/muro/getComentarios',
      type: 'POST',
      data: 'idposteo='+idpost+'&position='+position,
      success:function(response){
        $('#post_coment_'+idpost).html(response);
      },
    error: function(e){
      $('#logger').html(e.responseText);
    }});
  }
  
  
  /*RESPUESTAS*/
  
  function insertarRespuesta(a) {  //insertar las respuestas en los comentarios
    var _a = a;
    var comment = $("#txt_post_"+_a).val();
    //var pusher = new Pusher('c48d59c4cb61c7183954');    
    //var canalnom = $('#canal').val();
    //var canal  = pusher.subscribe(canalnom);
 
    //canal.bind(comment, function(respuesta){
    //});
    //
    //
    $.ajax({
      url:  baseurl+'/muro/insertarRespuesta',
      type: 'POST',
      data: 'respuesta='+comment+'&id_posteo='+_a,
      success:function(response){
           window.$isNewMsg.value='true';
           alert( "Data Saved: " + response );
           getComentsByPost(_a);
      },
      error: function(e){
        $('#logger').html(e.responseText);
      }
    });
    //
    //$.post(baseurl+'/php/ajax.php', {
    //  msj : this.comment,
    //  canal : $('#canal').val(),
    //  socket_id : pusher.connection.socket_id
    //},function(respuesta){
    //  showComents(this._a);
    //});
    //  pusher.disconnect();
    }

  
  $(function(){
      window.$postValue={}
      window.$isNewMsg={}
      window.$sizeMsgs={}
      window.$actualSizeMsgs={}
      window.$actualSizeMsgs.value=4;
      window.$channels={}
      window.$alertas={}

      var pusher = new Pusher('c48d59c4cb61c7183954');    

      getQuantityPosts();
      getCanales();
      var canal;
      var canalNom;
      var canales = new Array();
      if (window.$channels.length != 0) {
        for( $i=0; $i<window.$channels.length; $i++ ){
            canalNom = window.$channels[$i].nombre;
            canales.push(pusher.subscribe(canalNom));
            
        }
      }
      
      for( $j=0; $j<canales.length; $j++ ){
        canales[$j].bind('nuevo_comentario', function(respuesta){
          //validar si es mi id o el de otra persona
          //alert("por canales");
          //getMensajesFromBase();
        
          getAlertas();
        
        });
      }
      
    $('form').submit(function(){
      $.ajax({
        url:  baseurl+'/muro/insertarComentarioProfesor',
        type: 'POST',
        data: 'mensaje='+addVideo($('#input_mensaje').val())+'&id_actividad='+$('#id_actividad_selected').val(),
        success:function(response){
        alert( "Data Saved: " + response );
        window.$isNewMsg.value='true';
      },
      error: function(e){
        $('#logger').html(e.responseText);
      }
    });
    
    $.post(baseurl+'/php/ajax.php', {
      msj : $('#input_mensaje').val(),
      canal : $('#canal').val(),
      socket_id : pusher.connection.socket_id
    }
    ,function(respuesta){
      getMensajesFromBase();
    });
      pusher.disconnect();
      return false;
    });
  });
  
  
  function getMensajesFromBase(){
    $.ajax({
      url: baseurl+"/muro/mensajes",
      type: 'POST',
      //data: 'size='+size,
      success:function(response){
          $('#comentarios').html(response);
      },
      error: function(e){
        $('#logger').html(e.responseText);
      }
    });
  }
  
    function getMensajesFromBase2(size){
    $.ajax({
      url: baseurl+"/muro/mensajes",
      type: 'POST',
      data: 'size='+size,
      success:function(response){
        $('#comentarios').html(response);
      },
      error: function(e){
        $('#logger').html(e.responseText);
      }
    });
  }
  
  function getMoreMsgs(){//utilizar solo en el boton de + posts
    var size = window.$sizeMsgs.value;
    var actualsize = window.$actualSizeMsgs.value;

    if (actualsize<size) {
        actualsize+=4;
        window.$actualSizeMsgs.value=actualsize;
        getMensajesFromBase2(actualsize);  
    }
    if (actualsize >= size) {
      $("#boton_mas_comentarios").html("");
    }
    
  }
  
  
  function editComment(idcoment) //funcion de la seleccion de edicion de comentario
  {
    $("#post-description-"+idcoment+" .edit-details-textarea").css("display","block");
    $("#post-description-"+idcoment+" .details").css("display","none");
    $("#post-description-"+idcoment+" .btn-ed-fin").css("display","block");
    $("#post-description-"+idcoment+" .btn-cancel-comment").css("display","block");
    $("#post-description-"+idcoment+" .div-ed-comment").css("height","100px"); 
    $("#post-description-"+idcoment+" .div-ed-comment").css("visibility","visible");

    $("#post-description-"+idcoment+" div.div-btns-comment").show();
    $("#post-description-"+idcoment+" post-description").show();
    $valor = ($("#post-description-"+idcoment+" .details").html());
    $("#post-description-"+idcoment+" .edit-details-textarea").html($valor);
  }
  
  function closeComment(idcoment) //funcion para el cierre de comentario en seleccion
  {
    //$("#post-description-"+idcoment+" .edit-details-textarea").val($postValue.valor);
    $("#post-description-"+idcoment+" .edit-details-textarea").css("display","none");
    $("#post-description-"+idcoment+" .details").css("display","block");
    $("#post-description-"+idcoment+" .btn-ed-fin").css("display","none");
    $("#post-description-"+idcoment+" .btn-cancel-comment").css("display","none");
    $("#post-description-"+idcoment+" .div-ed-comment").css("visibility","hidden");
     $("#post-description-"+idcoment+" .div-ed-comment").css("height","1");
  }
  
  function updateComent(idposteo)
  {
    alert($("#post-description-"+idposteo+" .edit-details-textarea").val());
    $.ajax({
      url:  baseurl+'/muro/updateComentarioProfesor',
      type: 'POST',
      data: 'mensaje='+$("#post-description-"+idposteo+" .edit-details-textarea").val()+'&id_posteo='+idposteo,
      success:function(response){
      alert( "Data Saved: " + response );
      pushearMensaje();
      window.$isNewMsg.value='true';
    },
      error: function(e){
        $('#logger').html(e.responseText);
      }
    });
  
  }
  
  function  indicateIdPost(args) {
    $postValue.valor=args;
    appendModal();
  }
  
  
  
  function deleteComent(){
    $idposteo = $postValue.valor;
      $.ajax({
        url:  baseurl+'/muro/deleteComentarioProfesor',
        type: 'POST',
        data: 'id_posteo='+$idposteo,
        success:function(response){
          alert( "Data deleted: " + response );
          window.$isNewMsg.value='true';
          pushearMensaje('deleted');
        },
        success:function(e){
          deleteModal();
          getMensajesFromBase();
        },
        error: function(e){
          $('#logger').html(e.responseText);
        }
     });
    
  }

   
   function getMensajesConDelay(){
       setInterval("getMensajesFromBase()",50000);
   }
   
   
   function appendModal(){
        var modal;
        modal ="<div class='modal fade in' id='popborrar' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' data-backdrop='static' data-keyboard='true'>";
        modal+="<div class='modal-dialog' role='document'>"
        modal+="<div class='modal-content'>"
        modal+="<div class='modal-header'>"
        modal+="<button type='button' class='close' data-dismiss='modal' aria-label='Close' onclick=''><span aria-hidden='true'>&times;</span></button>"
        modal+="<h4 class='modal-title' id='exampleModalLabel'><b>Eliminar publicaci&oacute;n</b></h4></div>";
        modal+="<div class='modal-body'>";
        modal+="<p>¿Seguro que quieres eliminar esto?</p>";
        modal+="<form name='formulario' id='formulario' class='formulario'>";
        modal+="<div class='modal-footer'>";
        modal+="<button type='button'  class='btn btn-default' data-dismiss='modal' onclick='deleteModal();'>Cerrar</button>";
        modal+="<button type='button'  onclick='deleteComent();' class='btn btn-success green' data-dismiss='modal'>Eliminar publicaci&oacute;n</button>";	
        modal+="</div>";
        modal+="</form>";
        modal+="</div>";
        modal+="</div>";
        modal+="</div>";
        modal+="</div>";
        $("#coment_n_"+ $postValue.valor).append(modal);
   }
   
   function deleteModal(){
     $("#popborrar").remove();
   }
   
  function ocultarEdicion(){
    debugger;
    $(".div-ed-comment").hide();
    $(".edit-details-textarea").hide();
    $(".btn-ed-fin").hide();
    $(".btn-cancel-comment").hide();
    $(".div-ed-comment").css("visibility","hidden");
    $("div.div-btns-comment").hide();
    $("post-description").hide();
    $(".div-ed-comment").removeAttr("height");

    
    
  }
  
    function ocultarEdicionInicial(){
      debugger;
      $(".div-ed-comment").hide();
      $(".edit-details-textarea").hide();
      $(".btn-ed-fin").hide();
      $(".btn-cancel-comment").hide();
      $(".div-ed-comment").css("visibility","hidden");
      $("div.div-btns-comment").hide();
      $("post-description").hide();
      $(".div-ed-comment").css("height","1");

  }
  
  function getQuantityPosts(){
     $.ajax({
        url:  baseurl+'/muro/quantityOfPosts',
        type: 'POST',
        data: {},
        success:function(response){
          window.$sizeMsgs.value=response;
        },
        error: function(e){
          $('#logger').html(e.responseText);
        }
     });
    
  }
  
  function getCanales() {
    $.ajax({
      url: baseurl+'/muro/getCanales',
      type: 'POST',
      dataType: "json",
      async:false,
      data: {},
      success:function(response){
          window.$channels=response;  
      },
      error: function(e){
        alert("error");
      }
    });
  }
  
  function getAlertas(){
      var alertas = window.$alertas.value;
      if (alertas==null) {
        alertas = 1;
      }else{
        alertas++;
      }
      window.$alertas.value=alertas;
      //alert(alertas);
      $("#notificacion").html(alertas);
  }
  
  function resetAlertas(){
    window.$alertas.value=0;
    $("#notificacion").html("");
  }

   
    
        
