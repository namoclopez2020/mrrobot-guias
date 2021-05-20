function eliminar (id){
	$.ajax({
		type: "GET",
		url: "./ajax/agregar_facturacion.php",
		data: "id="+id,
		beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		},
		success: function(datos){
			$("#resultados").html(datos);
		}
	});
}
$('#actualizar').click(function(){
	var url = "actualizar_registro.php";
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
$('#imprimir').click(function(){
    var correlativo=$("#correlativo").val();
	VentanaCentrada('reporte_mprincipal_impresion.php?correlativo='+correlativo,'Factura','','800','600','true');
});
		
$("#datos_factura").submit(function(){
	var id_cliente = $("#id_cliente").val();
	var id_vendedor = $("#id_vendedor").val();
	var condiciones = $("#condiciones").val();
	var id_producto = $("#id_producto").val();
	
	if (id_cliente==""){
	//  alert("Debes seleccionar un cliente");
		// $("#nombre_cliente").focus();
		// return false;
	}
			
	VentanaCentrada('factura_final.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones,'Factura','','800','600','true');
});
		
$("#datos").submit(function(){
	var vendedor=$("#vendedor").val();
	var cliente=$('#id_cliente').val();
	var info=$("#info").val();
	var cargador=$('input:radio[name=cargador]:checked').val(); 
	var servicio=$("#servicio").val();
	var informe=$("#informe").val();
	var revision=$("#revision").val();
	var costo=$("#costo").val();
	var repuesto=$("#repuesto").val();
	var adelanto=$("#adelanto").val();
	info = info.replace(/\n/g, "<br/>");
	
	VentanaCentrada('reporte_mprincipal.php?cliente='+cliente+'&info='+info+'&cargador='+cargador+'&servicio='+servicio+'&informe='+informe+'&revision='+revision+'&costo='+costo+'&repuesto='+repuesto+'&adelanto='+adelanto+'&vendedor='+vendedor,'Factura','','800','600','true');
});
		
$( "#form-cliente" ).submit(function( event ) {
	$('#guardar_cliente').attr("disabled", true);
		  
	var parametros = $(this).serialize();
	console.log('parametros->',parametros);
	
	$.ajax({
		type: "POST",
		url: "guardar_cliente.php",
		data: parametros,
		beforeSend: function(objeto){
			$("#resultados_ajax").html("Mensaje: Cargando...");
		},
		success: function(datos){
			$("#resu").html(datos);
			$("#name" ).val("");
			$("#tlf" ).val("");
			$("#dni_a" ).val("");
			$("#address" ).val("");
			$("#email_cliente" ).val("");
			$("#edad_cliente" ).val("");
			$('#guardar_cliente').attr("disabled", false);
			location.reload();
			//load(1);
		}
	});
	event.preventDefault();
})

		
function agregar (id){

	var precio_venta=document.getElementById('precio_venta_'+id).value;
	var cantidad=document.getElementById('cantidad_'+id).value;
	
	//Inicia validacion
	if (isNaN(precio_venta))
	{
		alert('Esto no es un numero');
		document.getElementById('precio_venta_'+id).focus();
		return false;
	}
	//Fin validacion
			
	$.ajax({
        type: "POST",
        url: "./ajax/agregar_facturacion.php",
        data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad,
		beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		},
        success: function(datos){
			$("#resultados").html(datos);
		}
	});
}
		
$( "#guardar_producto" ).submit(function( event ) {
	
	$('#guardar_datos').attr("disabled", true);
		  
	var parametros = $(this).serialize();

	$.ajax({
		type: "POST",
		url: "ajax/nuevo_producto.php",
		data: parametros,
		beforeSend: function(objeto){
			$("#resultados_ajax_productos").html("Mensaje: Cargando...");
		},
		success: function(datos){
			$("#resultados_ajax_productos").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		}
	});
	event.preventDefault();
})
