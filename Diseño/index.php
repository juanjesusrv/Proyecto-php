<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Tramos Horarios IES Pedroche</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php require_once "header.php" ?>
    <main>
        <form action="menu.php" method="post">
            <p>Iniciar Sesión</p>
            <br><input type="text" id="usr" name="usr" placeholder="Usuario" required><br>
            <input type="text" id="con" name="con" placeholder="Contraseña" required><br>
            <input type="submit" value="Iniciár Sesión">
        </form>
    </main>
    <?php require_once "footer.php" ?>
</body>
</html>