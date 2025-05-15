<?php
// index.php

require __DIR__ . '/config/db.php';                  // Conexión a MySQL
require __DIR__ . '/azure/config.php';               // Constantes Azure
require __DIR__ . '/azure/azure-translator.php';     // Función de traducción

// Idioma solicitado
$lang = $_GET['lang'] ?? 'es';

// Traer publicaciones (siempre en ES)
try {
  $sql  = "SELECT id_noticia, fecha, titular, descripcion_corta, imagen_principal
           FROM publicaciones
           WHERE archivada = 0
           ORDER BY fecha DESC"; // Solo mostrar noticias no archivadas
  $stmt = $pdo->query($sql);
  $pubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Error al obtener publicaciones: " . $e->getMessage());
}

// 1) Salida fija de <head> y header (no se traduce)
?><!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poder Igualitario</title>

  <!-- Tus estilos habituales -->
  <link rel="stylesheet" href="views/css/index.css">
  <link rel="stylesheet" href="views/css/header.css">
  <link rel="stylesheet" href="views/css/footer.css">
  <link rel="stylesheet" href="views/css/font/font.css">
  
  <!-- Swiper CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.min.css" />
  
  <style>
    /* Estilos para el mensaje destacado y nuevo slider */
    .featured-message {
      width: 80%;
      margin: 20px auto;
      padding: 25px;
      background-color: rgba(255, 255, 255, 0.85);
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
      position: relative;
      z-index: 2;
    }
    
    .featured-message h3 {
      color: #009193;
      margin-bottom: 10px;
      font-size: 1.8em;
    }
    
    .featured-message p {
      font-size: 1.2em;
      line-height: 1.6;
      color: #333;
    }
    
    /* Nuevo slider moderno con tamaño aumentado */
    .modern-slider {
      width: 85%;
      margin: 0 auto 30px;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      height: 350px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
    
    .modern-slider .slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 1s ease;
    }
    
    .modern-slider .slide.active {
      opacity: 1;
    }
    
    .modern-slider .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .modern-slider .slide-content {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      padding: 20px;
      background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0));
      color: white;
      z-index: 2;
    }
    
    .modern-slider .slide-title {
      font-size: 1.3em;
      margin-bottom: 5px;
      font-weight: bold;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 90%;
    }
    
    .modern-slider .slide-date {
      font-size: 0.9em;
      opacity: 0.8;
    }
    
    .slider-controls {
      position: absolute;
      bottom: 15px;
      right: 15px;
      display: flex;
      justify-content: center;
      gap: 10px;
      z-index: 5;
    }
    
    .slider-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.5);
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .slider-dot.active {
      background-color: #01BDA3;
      transform: scale(1.2);
    }
    
    /* Estilos para Swiper - mejorado */
    .swiper-container {
      width: 100%;
      padding: 30px 10px;
      overflow: hidden;
    }
    
    .swiper-slide {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      height: 340px;
      overflow: hidden;
      transition: all 0.3s ease;
      border-top: 3px solid #01BDA3;
    }
    
    .swiper-slide:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }
    
    .card-image {
      height: 160px;
      width: 100%;
      object-fit: cover;
    }
    
    .card-content {
      padding: 15px;
    }
    
    .card-title {
      font-size: 16px;
      font-weight: bold;
      margin: 0 0 10px;
      color: #009193;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      height: 44px;
      text-overflow: ellipsis;
    }
    
    .card-description {
      font-size: 14px;
      color: #555;
      margin-bottom: 10px;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      height: 64px;
      text-overflow: ellipsis;
    }
    
    .card-date {
      font-size: 12px;
      color: #999;
      display: block;
      margin-top: 5px;
    }
    
    .card-more {
      display: inline-block;
      color: #01BDA3;
      font-size: 14px;
      font-weight: 500;
      margin-top: 5px;
    }
    
    /* Ocultamos los botones de navegación del swiper */
    .swiper-button-next, 
    .swiper-button-prev {
      display: none;
    }
    
    /* Swiper Pagination */
    .swiper-pagination {
      position: relative;
      margin-top: 20px;
    }
    
    .swiper-pagination-bullet {
      background: #01BDA3;
      opacity: 0.5;
      width: 10px;
      height: 10px;
    }
    
    .swiper-pagination-bullet-active {
      opacity: 1;
      background: #01BDA3;
      transform: scale(1.2);
    }
    
    .section-title {
      text-align: center;
      color: #009193;
      margin: 30px 0 20px;
      font-size: 1.8em;
    }
  </style>
