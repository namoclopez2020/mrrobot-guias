/*$(document).ready(function(){
  $("#buying_price").change(function(){
    alert("The text has been changed.");
  });
});
	$('#resultados').on('change', '.form-control', function(){
		$("#utilidad").val('');
		var costo= $('#buying_price').val();
		var precio=$('#sale_price').val();
		var porcentaje=((parseFloat(precio)-parseFloat(costo))/parseFloat(costo))*100;
		
	 $("#utilidad").val(porcentaje);
		var blister=$('#cantidad_blister').val();
		var precio_blister=parseFloat(precio)/parseFloat(blister);
		$('#precio_blister').val(precio_blister);
		
		var unidad=$('#cantidad_unidad').val();
		var precio_unidad=parseFloat(precio_blister)/parseFloat(unidad);
        $('#precio_unidad').val(precio_unidad);
});
*/

		function load(){
			var categoria=$('#categoria').find(":selected").val();
			$("#loader2").fadeIn('slow');
			$.ajax({
				type:"POST",
				url:'./ajax/formulario_ingreso.php',
				data:"categoria="+categoria,
				 beforeSend: function(objeto){
			$(".resultados").html("Mensaje: Cargando...");
			  },
				success:function(data){
					$(".resultados").html(data);
					
					
					
				}
			})
		}

		
		$( "#agregar_productos" ).submit(function( event ) {
		
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/agregar_nuevo_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
					
					  },
					success: function(datos){
					$("#resu").html(datos);
					
				
				  }
			});
		
		})

	