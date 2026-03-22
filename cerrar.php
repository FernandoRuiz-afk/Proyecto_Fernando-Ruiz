<?php
session_start();
// Limpiamos todas las variables de sesión
session_unset();
// Destruimos la sesión en el servidor
session_destroy();

// Redireccionamos a tu nuevo archivo index.php
header("Location: index.php");
exit();
?>