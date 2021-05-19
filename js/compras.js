		
		
			function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Realmente deseas eliminar la factura")){	
		$.ajax({
        type: "GET",
        url: "./ajax/borrar_compra.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		location.reload();
		}
			});
		}
		}
		
		function imprimir_factura(id_factura){
			VentanaCentrada('ver_compra.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}
