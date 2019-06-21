/*=============================================
EVITAR CATEGORIAS REPETIDAS
=============================================*/

$("#nuevaCategoria").change(function() {

	$(".alert").remove();
	
	let categoria = $(this).val();

	let datos = new FormData();
	datos.append('validarCategoria', categoria);

		$.ajax({
		url: 'ajax/categorias.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			if (respuesta) {

				$("#nuevaCategoria").parent().after('<div class="alert alert-warning">Esta categoría ya existe en la base de datos.</div>');

				$("#nuevaCategoria").val("");

			}

		}

	});

});

/*=============================================
EDITAR CATEGORIAS
=============================================*/

$(".btnEditarCategoria").click(function(){

	let idCategoria = $(this).attr('idCategoria');

	let datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
		url: 'ajax/categorias.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			$("#editarCategoria").val(respuesta["categoria"]);
			$("#idCategoria").val(respuesta["id"]);

		}

	});

});
