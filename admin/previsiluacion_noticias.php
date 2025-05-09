<?php
require '../config/db.php'; // Conexión a la BD

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $conexion->prepare("SELECT titulo, contenido, fecha, autor FROM noticias WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $noticia = $resultado->fetch_assoc();
        echo json_encode($noticia);
    } else {
        echo json_encode(["error" => "Noticia no encontrada"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "ID inválido"]);
}

$conexion->close();
?>