</head>
<body>
  <!-- Header fijo -->
  <?php include __DIR__ . '/views/layouts/header.php'; ?>

  <!-- Mensaje destacado (actualizado) -->
  <section class="featured-message">
    <h3>Bienvenidos a Poder Igualitario</h3>
    <p>Descubre las últimas noticias y contenidos enfocados en igualdad, participación y cambio social. Y siéntete libre de comentar en las noticias.</p>
  </section>

  <!-- Slider moderno con noticias de la base de datos -->
  <section class="modern-slider">
 <?php
  // Mezclamos y cortamos a 4
  $random_pubs = $pubs;
  shuffle($random_pubs);
  $random_pubs = array_slice($random_pubs, 0, 4);

  foreach ($random_pubs as $i => $pub):
    // Extraemos solo el nombre de fichero, eliminando cualquier ../ o uploads/
    $file = basename($pub['imagen_principal']);
    // Construimos la URL correcta
    $imgSrc = "uploads/$file";
?>
      <div class="slide <?= $i === 0 ? 'active' : '' ?>">
        <img src="uploads/<?= htmlspecialchars($pub['imagen_principal']) ?>" alt="<?= htmlspecialchars($pub['titular']) ?>">
        <div class="slide-content">
          <h3 class="slide-title">
            <?php
              // Cortar el título a 40 caracteres máximo
              $title = htmlspecialchars($pub['titular']);
              echo (strlen($title) > 40) ? substr($title, 0, 40) . '...' : $title;
            ?>
          </h3>
          <div class="slide-date">
            <?= ($lang === 'es')
                ? date("d/m/Y", strtotime($pub['fecha']))
                : date("m/d/Y", strtotime($pub['fecha'])); ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    
    <!-- Controles del slider -->
    <div class="slider-controls">
      <?php for($i = 0; $i < count($random_pubs); $i++): ?>
        <div class="slider-dot <?= $i === 0 ? 'active' : '' ?>" data-index="<?= $i ?>"></div>
      <?php endfor; ?>
    </div>
  </section>

<?php
// 2) Abrimos buffer para TODO lo que SÍ queremos traducir:
//    <main> y el footer partial
ob_start();
?>

  <main>
    <!-- Swiper con todas las noticias -->
    <h3 class="section-title">Noticias sobre la igualdad de género</h3>
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <?php foreach ($pubs as $pub): ?>
          <div class="swiper-slide">
            <a href="views/layouts/ver_publicacion.php?id=<?= $pub['id_noticia'] ?>&lang=<?= $lang ?>">
              <img src="uploads/<?= htmlspecialchars($pub['imagen_principal']) ?>" alt="" class="card-image">
              <div class="card-content">
                <h5 class="card-title"><?= htmlspecialchars($pub['titular']) ?></h5>
                <p class="card-description"><?= htmlspecialchars($pub['descripcion_corta']) ?></p>
                <span class="card-date">
                  <?= ($lang === 'es')
                      ? date("d/m/Y", strtotime($pub['fecha']))
                      : date("m/d/Y", strtotime($pub['fecha'])); ?>
                </span>
                <div class="card-more">Ver más...</div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
      <!-- Agregar paginación -->
      <div class="swiper-pagination"></div>
    </div>
  </main>

  <!-- Footer (dentro del buffer para traducción) -->
  <?php include __DIR__ . '/views/layouts/footer.php'; ?>

  <!-- Swiper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.2/swiper-bundle.min.js"></script>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    // Script para el slider moderno
    const slides = document.querySelectorAll('.modern-slider .slide');
    const dots = document.querySelectorAll('.slider-dot');
    let currentIndex = 0;
    
    // Función para cambiar slide
    function changeSlide(index) {
      // Ocultar slide actual
      slides[currentIndex].classList.remove('active');
      dots[currentIndex].classList.remove('active');
      
      // Actualizar índice
      currentIndex = index;
      
      // Si el índice se sale del rango, ajustarlo
      if (currentIndex >= slides.length) currentIndex = 0;
      if (currentIndex < 0) currentIndex = slides.length - 1;
      
      // Mostrar nuevo slide
      slides[currentIndex].classList.add('active');
      dots[currentIndex].classList.add('active');
    }
    
    // Auto cambio cada 4 segundos
    let slideInterval = setInterval(() => {
      changeSlide(currentIndex + 1);
    }, 4000);
    
    // Event listeners para los dots
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        clearInterval(slideInterval);
        changeSlide(index);
        slideInterval = setInterval(() => {
          changeSlide(currentIndex + 1);
        }, 4000);
      });
    });

    // Inicializar Swiper para las tarjetas
    new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        // Cuando el ancho de la ventana es >= 640px
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        // Cuando el ancho de la ventana es >= 768px
        768: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        // Cuando el ancho de la ventana es >= 1024px
        1024: {
          slidesPerView: 4,
          spaceBetween: 30,
        },
      }
    });
  });
</script>
</body>
</html>
<?php
// 3) Capturamos todo el contenido traducible
$content = ob_get_clean();
// 4) Imprimir traducido si lang='en'
if ($lang === 'en') {
    echo azureTranslate($content, 'en', 'es', true);
} else {
    echo $content;
}
?>