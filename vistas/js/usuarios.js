/*=============================================
=          SUBIR FOTO DE USUARIO            =
=============================================*/

$(".nuevaFoto").change(function(){

	let imagen = this.files[0];
	console.log("imagen", imagen);

	/*=============================================
	=          VALIDAR FORMATO PNG O JPG           =
	=============================================*/

	if (imagen["type"] != "image/jpeg"  && imagen["type"] != "image/png") {

		$(".nuevaFoto").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato .jpg o .png!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else if (imagen["size"] > 2000000 ) {

		$(".nuevaFoto").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe pesar menos de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	}else {

		let datosImagen = new FileReader();
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event) {

			let rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);

		});

	}

});

/*=============================================
EDITAR USUARIO
=============================================*/

$(document).on("click", ".btnEditarUsuario", function(){

	let idUsuario = $(this).attr("idUsuario");
	//console.log("idUsuario", idUsuario);

	let datos = new FormData();
	datos.append('idUsuario', idUsuario);

	$.ajax({
		url: 'ajax/usuarios.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			$('#editarNombre').val(respuesta['nombre']);
			$('#editarUsuario').val(respuesta['usuario']);
			$('#editarPerfil').html(respuesta['perfil']);
			$('#editarPerfil').val(respuesta['perfil']);
			$('#fotoActual').val(respuesta['foto']);

			$('#passwordActual').val(respuesta['password']);

			if (respuesta['foto'] != "") {

				$(".previsualizar").attr("src", respuesta['foto']);

			}else {

				$(".previsualizar").attr("src", "vistas/imagen/usuarios/default/anonymous.png");				

			}

		}

	});

});

/*=============================================
ACTIVAR USUARIO
=============================================*/

$(document).on("click", ".btnActivar", function(){

	let idUsuario = $(this).attr("idUsuario");
	let estadoUsuario = $(this).attr("estadoUsuario");

	let datos = new FormData();
	datos.append('activarId', idUsuario);
	datos.append('activarUsuario', estadoUsuario);

	$.ajax({

		url: 'ajax/usuarios.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		success: function(respuesta){

	      	if(window.matchMedia("(max-width:767px)").matches){

				swal({

					title: "El usuario ha sido actualizado",
					type: "success",
					confirmButtonText: "¡Cerrar!"
					
				}).then(function(result) {

					if (result.value) {

					window.location = "usuarios";

				}

				});

			}


		}

	});

	if (estadoUsuario == 0) {

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario', 1);

	} else{

		$(this).removeClass('btn-danger');
		$(this).addClass('btn-success');
		$(this).html('Activado');
		$(this).attr('estadoUsuario', 0);

	}

});

/*=============================================
REVISAR SI USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoUsuario").change(function() {

	$(".alert").remove();
	
	let usuario = $(this).val();

	let datos = new FormData();
	datos.append('validarUsuario', usuario);

		$.ajax({
		url: 'ajax/usuarios.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			if (respuesta) {

				$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos.</div>');

				$("#nuevoUsuario").val("");

			}

		}

	});

});

/*=============================================
ELIMINAR USUARIO
=============================================*/

$(document).on("click", ".btnEliminarUsuario", function(){

	let idUsuario = $(this).attr("idUsuario");
	let fotoUsuario = $(this).attr("fotoUsuario");
	let usuario = $(this).attr("usuario");

	swal({

		title: "¿Estás seguro de eliminar el usuario?",
		text: "Puedes cancelar la acción",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sí, eliminar'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;

		}


	});

});
