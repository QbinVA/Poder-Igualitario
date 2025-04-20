<?php
// Conexión a la base de datos
require 'config/db.php';

// Verificar si se pasa un ID en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_noticia = $_GET['id'];

    // Consulta para obtener la noticia específica
    $sql = "SELECT * FROM publicaciones WHERE id_noticia = :id_noticia";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_noticia', $id_noticia, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener los resultados
    $noticia = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra la noticia
    if (!$noticia) {
        echo "Noticia no encontrada.";
        exit;
    }
} else {
    echo "ID de noticia no válido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($noticia['titular']); ?></title>
    <link rel="stylesheet" href="styles/noticiaIndStyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
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
    <!-- Header -->
    <header>
        <nav style="display: flex; justify-content: center; align-items: center; width: 100%;">
            <a href="index.php" style="text-decoration: none; color: inherit; text-align: center; font-size: 24px;">
                <p>Poder igualitario.</p>
            </a>            
        </nav>
    </header>

    <!-- Encabezado -->
    <section class="encabezado">
        <h1><?php echo htmlspecialchars($noticia['titular']); ?></h1>
        <p><strong>Fecha:</strong> <?php echo date("d/m/y", strtotime($noticia['fecha'])); ?></p>
    </section>

    <!-- Imagen principal -->
    <section class="uploads/img_67d139acdc8b75.13064540.png">
        <a href="<?php echo htmlspecialchars($noticia['url_imagen']); ?>" target="_blank">
            <img src="<?php echo htmlspecialchars($noticia['url_imagen']); ?>" alt="Imagen de la noticia" width="99%">
        </a>
    </section>      

    <!-- Contenido -->
    <section class="contenido">
        <p><?php echo nl2br(htmlspecialchars($noticia['contenido'])); ?></p>
    </section>

    <!-- Imágenes adicionales -->
    <?php if (!empty($noticia['imagenes'])): ?>
        <section class="imagenes">
            <h2>Galería de imágenes</h2>
            <div class="galeria">
                <?php 
                    $imagenes = explode(',', $noticia['imagenes']);
                    foreach ($imagenes as $imagen): 
                ?>
                    <img src="<?php echo htmlspecialchars($imagen); ?>" alt="Imagen" width="30%">
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- Referencias -->
    <section class="referencia">
        <h3>Referencias</h3>
        <?php if (!empty($noticia['referencia'])): ?>
            <ul>
                <li><a href="<?php echo htmlspecialchars($noticia['referencia']); ?>" target="_blank">Fuente original</a></li>
            </ul>
        <?php else: ?>
            <p>No se ha proporcionado una fuente original.</p>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer>
        <p>Las noticias encontradas en este blog no fueron redactadas por nuestro equipo, solo nos encargamos de difundir información.</p>
    </footer>
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

<!-- Contenedor oculto de Google Translate -->
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
