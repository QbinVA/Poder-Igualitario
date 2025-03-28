<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Conexión a la base de datos (ajusta con tus credenciales)
    require 'lo.php';

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Verificar si el correo existe
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50));
        $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Guardar token en la base de datos
        $sql = "UPDATE usuarios SET token = ?, token_expira = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $token, $expira, $email);
        $stmt->execute();

        // Enlace de recuperación
        $link = "http://tudominio.com/restablecer_contraseña.php?token=$token";

        // Enviar correo (Asegúrate de configurar mail())
        $asunto = "Recuperación de contraseña";
        $mensaje = "Haz clic en el siguiente enlace para restablecer tu contraseña: $link";
        $cabeceras = "From: no-reply@tudominio.com\r\n";
        
        mail($email, $asunto, $mensaje, $cabeceras);

        echo "Se ha enviado un enlace de recuperación a tu correo.";
    } else {
        echo "El correo no está registrado.";
    }

    $stmt->close();
    $conn->close();
}
?>
