<?php
session_start();
?>
<header><a href="index.html"><img src="iesjorgeguillen.svg" width="300px"></a>
    <h1>IES LOS PEDROCHES</h1>
    <?php if (isset($_SESSION['usuario'])) { ?>
        <h2>Bienvenido <?= $_SESSION['usuario'] ?></h2>
        <a href="logout.php">Cerrar sesión</a>
    <?php }; ?>
</header>