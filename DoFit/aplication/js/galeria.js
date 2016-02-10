
    $(document).ready(function(){
        debugger;
         getPage(0);
         getLinks(0);
         
    });


    function openFancy(id){
         $.ajax({
          url: baseurl+'/galeria/getImg', 
          type: 'POST',
          data: 'id='+id,
          success:function(response){
            debugger;
              $.fancybox.open(baseurl+"/uploads/"+response);
          },
          error: function(e){
             alert(e);
          }
        });
    }


    function getLinks(page) {
         $.ajax({
          url: baseurl+'/galeria/getLinks',  
          type: 'POST',
          data: 'page='+page,
          success:function(response){
             debugger;
             $('#menu-links').html(response);          
          },
          error: function(e){
             alert(e);
          }
        });
     
    }
    
    function getPage(page){
      debugger;
        $.ajax({
          url: baseurl+'/galeria/getPage', 
          type: 'POST',
          data: 'page='+page,
          success:function(response){
             debugger;
             $('#galeria-images').html(response);
             getLinks(page);
          },
          error: function(e){
             alert(e);
          }
        });
    }
    
    function deleteImagen(id) {
        debugger;
        $.ajax({
          url: baseurl+'/galeria/deleteImagen', 
          type: 'POST',
          data: 'id='+id,
          success:function(response){
             if (response == "deleted") {
                 getPage(0); 
             }else{
              alert("error borrando imagen")
             }
          },
          error: function(e){
             alert(e);
          }
        });
    }
    
    