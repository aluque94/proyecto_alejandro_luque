<?php

    include "../../modelo/consultas.php";

    /**
     * Imprime la tabla con los usuarios de la base de datos.
     */
    function pintaTablaUsuarios(){
        $listaUsuarios = getListaUsuarios();

        echo "<table class='table table-striped table-bordered table-condensed' style='width=100%'>\n
                <thead class='text-center'>\n
                    <tr>\n
                        <th>ID</th>\n
                        <th>Nombre</th>\n
                        <th>Apellidos</th>\n
                        <th>Usuario</th>\n
                        <th>Contraseña</th>\n
                        <th>Acciones</th>\n
                    </tr>
                </thead>\n";

        while ($fila = mysqli_fetch_assoc($listaUsuarios)) {
            echo "<tr class='text-center'>\n
                    <td>" . $fila['ID'] . "</td>\n
                    <td>" . $fila['nombre'] . "</td>\n
                    <td>" . $fila['apellidos'] . "</td>\n
                    <td>" . $fila['usuario'] . "</td>\n
                    <td>" . $fila['password'] . "</td>\n
                    <td>
                        <a href='nuevousuario.php?editar=" . $fila["ID"] ."' class='btn btn-primary btn-icon-split'>Editar</a>
                        <form action='usuarios.php' method='POST'>
                            <input type='hidden' name='id' value='" . $fila['ID'] . "'>
                            <input class='btn btn-danger btn-icon-split' type='submit' name='borrar' value='Borrar'>
                        </form>
                    </td>\n
                <tr>\n";
        }

        echo "</table>";
    }

    /**
     * Imprime la tabla con las citas de la base de datos.
     */
    function pintaTablaCitas(){
        $listaCitas = getListaCitas();

        echo "<table class='table table-striped table-bordered table-condensed' style='width=100%'>\n
                <thead class='text-center'>\n
                    <tr>\n
                        <th>Nombre</th>\n
                        <th>Apellidos</th>\n
                        <th>Fecha</th>\n
                        <th>Hora</th>\n
                        <th>Asiento</th>\n
                        <th>Acciones</th>\n
                    </tr>\n
                </thead>\n";

        while ($fila = mysqli_fetch_assoc($listaCitas)) {
            echo "<tbody>
                    <tr class='text-center'>\n
                        <td>" . $fila['Nombre'] . "</td>\n
                        <td>" . $fila['Apellidos'] . "</td>\n
                        <td>" . $fila['Fecha'] . "</td>\n
                        <td>" . $fila['Hora'] . "</td>\n
                        <td>" . $fila['Asiento'] . "</td>\n
                        <td>
                            <a href='nuevacita.php?editar=" . $fila["ID"] ."' class='btn btn-primary btn-icon-split'>Editar</a>
                            <form action='citas.php' method='POST'>
                                <input type='hidden' name='id' value='" . $fila['ID'] . "'>
                                <input class='btn btn-danger btn-icon-split' type='submit' name='borrar' value='Borrar'>
                            </form>
                        </td>\n
                    <tr>\n
                </tbody>\n";
        }

        echo "</table>";
    }

    /**
     * Imprime la tabla con las citas de la base de datos para el usuario.
     * 
     */
    function pintaTablaCitasUsuario($nombre, $apellidos){

        $listaCitasUsuario = getListaCitasUsuario($nombre, $apellidos);

        echo "<table class='table table-striped table-bordered table-condensed' style='width=100%'>\n
                <thead class='text-center'>\n
                    <tr>\n
                        <th>Fecha</th>\n
                        <th>Hora</th>\n
                        <th>Asiento</th>\n
                        <th>Acciones</th>\n
                    </tr>\n
                </thead>\n";

        while ($fila = mysqli_fetch_assoc($listaCitasUsuario)) {
            echo "<tbody>
                    <tr class='text-center'>\n
                        <td>" . $fila['Fecha'] . "</td>\n
                        <td>" . $fila['Hora'] . "</td>\n
                        <td>" . $fila['Asiento'] . "</td>\n
                        <td>
                            <a href='nuevacitausuario.php?editar=" . $fila["ID"] ."' class='btn btn-primary btn-icon-split'>Editar</a>
                            <form action='citasUsuario.php' method='POST'>
                                <input type='hidden' name='id' value='" . $fila['ID'] . "'>
                                <input class='btn btn-danger btn-icon-split' type='submit' name='borrar' value='Borrar'>
                            </form>
                        </td>\n
                    <tr>\n
                </tbody>\n";
        }

        echo "</table>";
    }

?>