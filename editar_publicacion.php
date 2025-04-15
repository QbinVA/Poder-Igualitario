<?php
require 'db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de noticia inválido.");
}

$id_noticia = $_GET['id'];

$sql = "SELECT * FROM publicaciones WHERE id_noticia = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_noticia]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$noticia) {
    die("No se encontró la publicación.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Publicación</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="actualizar_publicacion.php" method="POST" enctype="multipart/form-data">
        <h2>Editar Publicación</h2>
        
        <input type="hidden" name="id_noticia" value="<?php echo $noticia['id_noticia']; ?>">

        <label for="titular">Titular:</label>
        <input type="text" name="titular" id="titular" value="<?php echo htmlspecialchars($noticia['titular']); ?>" required>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo $noticia['fecha']; ?>" required>

        <label for="descripcion_corta">Descripción Corta:</label>
        <input type="text" name="descripcion_corta" id="descripcion_corta" value="<?php echo htmlspecialchars($noticia['descripcion_corta']); ?>" required>

        <label for="imagen_principal">Imagen Principal (opcional):</label>
        <!-- <input type="file" name="imagen_principal"> -->
        <input type="hidden" name="imagen_principal_fake" value="sin imagen">


        <label for="contenido">Contenido:</label>
        <textarea name="contenido" id="contenido" rows="5" required><?php echo htmlspecialchars($noticia['contenido']); ?></textarea>

        <label for="referencia">Referencia:</label>
        <input type="url" name="referencia" id="referencia" value="<?php echo htmlspecialchars($noticia['referencia']); ?>">

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
