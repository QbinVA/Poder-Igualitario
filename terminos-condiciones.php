<?php
require __DIR__ . '/azure/config.php';
require __DIR__ . '/azure/azure-translator.php';

$lang = $_GET['lang'] ?? 'es';

ob_start();
?>

<main class="terms-main">
  <section class="terms-section">
    <h1><?= $lang === 'es' ? 'Términos y Condiciones' : 'Terms and Conditions' ?></h1>

    <p><?= $lang === 'es'
      ? 'Bienvenido/a a <strong>Voces Igualitarias</strong>. Al registrarte, navegar o interactuar en nuestro blog, aceptas los siguientes términos y condiciones que regulan el uso del sitio web, así como la relación entre los usuarios y los administradores del mismo.'
      : 'Welcome to <strong>Voces Igualitarias</strong>. By registering, browsing, or interacting on our blog, you agree to the following terms and conditions that govern the use of the website and the relationship between users and site administrators.' ?></p>

    <h2><?= $lang === 'es' ? '1. Identificación del Responsable' : '1. Identification of the Responsible Party' ?></h2>
    <p><?= $lang === 'es'
      ? 'El presente sitio web es operado por el equipo de <strong>Voces Igualitarias</strong>. Para cualquier consulta relacionada con estos términos, puedes escribirnos a: <strong>[tu-email@ejemplo.com]</strong>.'
      : 'This website is operated by the <strong>Voces Igualitarias</strong> team. For any inquiries related to these terms, you may contact us at: <strong>[your-email@example.com]</strong>.' ?></p>

    <h2><?= $lang === 'es' ? '2. Aceptación de los Términos' : '2. Acceptance of Terms' ?></h2>
    <p><?= $lang === 'es'
      ? 'El uso del sitio implica la aceptación plena y sin reservas de cada una de las disposiciones incluidas en estos términos y condiciones. Si no estás de acuerdo con cualquiera de las condiciones, no debes utilizar este sitio web.'
      : 'Use of the site implies full and unreserved acceptance of each of the provisions included in these terms and conditions. If you do not agree with any of the conditions, you should not use this website.' ?></p>

    <h2><?= $lang === 'es' ? '3. Registro de Usuario' : '3. User Registration' ?></h2>
    <p><?= $lang === 'es'
      ? 'Para acceder a ciertas funcionalidades, es necesario registrarse proporcionando los siguientes datos:'
      : 'To access certain features, registration is required by providing the following data:' ?></p>
    <ul>
      <li><?= $lang === 'es' ? 'Nombre de usuario' : 'Username' ?></li>
      <li><?= $lang === 'es' ? 'Correo electrónico' : 'Email address' ?></li>
      <li><?= $lang === 'es' ? 'Contraseña' : 'Password' ?></li>
      <li><?= $lang === 'es' ? 'Confirmación de contraseña' : 'Password confirmation' ?></li>
    </ul>
    <p><?= $lang === 'es'
      ? 'El usuario es responsable de mantener sus credenciales seguras. No compartas tu contraseña y notifícanos cualquier uso no autorizado.'
      : 'Users are responsible for keeping their credentials secure. Do not share your password and notify us of any unauthorized use.' ?></p>

    <h2><?= $lang === 'es' ? '4. Uso del Sitio' : '4. Use of the Site' ?></h2>
    <p><?= $lang === 'es'
      ? 'El propósito de <strong>Voces Igualitarias</strong> es fomentar el diálogo inclusivo. Está estrictamente prohibido:'
      : 'The purpose of <strong>Voces Igualitarias</strong> is to foster inclusive dialogue. It is strictly prohibited to:' ?></p>
    <ul>
      <li><?= $lang === 'es' ? 'Difundir contenido ofensivo, violento, discriminatorio o ilegal' : 'Spread offensive, violent, discriminatory, or illegal content' ?></li>
      <li><?= $lang === 'es' ? 'Realizar spam o promociones comerciales no autorizadas' : 'Conduct spam or unauthorized commercial promotions' ?></li>
      <li><?= $lang === 'es' ? 'Acceder de forma no autorizada a cuentas o sistemas del sitio' : 'Gain unauthorized access to accounts or site systems' ?></li>
      <li><?= $lang === 'es' ? 'Violar derechos de autor o propiedad intelectual de terceros' : 'Violate third-party copyright or intellectual property rights' ?></li>
    </ul>

    <h2><?= $lang === 'es' ? '5. Contenido Generado por el Usuario' : '5. User-Generated Content' ?></h2>
    <p><?= $lang === 'es'
      ? 'Los usuarios pueden contribuir con comentarios u otros contenidos. Al hacerlo, cedes a <strong>Voces Igualitarias</strong> el derecho no exclusivo de utilizar, reproducir y mostrar dicho contenido. Nos reservamos el derecho de eliminar cualquier contenido que infrinja estos términos.'
      : 'Users may contribute comments or other content. By doing so, you grant <strong>Voces Igualitarias</strong> a non-exclusive right to use, reproduce, and display such content. We reserve the right to remove any content that violates these terms.' ?></p>

    <h2><?= $lang === 'es' ? '6. Protección de Datos' : '6. Data Protection' ?></h2>
    <p><?= $lang === 'es'
      ? 'Nos comprometemos a proteger tus datos personales conforme a lo establecido en nuestro '
      : 'We are committed to protecting your personal data in accordance with our ' ?>
      <a href="aviso-privacidad.php?lang=<?= htmlspecialchars($lang, ENT_QUOTES) ?>">
        <?= $lang === 'es' ? 'Aviso de Privacidad' : 'Privacy Notice' ?>
      </a>.
      <?= $lang === 'es' ? ' La información será tratada de manera confidencial y no será compartida con terceros sin tu consentimiento.' : ' Your information will be treated confidentially and will not be shared with third parties without your consent.' ?>
    </p>

    <h2><?= $lang === 'es' ? '7. Propiedad Intelectual' : '7. Intellectual Property' ?></h2>
    <p><?= $lang === 'es'
      ? 'Todos los contenidos del sitio (textos, imágenes, diseño, código) son propiedad de <strong>Voces Igualitarias</strong> o de sus respectivos autores. Está prohibido reproducir o distribuir dichos contenidos sin autorización previa.'
      : 'All site content (texts, images, design, code) is the property of <strong>Voces Igualitarias</strong> or its respective authors. Reproducing or distributing such content without prior authorization is prohibited.' ?></p>

    <h2><?= $lang === 'es' ? '8. Limitación de Responsabilidad' : '8. Limitation of Liability' ?></h2>
    <p><?= $lang === 'es'
      ? 'No garantizamos la disponibilidad continua del sitio ni la ausencia de errores. <strong>Voces Igualitarias</strong> no se hace responsable de daños derivados del uso del sitio.'
      : 'We do not guarantee continuous availability of the site or absence of errors. <strong>Voces Igualitarias</strong> is not responsible for damages resulting from the use of the site.' ?></p>

    <h2><?= $lang === 'es' ? '9. Modificaciones' : '9. Modifications' ?></h2>
    <p><?= $lang === 'es'
      ? 'Nos reservamos el derecho de actualizar estos términos en cualquier momento. Te recomendamos revisar periódicamente esta página para estar al tanto de cualquier cambio.'
      : 'We reserve the right to update these terms at any time. We recommend periodically reviewing this page to stay informed of any changes.' ?></p>

    <h2><?= $lang === 'es' ? '10. Legislación Aplicable' : '10. Governing Law' ?></h2>
    <p><?= $lang === 'es'
      ? 'Estos términos y condiciones se rigen por la legislación vigente del país en el que se opera el sitio. Cualquier controversia se someterá a los tribunales competentes de dicha jurisdicción.'
      : 'These terms and conditions are governed by the laws of the country in which the site operates. Any dispute will be submitted to the competent courts of that jurisdiction.' ?></p>

    <p><em><?= $lang === 'es' ? 'Última actualización: 9 de mayo de 2025' : 'Last updated: May 9, 2025' ?></em></p>
  </section>
</main>

<?php
$content = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES) ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $lang === 'es' ? 'Términos y Condiciones' : 'Terms and Conditions' ?> | Voces Igualitarias</title>

  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/header.css" />
  <link rel="stylesheet" href="css/footer.css" />
</head>
<body>

<?php include __DIR__ . '/views/layouts/header.php'; ?>

<?= $content ?>

<?php include __DIR__ . '/views/layouts/footer.php'; ?>

</body>
</html>
