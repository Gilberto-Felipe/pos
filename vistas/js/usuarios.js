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

$(".btnEditarUsuario").click(function(event) {

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

		}
	})

});