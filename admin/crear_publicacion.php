<?php

require '../config/db.php';

// Obtener categorías de la base de datos
$sqlCategorias = "SELECT id_categoria, nombre FROM categorias";
$stmtCategorias = $pdo->query($sqlCategorias);
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Publicación</title>
    <link rel="stylesheet" href="forms/forms.css">
    <link rel="stylesheet" href="../views/css/font/font.css">
</head>
<body>
    <form action="guardar_publicacion.php" method="POST" enctype="multipart/form-data">
        <h2>Crear Nueva Publicación</h2>

        <label for="titular">Titular:</label>
        <input type="text" name="titular" id="titular" required>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>

        <label for="descripcion_corta">Descripción Corta:</label>
        <input type="text" name="descripcion_corta" id="descripcion_corta" required>

        <label for="imagen_principal">Imagen Principal:</label>
        <input type="file" name="imagen_principal" id="imagen_principal" accept="image/*" required>

        <label for="contenido">Contenido:</label>
        <textarea name="contenido" id="contenido" rows="5" required></textarea>

        <label for="referencia">Referencia (opcional):</label>
        <input type="url" name="referencia" id="referencia">

        <!-- Campo de Categoría dinámico -->
        <label for="id_categoria">Categoría:</label>
        <select name="id_categoria" id="id_categoria" required>
            <option value="">Selecciona una categoría</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= htmlspecialchars($categoria['id_categoria']) ?>">
                    <?= htmlspecialchars($categoria['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Publicar</button>
    </form>

    <script src="forms/forms.js"></script>
    <script src="forms/validar_forms.js"></script>
</body>
</html>