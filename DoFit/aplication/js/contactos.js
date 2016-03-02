    $(function(){
        $(".fancybox").fancybox();  
      
      
    });





function getStringIds(){
  debugger;
   var res = window.$saved_tokens;
    var re = new Array ;
   for(var j=0; j<res.length; j++){
    re[j]=res[j].id; 
   }
  return re;
}

 function getContactos() {
    debugger;
      $.ajax({
      url: baseurl+'/contact/getContactos',  
      type: 'POST',
      data: 'busqueda='+getStringIds(),
      success:function(response){
        $('#respuesta_ajax').empty();
         $('#respuesta_ajax').html(response);          
      },
      error: function(e){
         alert(e);
      }
    });
}
   function getGaleria(id) {
    
    debugger;
    
      
       $.ajax({
            url: baseurl+'/contact/getGaleria',
            type: 'post',
            data: 'id='+id,
            success:function(response){ 
              $("#galeria").append(response);
              document.getElementById('firstId').click(); 
              $("#galeria").empty();
            },
            error: function(e){
                $('#logger').html(e.responseText);
            }
        });

   }