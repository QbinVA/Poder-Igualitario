<?php
require 'config/db.php'; // Conexión a la base de datos

// Obtener todas las publicaciones
try {
    // Cambié 'id' por 'id_noticia'
    $sql = "SELECT id_noticia, fecha, titular, descripcion_corta, imagen_principal FROM publicaciones ORDER BY fecha DESC";
    $stmt = $pdo->query($sql);
    $publicaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener publicaciones: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles/adminStyles.css">
    <style>
  /* Ocultar barra de Google Translate */
  .goog-te-banner-frame.skiptranslate,
  .goog-logo-link,
  .goog-te-gadget {
    display: none !important;
  }

  body {
    top: 0px !important;
  }
</style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
        <h2><a href="index.php" class="home-link">Poder Igualitario</a></h2>
        <div class="user-info">
                <p class="user-name">Kevin Valdovinos</p>
                <p class="user-email">kvaldovinos2@puol.com</p>
            </div>
            <a href="#" class="back-link">⬅ Regresar al Blog</a>
        </aside>

        <main class="main-content">
            <h1>¡Bienvenido, Kevin!</h1>
            <h2>Noticias</h2>
            <div class="button-container">
                <form action="crearPublicacionForms.html" method="get">
                    <button type="submit" class="new-button">Crear</button>
                </form>
            </div>
            <table class="news-table">
                <thead>
                    <tr>
                        <th>Encabezado</th>
                        <th>Fecha</th>
                        <th>Previsualizar</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($publicaciones as $publicacion): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($publicacion['titular']); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($publicacion['fecha'])); ?></td>
                            <td><a href="ver_publicacion.php?id=<?php echo $publicacion['id_noticia']; ?>">🔍</a></td>
                            <td><a href="editar_publicacion.php?id=<?php echo $publicacion['id_noticia']; ?>">✏️</a></td>
                            <td><a href="eliminar_publicacion.php?id=<?php echo $publicacion['id_noticia']; ?>" onclick="return confirm('¿Seguro que quieres eliminar esta publicación?');">❌</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
<div id="language-switcher" style="text-align: right; padding: 10px;">
  <button id="lang-btn" onclick="changeLanguage('en')" style="
      background-color: black;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 14px;
  ">🌐 Inglés</button>
</div>

<div id="google_translate_element" style="display: none;"></div>

<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'es',
      includedLanguages: 'es,en',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }

  function changeLanguage(lang) {
    const select = document.querySelector('.goog-te-combo');
    if (select) {
      select.value = lang;
      select.dispatchEvent(new Event('change'));

      // Guardar preferencia en navegador
      localStorage.setItem('idiomaPreferido', lang);

      // Cambiar texto del botón
      const btn = document.getElementById('lang-btn');
      const nextLang = lang === 'en' ? 'es' : 'en';
      btn.textContent = nextLang === 'en' ? '🌐 Inglés' : '🌐 Español';
      btn.setAttribute('onclick', `changeLanguage('${nextLang}')`);
    }
  }

  // Aplicar idioma guardado
  window.addEventListener('load', () => {
    const lang = localStorage.getItem('idiomaPreferido');
    if (lang) {
      const interval = setInterval(() => {
        const select = document.querySelector('.goog-te-combo');
        if (select) {
          changeLanguage(lang);
          clearInterval(interval);
        }
      }, 300);
    }
  });
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
