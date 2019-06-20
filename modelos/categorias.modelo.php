<?php 

require_once "conexion.php";

class ModeloCategorias{


	/*=============================================
	MOSTRAR CATEGORÍAS            
	=============================================*/

	static public function mdlMostrarCategorias($tabla, $item, $valor){

		if ($item != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		} 
		else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CREAR CATEGORÍAS
	=============================================*/

	static public function mdlIngresarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria) VALUES(:categoria)");

		$stmt -> bindParam(":categoria", $datos, PDO::PARAM_STR);

		if ($stmt->execute()){
			
			return "ok";

		}
		else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;


	}

}



