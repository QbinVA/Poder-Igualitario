<?php
// Activar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir archivo de conexión
require '../config/db.php';

// Función para guardar publicación
function guardarPublicacion($pdo, $fecha, $titular, $descripcion_corta, $imagen_principal, $contenido, $referencia, $id_categoria) {
    $sql = "INSERT INTO publicaciones (fecha, titular, descripcion_corta, imagen_principal, contenido, referencia, id_categoria) 
            VALUES (:fecha, :titular, :descripcion_corta, :imagen_principal, :contenido, :referencia, :id_categoria)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fecha' => $fecha,
        ':titular' => $titular,
        ':descripcion_corta' => $descripcion_corta,
        ':imagen_principal' => $imagen_principal,
        ':contenido' => $contenido,
        ':referencia' => $referencia,
        ':id_categoria' => $id_categoria,
    ]);
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titular = isset($_POST['titular']) ? htmlspecialchars($_POST['titular']) : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $descripcion_corta = isset($_POST['descripcion_corta']) ? htmlspecialchars($_POST['descripcion_corta']) : '';
    $contenido = isset($_POST['contenido']) ? htmlspecialchars($_POST['contenido']) : '';
    $referencia = isset($_POST['referencia']) ? htmlspecialchars($_POST['referencia']) : null;
    $id_categoria = isset($_POST['id_categoria']) ? htmlspecialchars($_POST['id_categoria']) : '';

    if (empty($titular) || empty($fecha) || empty($descripcion_corta) || empty($contenido) || empty($id_categoria)) {
        die("Error: Todos los campos obligatorios deben ser llenados.");
    }

    if (isset($_FILES['imagen_principal']) && $_FILES['imagen_principal']['error'] === UPLOAD_ERR_OK) {
        $imagen_principal = $_FILES['imagen_principal'];
        $imagen_tmp = $imagen_principal['tmp_name'];
        $imagen_nombre = basename($imagen_principal['name']);
        $extension = strtolower(pathinfo($imagen_nombre, PATHINFO_EXTENSION));

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($extension, $allowed_types)) {
            die("Error: Formato de imagen no permitido. Solo JPG, JPEG, PNG y GIF.");
        }

        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir) && !mkdir($upload_dir, 0777, true)) {
            die("Error: No se pudo crear la carpeta de imágenes.");
        }

        $imagen_destino = $upload_dir . uniqid('img_', true) . '.' . $extension;

        if (!move_uploaded_file($imagen_tmp, $imagen_destino)) {
            die("Error: No se pudo mover la imagen.");
        }

        try {
            guardarPublicacion($pdo, $fecha, $titular, $descripcion_corta, $imagen_destino, $contenido, $referencia, $id_categoria);
            header("Location: admin.php");
            exit;
        } catch (PDOException $e) {
            die("Error en la base de datos: " . $e->getMessage());
        }
    } else {
        die("Error: No se subió ninguna imagen o hubo un error.");
    }
} else {
    die("Error: El formulario no fue enviado correctamente.");
}
?>
