/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/
/*COMPRUEBA CONEXIÓN CON datatable-clientes.ajax.php*/
$.ajax({
	url: 'ajax/datatable-clientes.ajax.php',
	success: function (respuesta){
		console.log(respuesta);		
	}
});


/*=============================================
CONFIGURANDO DATATABLE
=============================================*/
$('.tablaClientes').DataTable( {

    "ajax": "ajax/datatable-clientes.ajax.php",
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
    
});

/*=============================================
EVITAR CLIENTES REPETIDOS
=============================================*/

/*$("#nuevoDocumentoId").change(function() {

	$(".alert").remove();
	
	let cliente = $(this).val();

	let datos = new FormData();
	datos.append('validarCliente', documento);

		$.ajax({
		url: 'ajax/clientes.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			if (respuesta) {

				$("#nuevoDocumentoId").parent().after('<div class="alert alert-warning">Este cliente ya existe en la base de datos.</div>');

				$("#nuevoDocumentoId").val("");

			}

		}

	});

});*/