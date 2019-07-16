<?php 

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes {

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}
	
	/*=============================================
	EVITAR CLIENTES REPETIDOS
	=============================================*/

	public $validarCliente;

	public function ajaxValidarCliente(){

		$item = "documento";
		$valor = $this->validarCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if (isset($_POST['validarCliente'])){
	//echo '<pre>'; print_r($_POST['validarUsuario']); echo '</pre>';

	$validarCliente = new AjaxClientes();
	$validarCliente -> validarCliente = $_POST["validarCliente"];
	$validarCliente -> ajaxValidarCliente();

}