<?php 

	/* Función para conectarse a la base de datos */
	function crearConexion() {
		$host = "localhost";
		$user = "root";
		$password = "";
		$database = "peluqueria_df";

		// Establecemos la conexión con la base de datos
		$conexion = mysqli_connect($host, $user, $password, $database);

		return $conexion;
	}

	/* Función para cerrar la conexion a la base de datos */
	function cerrarConexion($conexion) {
		mysqli_close($conexion);
	}

?>