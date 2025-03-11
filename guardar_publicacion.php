<?php
// Incluir el archivo de conexión a la base de datos
require 'db.php';

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titular = htmlspecialchars($_POST['titular']);
    $fecha = $_POST['fecha'];
    $descripcion_corta = htmlspecialchars($_POST['descripcion_corta']);
    $contenido = htmlspecialchars($_POST['contenido']);
    $referencia = isset($_POST['referencia']) ? htmlspecialchars($_POST['referencia']) : null;

    // Procesar la imagen
    $imagen_principal = $_FILES['imagen_principal'];

    if ($imagen_principal['error'] === UPLOAD_ERR_OK) {
        $imagen_tmp = $imagen_principal['tmp_name'];
        $imagen_nombre = basename($imagen_principal['name']);
        $extension = pathinfo($imagen_nombre, PATHINFO_EXTENSION);
        
        // Validar tipo de archivo
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($extension), $allowed_types)) {
            echo "Formato de imagen no permitido.";
            exit;
        }

        // Crear la carpeta uploads si no existe
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Crear un nombre único para evitar sobrescribir
        $imagen_destino = $upload_dir . uniqid('img_', true) . '.' . $extension;

        if (move_uploaded_file($imagen_tmp, $imagen_destino)) {
            try {
                // Insertar la publicación en la base de datos
                $sql = "INSERT INTO publicaciones (fecha, titular, descripcion_corta, imagen_principal, contenido, referencia) 
                        VALUES (:fecha, :titular, :descripcion_corta, :imagen_principal, :contenido, :referencia)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':fecha' => $fecha,
                    ':titular' => $titular,
                    ':descripcion_corta' => $descripcion_corta,
                    ':imagen_principal' => $imagen_destino, // Guardamos la RUTA, no la imagen
                    ':contenido' => $contenido,
                    ':referencia' => $referencia,
                ]);

                header("Location: index.php");
                exit;
            } catch (PDOException $e) {
                echo "Error al insertar: " . $e->getMessage();
            }
        } else {
            echo "Error al mover la imagen.";
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
?>