<?php
session_start();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    //Buscar al usuario registrado
    if (isset($_SESSION['usuarios']) && array_key_exists($usuario, $_SESSION['usuarios'])) {
        
        //Recuperar el hash de la contraseña
        $hash = $_SESSION['usuarios'][$usuario]['password'];

        //Verificar la contraseña utilizando password_verify()
        if (password_verify($password, $hash)) {
            $mensaje = "Bienvenido al sistema";
        } else {
            $mensaje = "Contraseña incorrecta";
        }
    } else {
        $mensaje = "El usuario no existe.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (!empty($mensaje)) { echo "<p style='color:green;'>$mensaje</p>"; } ?>

    <form method="POST" action="">
        <label>Nombre de usuario:</label><br>
        <input type="text" name="usuario" required><br><br>
        
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Entrar</button>
    </form>
    <br>
    <a href="registro.php">Ir a Registrarse</a>
</body>
</html>