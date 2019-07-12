<?php 

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes {
	
	/*=============================================
	EVITAR USUARIOS REPETIDOS
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
VALIDAR NO REPETIR USUARIO
=============================================*/

if (isset($_POST['validarCliente'])){
	//echo '<pre>'; print_r($_POST['validarUsuario']); echo '</pre>';

	$validarCliente = new AjaxClientes();
	$validarCliente -> validarCliente = $_POST["validarCliente"];
	$validarCliente -> ajaxValidarCliente();

}