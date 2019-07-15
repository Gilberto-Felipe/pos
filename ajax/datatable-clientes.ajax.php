<?php 

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaClientes{

	/*=============================================
	MOSTAR LA TABLA DINÁMICA DE CLIENTES
	=============================================*/
	
	public function mostrarTablaClientes(){

		$item = null;
		$valor = null;

		$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

		$datosJson = '{
		  	"data": [';

		  		for ($i=0; $i < count($clientes); $i++) {

		  			$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' idCliente='".$clientes[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCliente' idCliente='".$clientes[$i]["id"]."'><i class='fa fa-times'></i></button></div>";	 			
		  			
		  			$datosJson .= '[
						"'.($i+1).'",
						"'.$clientes[$i]["nombre"].'",
						"'.$clientes[$i]["documento"].'",
						"'.$clientes[$i]["email"].'",
						"'.$clientes[$i]["telefono"].'",
						"'.$clientes[$i]["direccion"].'",
						"'.$clientes[$i]["fecha_nacimiento"].'",
						"'.$clientes[$i]["compras"].'",
						"0000-00-00 00:00:00",
						"'.$clientes[$i]["fecha"].'",
						"'.$botones.'"
				    ],';

		  		}

		  	$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']

		}';

		echo $datosJson;


				  	/*=============================================
		 	 		TRAEMOS LAS ACCIONES = BOTONES EDITAR Y ELIMINAR
		  			=============================================

		  			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' idCliente='".$clientes[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCliente' idCliente='".$clientes[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

			    [
			      "1",
			      "José Villegas",
			      "98765",
			      "jvillegas@gmail.mx",
			      "(055) 311-1234",
			      "ciudad z # 34",
			      "1993-01-01",
			      "0",
			      "0000-00-00 00:00:00",
			      "2019-07-09 17:20:01",
			      "botones"
			    ],
			]
		}';




		/*$item = null;
		$valor = null;

		$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

		$datosJson = '{

			"data": [';

				for($i = 0; $i < count($clientes); $i++){

				  	/*=============================================
		 	 		TRAEMOS LAS ACCIONES = BOTONES EDITAR Y ELIMINAR
		  			=============================================

		  			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' idCliente='".$clientes[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCliente' idCliente='".$clientes[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 


					$datosJson .= '[
							  "'.($i+1).'",
							  "'.$clientes[$i]["nombre"].'",
							  "'.$clientes[$i]["documento"].'",
							  "'.$clientes[$i]["email"].'",
							  "'.$clientes[$i]["telefono"].'",
							  "'.$clientes[$i]["direccion"].'",
							  "'.$clientes[$i]["fecha_nacimiento"].'",
							  "'.$clientes[$i]["compras"].'",
							  "0000-00-00 00:00:00",
							  "'.$clientes[$i]["fecha"].'",
							  "'.$botones.'"
							],';

				}

			$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']

		}';

		echo $datosJson;*/

	}

}


/*=============================================
ACTIVAR TABLA CLIENTES
=============================================*/
$activarClientes = new TablaClientes();
$activarClientes -> mostrarTablaClientes();


