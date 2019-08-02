/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/
/*$.ajax({

	url: "ajax/datatable-ventas.ajax.php",
	success: function (respuesta){

		console.log("respuesta", respuesta);

	}

});
*/
/*=============================================
CONFIGURANDO DATATABLE
=============================================*/
$('.tablaVentas').DataTable( {

    "ajax": "ajax/datatable-ventas.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
    
} );

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaVentas tbody").on('click', 'button.agregarProducto', function() {
	
	let idProducto = $(this).attr("idProducto");
	//console.log("idProducto", idProducto);

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

	let datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({

		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			let descripcion = respuesta["descripcion"];
          	let stock = respuesta["stock"];
          	let precio = respuesta["precio_venta"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			    return;

          	}

          	/*=============================================
          	CAPTURANDO idProducto PARA AÑADIR Y QUITAR PRODUCTOS
          	=============================================*/
          	$(".nuevoProducto").append(

          		'<div class="row" style="padding:5px 15px">'+

	          		'<!-- Descripción del producto -->'+
	                 
	                '<div class="col-xs-6" style="padding-right: 0px">'+
	                  
	                  '<div class="input-group">'+
	                    
	                    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	                    '<input type="text" class="form-control agregarProducto" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	                  '</div>'+

	                '</div>'+

	                '<!-- Cantidad del producto -->'+

	                '<div class="col-xs-3">'+
	                  
	                  '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" required>'+

	                '</div>'+

	                '<!-- Precio del producto -->'+

	                '<div class="col-xs-3 ingresoPrecio" style="padding-left: 0px">'+

	                 '<div class="input-group">'+

	                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                    
	                    '<input type="number" min="1" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+

	                 '</div>'+

	                '</div>'+

	            '</div>'

          	);

          	// SUMAR TOTAL DE PRECIOS
          	sumarTotalPrecios();

          	// AGREGAR IMPUESTO
          	agregarImpuesto();

		}

	});

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		let listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(let i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}

	}

});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN AGREGAR PRODUCTO
=============================================*/

let idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on('click', 'button.quitarProducto', function() {

	$(this).parent().parent().parent().parent().remove();

	let idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto;
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass("btn-default");

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#nuevoTotalVenta").attr("total", 0);
		//$("#totalVenta").val(0);
		

	}else{

		// SUMAR TOTAL DE PRECIOS
    	sumarTotalPrecios();

    	// AGREGAR IMPUESTO
	    agregarImpuesto();

        // AGRUPAR PRODUCTOS EN FORMATO JSON
        //listarProductos()

	}

});

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

let numProducto = 0;

$(".btnAgregarProducto").click(function(){

	numProducto ++;

	let datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({

		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      		
	      	$(".nuevoProducto").append(

	      		'<div class="row" style="padding:5px 15px">'+

	          		'<!-- Descripción del producto -->'+
	                 
	                '<div class="col-xs-6" style="padding-right: 0px">'+
	                  
	                  '<div class="input-group">'+
	                    
	                    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

	                    '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

	                    '<option>Seleccione el producto</option>'+

	                    '</select>'+

	                  '</div>'+

	                '</div>'+

	                '<!-- Cantidad del producto -->'+

	                '<div class="col-xs-3 ingresoCantidad">'+
	                  
	                  '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock required>'+

	                '</div>'+

	                '<!-- Precio del producto -->'+

	                '<div class="col-xs-3 ingresoPrecio" style="padding-left: 0px">'+

	                 '<div class="input-group">'+

	                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                    
	                    '<input type="number" min="1" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+

	                 '</div>'+

	                '</div>'+

	            '</div>'

	      	);

	      	// AGREGAR LOS PRODUCTOS AL SELECT

	      	respuesta.forEach(funcionForEach);

	      	function funcionForEach(item, index){

	      		//Si no hay stock disponible, no aparece en la lista
	      		if (item.stock != 0) {

	      			$("#producto"+numProducto).append(

	      				'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'

	      			);

	      		}

	      	}

	      	// SUMAR TOTAL DE PRECIOS
	      	sumarTotalPrecios();

	      	// AGREGAR IMPUESTO
          	agregarImpuesto();

      	}

    });

});

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	let nombreProducto = $(this).val();
	console.log("nombreProducto", nombreProducto);

	let nuevoPrecioProducto = $(this).parent().parent().parent().children('.ingresoPrecio').children().children('.nuevoPrecioProducto');

	let nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	let datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

	$.ajax({

		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			$(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
			$(nuevoPrecioProducto).val(respuesta["precio_venta"]);
			$(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

		}

	});

});

/*=============================================
MODIFICAR LA CANTIDAD a pagar x producto
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	let precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	let precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	/*=============================================
	SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
	=============================================*/

	if (Number($(this).val()) > Number($(this).attr('stock'))){

		$(this).val(1);

		let precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({

	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"

	    });

	}

	// SUMAR TOTAL DE PRECIOS
	sumarTotalPrecios();

	// AGREGAR IMPUESTO
	agregarImpuesto();

});

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios() {

	let precioItem = $(".nuevoPrecioProducto");
	let arraySumaPrecio = [];

	for(let i = 0; i < precioItem.length; i++){

		arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	let sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);
	
}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto(){

	let impuesto = $('#nuevoImpuestoVenta').val();
	let precioTotal = $('#nuevoTotalVenta').attr("total");

	let precioImpuesto = Number(precioTotal * impuesto/100);

	let totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

	$("#nuevoTotalVenta").val(totalConImpuesto);

	//$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function(){

	agregarImpuesto();

});