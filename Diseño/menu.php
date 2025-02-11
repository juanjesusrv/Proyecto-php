<!DOCTYPE html>
<html lang="en">
<?php session_start(); 
$_SESSION['usuario'] = "Pepe";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>
    <?php require_once "header.php" ?>
        <h1>hola</h1>
    <?php require_once "footer.php" ?>
</body>

</html>