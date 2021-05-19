
		
 $('#actualizar').click(function(){
        var url = "actualizar_egreso.php";
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: $("#datos").serialize(), 
           success: function(data)             
           {
             $('#resu').html(data); 
			  location.reload();
           }
       });
    });
