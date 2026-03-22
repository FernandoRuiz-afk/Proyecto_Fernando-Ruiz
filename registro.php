<?php
include("enlace.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $pass = $_POST['contrasena'];
    $confirm_pass = $_POST['confirmar_contrasena'];

    if ($pass === $confirm_pass) {
        $pass_encriptada = password_hash($pass, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$pass_encriptada')";
        
        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Usuario registrado exitosamente. <a href='login.php'>Ir al Login</a>";
        } else {
            $mensaje = "Error: El nombre de usuario ya existe o hubo un problema técnico.";
        }
    } else {
        $mensaje = "Las contraseñas no coinciden.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <?php if ($mensaje !== "") echo "<p>$mensaje</p>"; ?>
    
    <form method="POST">
        <label>Nombre de Usuario:</label><br>
        <input type="text" name="nombre" required><br>
        <label>Correo Electrónico:</label><br>
        <input type="email" name="correo" required><br>
        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br>
        <label>Confirmar Contraseña:</label><br>
        <input type="password" name="confirmar_contrasena" required><br><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>