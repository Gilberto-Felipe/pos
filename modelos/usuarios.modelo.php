<?php 

require_once "conexion.php";


class ModeloUsuarios{
	
	/*=============================================
	=            MODELO ModeloUsuarios            =
	=============================================*/

	static public function MdlMostrarUsuarios($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

	}

	
}






