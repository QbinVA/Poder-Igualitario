<?php
session_start();
require 'db.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // Buscar en la tabla admin
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE nombre = :usuario");
    $stmt->execute(['usuario' => $usuario]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validar contraseña (nota: sin hash)
    if ($admin && $password === $admin['contrasena']) {
        $_SESSION['usuario'] = $admin['nombre'];
        $_SESSION['is_admin'] = true;

        header('Location: admin.php'); // o el archivo correcto del panel
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
        echo "<p style='color:red;'>$error</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/loginStyles.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="POST">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>