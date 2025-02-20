<header>
    <a href="index.php"><img src="./imgs/iesjorgeguillen.svg" width="300px"></a>
    <h1>IES JORGE GUILLÉN</h1>
    <link rel="stylesheet" href="Estilos/ruben.css">
    <?php
    if (isset($_SESSION['idUsuario'])) {
        echo "<p>Bienvenido, ".$_SESSION['nombreUsuario']." ".$_SESSION['apellido1']." ".$_SESSION['apellido2']."</p>";
        ?>
            <a href="Validaciones/cerrar_sesion.php" class="botones">Cerrar Sesion</a>
        <?php
    }
    //si el rol es 2, mostrar el enlace a la página de administración
    if (isset($_SESSION['roles'])) {
        //Recorro el array de roles y compruebo si el usuario tiene el rol 2 que seria administrador
        foreach ($_SESSION['roles'] as $rol) {
            if ($rol == 2) {
                ?>
                <nav class="navegacion">
                    <ul>
                        <li><a href="reserva.php" class="botones">Reservas</a></li>
                        <li><a href="gestion_profesorado.php" class="botones">Profesorado</a></li>
                    </ul>
                </nav>
                <?php
            }
        }
    }
    ?>
</header>

