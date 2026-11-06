<?php
session_start();
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [];
}
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmacion = $_POST['confirm_password'] ?? '';

    // Validacion
    if (empty($nombre) || empty($usuario) || empty($password) || empty($confirmacion)) {
        $mensaje = "llena todos los campos";
    } elseif (strlen($password) < 6) {
        $mensaje = "La contraseña debe tener al menos 6 caracteres.";
    } elseif ($password !== $confirmacion) {
        $mensaje = "La contraseña y la confirmación deben coincidir.";
    } else {
        //hash de la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        //Guardar usuario
        $_SESSION['usuarios'][$usuario] = [
            'nombre' => $nombre,
            'password' => $password_hash
        ];
        $mensaje = "Usuario registrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuarios</title>
</head>
<body>
    <h2>Registro de Usuarios</h2>
    <?php if (!empty($mensaje)) { echo "<p style='color:blue;'>$mensaje</p>"; } ?>
    
    <form method="POST" action="">
        <label>Nombre del usuario:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Nombre de usuario (login):</label><br>
        <input type="text" name="usuario" required><br><br>
        
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirmación de contraseña:</label><br>
        <input type="password" name="confirm_password" required><br><br>
        
        <button type="submit">Registrar</button>
    </form>
    <br>
    <a href="login.php">Ir a Iniciar Sesión</a>
</body>
</html>