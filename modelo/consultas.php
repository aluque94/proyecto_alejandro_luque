<?php

    include "conexion.php";

    /**
     * Si el usuario es un superadministrador, devuelve superadministrador; de lo contrario, si el
     * usuario es un usuario registrado, devuelve registrado; de lo contrario, devuelve no registrado.
     */
    function comprobarUsuario($usuario, $contrasena) {
        $DB = crearConexion();

        if (esSuperadmin($usuario, $contrasena)) {
            return "superadmin";
        } else {
            $sql = "SELECT ID, usuario, password FROM usuarios WHERE usuario = '$usuario' and password = '$contrasena'";
            
            $result = mysqli_query($DB, $sql);

            cerrarConexion($DB);

            if ($datos = mysqli_fetch_array($result)) {
                if ($datos["ID"] > 0) {
                    return "registrado";
                } else {
                    return "no registrado";
                }
            }
        }
    }

    /**
     * Si el usuario es un superadministrador, devuelva verdadero; de lo contrario, devuelva falso.
     */
    function esSuperadmin($usuario, $contrasena) {
        $DB = crearConexion();

        $sql = "SELECT usuarios.ID FROM usuarios INNER JOIN setup ON usuarios.ID = setup.SuperAdmin WHERE usuarios.usuario = '$usuario' and usuarios.password = '$contrasena'";

        $result = mysqli_query($DB, $sql);

        if ($datos = mysqli_fetch_array($result)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Toma cuatro parámetros, se conecta a la base de datos, inserta los parámetros en la base de
     * datos y luego cierra la conexión.
     */
    function registrarUsuario($nombre, $apellidos, $usuario, $contrasena){
        $DB = crearConexion();

        $sql = "INSERT INTO usuarios (nombre, apellidos, usuario, password)
                VALUES ('$nombre', '$apellidos', '$usuario', '$contrasena') /*WHERE NOT EXISTS (SELECT usuario WHERE usuario = '$usuario')*/";

        $result = mysqli_query($DB, $sql);

        if ($result) {
            return $result;
            echo "Se ha registrado correctamente";
        } else {
            echo "Error al insertar datos, usuario existente";
        }

        cerrarConexion($DB);
    }

    /**
     * Toma una identificación, consulta la base de datos en busca de un usuario con esa identificación
     * y devuelve el resultado.
     */
    function getUsuario($id) {
        $DB = crearConexion();

        $sql = "SELECT ID, nombre, apellidos, usuario, password FROM usuarios WHERE ID = '$id'";

        $result = mysqli_query($DB, $sql);

        return $result;

        cerrarConexion($DB);
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    function borrarUsuario($id) {
        $DB = crearConexion();

        $sql = "DELETE FROM usuarios WHERE ID='$id'";

        $result = mysqli_query($DB, $sql);

        return $result;

        cerrarConexion($DB);
    }

    /**
     * Toma el id, nombre, apellido, usuario y contraseña de un usuario y actualiza la base de datos
     * con la nueva información
     */
    function modificarUsuario($id, $nombre, $apellidos, $usuario, $password) {
        $DB = crearConexion();

        $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', usuario = '$usuario', password = '$password' WHERE ID = '$id'";

        $result = mysqli_query($DB, $sql);

        return $result;

        cerrarConexion($DB);
    }

    /**
     * Toma un nombre de usuario y devuelve el nombre del usuario.
     */
    function nombreUsuario($usuario){
        $DB = crearConexion();

        $sql = "SELECT nombre FROM usuarios WHERE usuario = '$usuario'";

        $query = mysqli_query($DB, $sql);

        $row = mysqli_fetch_array($query);

        $result = $row['nombre'];

        cerrarConexion($DB);

        return $result;
    }

    /**
     * Toma un nombre de usuario como parámetro, consulta la base de datos por el apellido del usuario
     * y devuelve el apellido.
     */
    function apellidosUsuario($usuario){
        $DB = crearConexion();

        $sql = "SELECT apellidos FROM usuarios WHERE usuario = '$usuario'";

        $query = mysqli_query($DB, $sql);

        $row = mysqli_fetch_array($query);

        $result = $row['apellidos'];

        cerrarConexion($DB);

        return $result;
    }

    /**
     * Toma un nombre de usuario y devuelve la contraseña para ese nombre de usuario.
     */
    function passwordUsuario($usuario){
        $DB = crearConexion();

        $sql = "SELECT password FROM usuarios WHERE usuario = '$usuario'";

        $query = mysqli_query($DB, $sql);

        $row = mysqli_fetch_array($query);

        $result = $row['password'];

        cerrarConexion($DB);

        return $result;
    }

    /**
     * Devuelve la lista de todos los usuarios de la base de datos.
     */
    function getListaUsuarios() {
        $DB = crearConexion();

        $sql = "SELECT ID, nombre, apellidos, usuario, password FROM usuarios";

        $result = mysqli_query($DB, $sql);

        cerrarConexion($DB);

        return $result;
    }

    /**
     * Devuelve la lista de citas de la base de datos.
     */
    function getListaCitas() {
        $DB = crearConexion();

        $sql = "SELECT ID, Nombre, Apellidos, DATE_FORMAT(Fecha, '%d/%m/%Y') AS Fecha, TIME_FORMAT(Hora, '%H:%i') AS Hora, Asiento From citas ORDER BY DATE_FORMAT(Fecha, '%Y,%m,%d'), Hora"; //DATE_FORMAT(Fecha, '%Y,%m,%d'),

        $result = mysqli_query($DB, $sql);

        cerrarConexion($DB);

        return $result;
    }

    /**
     * Toma una ID, consulta la base de datos en busca de una fila con esa ID y devuelve el resultado.
     */
    function getCita($id){
        $DB = crearConexion();

        $sql = "SELECT ID, Nombre, Apellidos, Fecha, Hora, Asiento FROM citas WHERE ID = '$id'";

        $result = mysqli_query($DB, $sql);

        return $result;

        cerrarConexion($DB);
    }

    /**
     * Elimina una fila de la base de datos.
     */
    function borrarCita($id) {
        $DB = crearConexion();

        $sql = "DELETE FROM citas WHERE ID='$id'";

        $result = mysqli_query($DB, $sql);

        return $result;

        cerrarConexion($DB);
    }

    /**
     * Toma 5 parámetros, crea una conexión a la base de datos, inserta los parámetros en la base de
     * datos y luego cierra la conexión
     */
    function anadirCita($nombre, $apellidos, $fecha, $hora, $asiento) {
        $DB = crearConexion();

        $sql = "INSERT INTO citas (Nombre, Apellidos, Fecha, Hora, Asiento)
                VALUES ('$nombre', '$apellidos','$fecha', '$hora', '$asiento')";
            
        $result = mysqli_query($DB, $sql);

        if ($result) {
            return $result;
            echo "Se ha concretado la cita correctamente";
        } else {
            echo "La cita ya existe";
        }

            cerrarConexion($DB);
    }

    /**
     * Actualiza la fila en la base de datos con el ID de la fila que se pasó.
     */
    function modificarCita($id, $fecha, $hora, $asiento){
        $DB = crearConexion();

        $sql = "UPDATE citas SET Fecha = '$fecha', Hora = '$hora', Asiento = '$asiento' WHERE ID = '$id'";
        
        $result = mysqli_query($DB, $sql);

        return $result;

        cerrarConexion($DB);
    }

    /**
     * Devuelve un conjunto de resultados de todas las citas para un usuario determinado.
     */
    function getListaCitasUsuario($nombre, $apellidos){
        $DB = crearConexion();

        //SELECT Fecha, Hora, Asiento FROM citas WHERE Nombre = '$nombre' and Apellidos = '$apellidos'
        $sql = "SELECT ID, DATE_FORMAT(Fecha, '%d/%m/%Y') AS Fecha, TIME_FORMAT(Hora, '%H:%i') AS Hora, Asiento FROM citas WHERE Nombre='$nombre' and Apellidos='$apellidos' ORDER BY DATE_FORMAT(Fecha, '%Y,%m,%d'), Hora";

        $result = mysqli_query($DB, $sql);

        return $result;

        cerrarConexion($DB);
    }

    /**
     * Toma un nombre de usuario y una contraseña, y actualiza la contraseña en la base de datos.
     */
    function cambiarContrasena($usuario, $password) {
        $DB = crearConexion();

        $sql = "UPDATE usuarios SET password = '$password' WHERE usuario = '$usuario'";

        $result = mysqli_query($DB, $sql);

        return $result;

        cerrarConexion($DB);
    }

    /**
     * Devuelve la lista de citas de la base de datos con una fecha concreta.
     */
    function getListaCitasCalendar($fecha) {
        $DB = crearConexion();
        
        $sql = "SELECT ID, Nombre, Apellidos From citas WHERE Fecha = '$fecha'";

        $result = mysqli_query($DB, $sql);

        cerrarConexion($DB);
        
        return $result;
    }

    /**
     * Devuelve la lista de citas de la base de datos con una fecha concreta para el usuario conectado.
     */
    function getListaCitasCalendarUsuario($fecha, $nombre, $apellidos) {
        $DB = crearConexion();
        
        $sql = "SELECT ID, TIME_FORMAT(Hora, '%H:%i') AS Hora, Asiento From citas WHERE Fecha = '$fecha' and Nombre = '$nombre' and Apellidos = '$apellidos'";
        
        $result = mysqli_query($DB, $sql);
        
        cerrarConexion($DB);
        
        return $result;
    }

?>