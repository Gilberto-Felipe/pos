<?php 

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


class AjaxProductos{

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORÍA
=============================================*/

	public $idCategoria;
	
	public function ajaxCrearCodigoProducto(){

		$item = 'id_categoria';
		$valor = $this -> idCategoria;

    	$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

		echo json_encode($respuesta);

	}
	
}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORÍA - INSTACIAMOS EL OBJETO CÓDIGO PRODUCTOS
=============================================*/

if (isset($_POST['idCategoria'])) {
	
	$codigoProducto = new AjaxProductos();
	$codigoProducto -> idCategoria = $_POST['idCategoria'];
	$codigoProducto -> ajaxCrearCodigoProducto();

}