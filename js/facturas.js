	
	
		
			function eliminar (id)
		{
			
		if (confirm("Realmente deseas eliminar la factura")){	
		$.ajax({
        type: "GET",
        url: "./ajax/borrar_venta.php",
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
			VentanaCentrada('ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}
