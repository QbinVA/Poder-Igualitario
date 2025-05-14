<?php

require '../config/db.php';

// Obtener publicaciones activas
try {
    $sql = "SELECT id_noticia, fecha, titular, descripcion_corta, imagen_principal FROM publicaciones WHERE archivada = 0 ORDER BY fecha DESC";
    $stmt = $pdo->query($sql);
    $publicaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener publicaciones: " . $e->getMessage());
}

// Obtener publicaciones archivadas
try {
    $sql = "SELECT id_noticia, fecha, titular, descripcion_corta, imagen_principal FROM publicaciones WHERE archivada = 1 ORDER BY fecha DESC";
    $stmt = $pdo->query($sql);
    $archivadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener publicaciones archivadas: " . $e->getMessage());
}

// Obtener datos del administrador
try {
    $sqlAdmin = "SELECT nombre, correo FROM admin WHERE id_admin = 1";
    $stmtAdmin = $pdo->query($sqlAdmin);
    $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener datos del administrador: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../views/css/admin.css">
    <link rel="stylesheet" href="../views/css/font/font.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2><a href="../index.php">Voces Igualitarias</a></h2> <img src="../views/assets/Iguales.png" alt="Logo" class="logo-img"></a>
            <div class="user-info">
                <p><?php echo htmlspecialchars($admin['nombre']); ?></p>
                <p><?php echo htmlspecialchars($admin['correo']); ?></p>
            </div>
            <a href="#" class="back-link">⬅ Regresar al Blog</a>
        </aside>

        <main class="main-content">
            <h1>¡Bienvenido al panel de administración!</h1>
            <div class="button-container">
                <button id="toggleView" class="btn-ver-archivadas">🗂 Ver archivadas</button>
                <form action="crear_publicacion.php" method="get">
                    <button type="submit" class="new-button btn-nueva-publicacion">➕ Nueva publicación</button>
                </form>
            </div>

            <!-- Tabla principal -->
            <div id="tablaActivas" class="tabla-publicaciones visible">
                <h2>Publicaciones activas</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Titular</th>
                            <th>Fecha</th>
                            <th>Previsualizar</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                            <th>Archivar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($publicaciones as $pub): ?>
                            <tr>
                                <td data-label="Titular"><?php echo htmlspecialchars($pub['titular']); ?></td>
                                <td data-label="Fecha"><?php echo date("d/m/Y", strtotime($pub['fecha'])); ?></td>
                                <td data-label="Previsualizar"><a href="../views/layouts/ver_publicacion.php?id=<?php echo $pub['id_noticia']; ?>">🔍</a></td>
                                <td data-label="Editar"><a href="editar_publicacion.php?id=<?php echo $pub['id_noticia']; ?>">✏️</a></td>
                                <td data-label="Eliminar">
                                    <a href="#" 
                                    onclick="mostrarConfirmacion('¿Estás seguro de eliminar esta publicación?', function() {
                                        window.location.href = 'eliminar_publicacion.php?id_noticia=<?php echo $pub['id_noticia']; ?>';
                                    }); return false;">❌</a>
                                </td>
                                <td data-label="Archivar">
                                    <a href="#" 
                                    onclick="mostrarConfirmacion('¿Estás seguro de archivar esta publicación?', function() {
                                        window.location.href = 'archivar_publicacion.php?id_noticia=<?php echo $pub['id_noticia']; ?>';
                                    }); return false;">📥</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Tabla archivadas -->
            <div id="tablaArchivadas" class="tabla-publicaciones hidden">
                <h2>Publicaciones archivadas</h2>
            <?php if (empty($archivadas)) { ?>
                <p class="no-archivadas">No hay publicaciones archivadas.</p>
            <?php } else { ?>    
                <table>
                    <thead>
                        <tr>
                            <th>Titular</th>
                            <th>Fecha</th>
                            <th>Previsualizar</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                            <th>Restaurar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($archivadas as $arch): ?>
                            <tr>
                                <td data-label="Titular"><?php echo htmlspecialchars($arch['titular']); ?></td>
                                <td data-label="Fecha"><?php echo date("d/m/Y", strtotime($arch['fecha'])); ?></td>
                                <td data-label="Previsualizar"><a href="../views/layouts/ver_publicacion.php?id=<?php echo $arch['id_noticia']; ?>">🔍</a></td>
                                <td data-label="Editar"><a href="editar_publicacion.php?id=<?php echo $arch['id_noticia']; ?>">✏️</a></td>
                                <td data-label="Eliminar">
                                    <a href="#" 
                                    onclick="mostrarConfirmacion('¿Estás seguro de eliminar esta publicación?', function() {
                                        window.location.href = 'eliminar_publicacion.php?id_noticia=<?php echo $arch['id_noticia']; ?>';
                                    }); return false;">❌</a>
                                </td>
                                <td data-label="Restaurar">
                                    <a href="#" 
                                    onclick="mostrarConfirmacion('¿Estás seguro de restaurar esta publicación?', function() {
                                        window.location.href = 'restaurar_publicacion.php?id_noticia=<?php echo $arch['id_noticia']; ?>';
                                    }); return false;">♻️</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } ?>    
            </div>
        </main>
    </div>

    <!-- Incluir el archivo de notificaciones -->
    <?php include '../views/layouts/notificaciones.php'; ?>
    <script src="../views/js/admin.js"></script>
</body>
</html>