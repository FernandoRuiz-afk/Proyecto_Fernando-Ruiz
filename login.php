<?php
session_start();
include("enlace.php");

$error_login = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $pass = $_POST['contrasena'];

    // Usamos 'nombre' tal cual está en tu imagen
    $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre_usuario'";
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        $usuario = mysqli_fetch_assoc($resultado);

        if ($usuario && password_verify($pass, $usuario['contrasena'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nombre'];
            header("Location: inicio.php");
            exit();
        } else {
            $error_login = "datos invalidos";
        }
    } else {
        $error_login = "Error en la consulta: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <?php if ($error_login !== ""): ?>
        <p style="color: red;"><?php echo $error_login; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre de Usuario:</label><br>
        <input type="text" name="usuario" required><br>
        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br><br>
        <button type="submit">Ingresar</button>
    </form>
    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
</body>
</html>