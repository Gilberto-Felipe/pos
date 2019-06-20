<?php 

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class AjaxCategorias{

	/*=============================================
	EVITAR INSERTAR CATEGORIAS REPETIDAS
	=============================================*/
	public $validarCategoria;
	
	public function ajaxValidarCategoria(){

		$item = "categoria";
		$valor = $this->validarCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
VALIDAR EVITAR CATEGORIAS REPETIDAS
=============================================*/

if (isset($_POST['validarCategoria'])){

	$validarCategoria = new AjaxCategorias();
	$validarCategoria -> validarCategoria = $_POST["validarCategoria"];
	$validarCategoria -> ajaxValidarCategoria();

}




