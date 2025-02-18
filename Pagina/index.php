<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Tramos Horarios IES Pedroche</title>
    <link rel="stylesheet" href="Estilos/styles.css">
</head>
<body>
    <?php require_once "./plantillas/header.php" ?>
    <main>
        <form class="formularioLogin" action="./validaciones/validacionUsuario.php" method="post">
            <p>Iniciar Sesión</p>
            <br><input type="text" id="usr" name="usr" placeholder="Usuario" required><br>
            <input type="text" id="con" name="con" placeholder="Contraseña" required><br>
            <input type="submit" value="Iniciár Sesión">
        </form>

        <div class="contenido">
            <h1>Novedades</h1>
            <h2>Hola</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas nam adipisci, repellat ipsa cupiditate doloremque quos illo cum. Voluptatem libero ea animi amet iste reprehenderit facilis voluptates impedit dicta eos.</p>
            <h2>Hola</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas nam adipisci, repellat ipsa cupiditate doloremque quos illo cum. Voluptatem libero ea animi amet iste reprehenderit facilis voluptates impedit dicta eos.</p>
            <h2>Hola</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas nam adipisci, repellat ipsa cupiditate doloremque quos illo cum. Voluptatem libero ea animi amet iste reprehenderit facilis voluptates impedit dicta eos.</p>
            <h2>Hola</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas nam adipisci, repellat ipsa cupiditate doloremque quos illo cum. Voluptatem libero ea animi amet iste reprehenderit facilis voluptates impedit dicta eos.</p>
        </div>
    </main>
    <?php require_once "./plantillas/footer.php" ?>
</body>
</html>