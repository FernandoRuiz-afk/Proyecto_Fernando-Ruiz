<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['user_name']; ?>!</h1>
    <p>Has iniciado sesión correctamente .</p>
    <a href="cerrar.php">Cerrar Sesión</a>
</body>
</html>