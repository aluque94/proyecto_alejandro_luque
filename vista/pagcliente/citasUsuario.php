<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedir cita</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet"/>
</head>
<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: black" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#">Peluquería LaClasse</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item">
                        <form action="citasUsuario.php" method="post">
                            <button type="submit" name="logout_btn" class="nav-link" style="background-color: transparent;"><a href="../../index.html">CERRAR SESIÓN</a></button>
                        </form>
                        <?php 
                            // Para cerrar la sesión, pongo un botón para, una vez pulsado se destrya la sesión y se resetee
                            if (isset($_POST['logout_btn'])) {
                                session_destroy();
                                unset($_SESSION['usuario']);
                            }
                                
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-section">
        <div class="container-fluid">
            <h1>Citas</h1>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">            
                        <a href="nuevacitausuario.php" class="btn btn-success">Nuevo</a>    
                    </div>    
                </div>    
            </div> <br>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">            
                        <a href="editarUsuario.php" class="btn btn-danger">Editar Contraseña</a>    
                    </div>    
                </div>    
            </div> <br>


            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive"> 
                            <?php
                                include "../../controlador/funciones.php";

                                /* Eliminación de la cita de la base de datos. */
                                if (isset($_POST['borrar'])) {
                                    borrarCita($_POST['id']);
                                }
                                            
                                /* Se obtiene el nombre de usuario de la sesión. */
                                $usuario = $_SESSION['usuario'];

                                /* Se obtiene el nombre y apellidos del usuario. */
                                $nombre = nombreUsuario($usuario);
                                $apellidos = apellidosUsuario($usuario);

                                echo "Lista de Citas de " . $usuario . ": " . $nombre . " " . $apellidos;

                                /*Se imprime la tabla con las citas del usuario. */
                                pintaTablaCitasUsuario($nombre, $apellidos);
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class='text-center' style='background-color: rgb(230, 174, 30)'>Calendario</h1>

            <?php
                                
                /* Obtenemos la fecha actual. */
                $mes = date("m");
                $year = date("Y");
                $diaActual = date("j");
                $semana = date("l");

                /* Obtenemos el primer día del mes. */
                $primerDia = date('j', mktime(0,0,0,$mes, 1, $year));
                        
                /* Mes actual. */
                $mes_actual = strtolower(date('f'));

                $fecha = new DateTime();

                /* Último día del mes. */
                $fecha->modify('last day of '. $mes_actual .' '.date('Y'));

                /* Número de días del mes. */   
                $diasTotales = $fecha->format('d');
                        
                /* Obtenemos el primer día de la semana, wen este caso el 0 es el domingo. */
                $primerdiasemana = date('w', strtotime($primerDia));

                /* Una matriz que contiene los meses del año, empezando por el 1. */
                $mesesAno = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

                /* Creando un array con los días de la semana. */
                $diasDeLaSemana = array("Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom");

                /* Si el primer día de la semana es 0(domingo), se le asignará como el día 7, para que sea como en el calendario español. */
                if($primerdiasemana==0) {
                    $primerdiasemana=7;
                }

                /* Comienzo de la tabla, mostrando el mes actual como cabecero*/
                echo "<div class='text-center'>
                        <table class='table table-striped table-bordered table-condensed' style='width=100%' colspan='6'><tr>
                            <thead><th colspan='7'>$mesesAno[$mes] $year</th></thead><tr>";

                /* Se imprimen los días de la semana */
                for ($a = 0; $a <= 6; $a++) {
                    echo "<th>$diasDeLaSemana[$a]</th>";
                }

                echo "</tr>";

                /* Contador que servirá para cambiar de semana. */
                $contador = 0;

                /* En el caso que haya días anteriores al día 1, se imprimen como vacíos. */
                for($o=1; $o<$primerdiasemana; $o++) {
                    $vacio = "<td>&nbsp</td>";
                    echo $vacio;
                    
                    $contador++;
                }
                        
                for ($i = 1; $i <= $diasTotales; $i++) {
                    
                    $diaCita = date('c', mktime(0,0,0, $mes, $i, $year));
                            
                    /* Obtenemos la lista de citas para el usuario. */
                    $listadoCitas = getListaCitasCalendarUsuario($diaCita, $nombre, $apellidos);

                    $citaGuardada = "";

                    /* Se recorre la lista de citas y las agrega al calendario. */
                    while ($fila = mysqli_fetch_assoc($listadoCitas)) {
                        $id = $fila['ID'];

                        $citaGuardada .= "<a href='nuevacitausuario.php?editar=" . $id ."'><br>" . $fila['Hora'] . " Asiento: " . $fila['Asiento'] . "</a>";
                    }
                            
                    /* Si el día es el día actual, lo imprimirá en rojo. */
                    if ($i == $diaActual){
                        echo "<td style='background-color: red'>$i $citaGuardada</td>";
                                
                    } else if ($i != $diaActual && isset($citaGuardada) ){
                        echo "<td>$i $citaGuardada</td>";
                        $citaGuardada = null;
                    } else {
                        echo "<td>$i</td>";
                    }

                    $contador++;

                    /* Cuando el contador llega a 7, salta de fila. */
                    if ($contador % 7 == 0){
                        echo "</tr>";
                    }
                            
                }

                echo "</tr>";

                echo "</tr></table></div>";
            ?>

        </div>
    </section>
</body>
</html>