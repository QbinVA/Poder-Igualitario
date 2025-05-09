<?php
require '../config/db.php'; // Conexión a la base de datos

// Verificar si se recibió el ID de la publicación
if (isset($_GET['id_noticia'])) {
    $idNoticia = intval($_GET['id_noticia']); // Convertir el ID a un número entero para mayor seguridad

    try {
        // Preparar la consulta para eliminar la publicación
        $sql = "DELETE FROM publicaciones WHERE id_noticia = :id_noticia";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_noticia', $idNoticia, PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir al panel de administración con un mensaje de éxito
            header("Location: admin.php?mensaje=publicacion_eliminada");
            exit;
        } else {
            echo "Error al eliminar la publicación.";
        }
    } catch (PDOException $e) {
        die("Error al eliminar la publicación: " . $e->getMessage());
    }
} else {
    echo "ID de publicación no proporcionado.";
}
?>