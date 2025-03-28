<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

    // Conexión a la base de datos
    require 'lo.php';

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Verificar si el token es válido
    $sql = "SELECT id FROM usuarios WHERE token = ? AND token_expira > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Actualizar la contraseña y eliminar el token
        $sql = "UPDATE usuarios SET password = ?, token = NULL, token_expira = NULL WHERE token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $new_password, $token);
        $stmt->execute();

        echo "Tu contraseña ha sido actualizada.";
    } else {
        echo "El token no es válido o ha expirado.";
    }

    $stmt->close();
    $conn->close();
}
?>
