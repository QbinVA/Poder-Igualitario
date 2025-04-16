<?php
require 'db.php'; // tu archivo de conexión a la BD

// Activar errores visibles
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 🛡️ Verifica si se está enviando con POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("⛔ El formulario no se ha enviado por POST.");
}

// 🧪 Diagnóstico rápido
echo "<h2>📦 Datos recibidos</h2><pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";

// ✅ Verifica campos requeridos
if (
    empty($_POST['id_noticia']) ||
    empty($_POST['titular']) ||
    empty($_POST['fecha']) ||
    empty($_POST['descripcion_corta']) ||
    empty($_POST['contenido'])
) {
    die("⚠️ Faltan campos obligatorios.");
}

// 🧾 Recibe variables
$id_noticia = $_POST['id_noticia'];
$titular = $_POST['titular'];
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion_corta'];
$contenido = $_POST['contenido'];
$referencia = $_POST['referencia'] ?? '';

// 🖼️ Obtener imagen actual
$stmt = $pdo->prepare("SELECT imagen_principal FROM publicaciones WHERE id_noticia = ?");
$stmt->execute([$id_noticia]);
$publicacion = $stmt->fetch(PDO::FETCH_ASSOC);
$imagen_actual = $publicacion['imagen_principal'] ?? '';

// 🆕 Manejo de imagen
if (!empty($_FILES['imagen_principal']['name'])) {
    if ($_FILES['imagen_principal']['error'] === UPLOAD_ERR_OK) {
        $nombre_nuevo = 'uploads/img_' . uniqid() . '.' . pathinfo($_FILES['imagen_principal']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $nombre_nuevo);
        $imagen_guardada = $nombre_nuevo;
    } else {
        die("⚠️ Error al subir la nueva imagen.");
    }
} else {
    $imagen_guardada = $imagen_actual; // conservar imagen anterior
}

// 💾 Ejecutar UPDATE
$sql = "UPDATE publicaciones SET titular = ?, fecha = ?, descripcion_corta = ?, imagen_principal = ?, contenido = ?, referencia = ? WHERE id_noticia = ?";
$stmt = $pdo->prepare($sql);
$exito = $stmt->execute([
    $titular,
    $fecha,
    $descripcion,
    $imagen_guardada,
    $contenido,
    $referencia,
    $id_noticia
]);

// ✅ Confirmación
if ($exito) {
    header("Location: admin.php?mensaje=actualizado");
    exit;
} else {
    echo "❌ Error al actualizar la publicación.";
}
?>
