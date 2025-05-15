<?php
require __DIR__ . '/azure/config.php';
require __DIR__ . '/azure/azure-translator.php';

$lang = $_GET['lang'] ?? 'es';

ob_start();
?>

<main class="privacy-main">
  <section class="privacy-section">
    <h1><?= $lang === 'es' ? 'Aviso de Privacidad' : 'Privacy Notice' ?></h1>

    <p><?= $lang === 'es' 
        ? 'En <strong>Voces Igualitarias</strong>, la privacidad de nuestros usuarios es una prioridad. Este aviso explica cómo recopilamos, usamos y protegemos los datos personales que nos proporcionas.'
        : 'At <strong>Voces Igualitarias</strong>, user privacy is a priority. This notice explains how we collect, use, and protect the personal data you provide us.' ?></p>

    <h2><?= $lang === 'es' ? '1. Responsable del Tratamiento' : '1. Data Controller' ?></h2>
    <p><?= $lang === 'es' 
        ? 'El responsable del tratamiento de los datos personales es el administrador del blog <strong>Voces Igualitarias</strong>. Puedes contactarnos a través del correo electrónico: <strong>[tu-email@ejemplo.com]</strong>.'
        : 'The data controller is the administrator of the <strong>Voces Igualitarias</strong> blog. You can contact us via email: <strong>[your-email@example.com]</strong>.' ?></p>

    <h2><?= $lang === 'es' ? '2. Datos que Recabamos' : '2. Data We Collect' ?></h2>
    <p><?= $lang === 'es'
      ? 'Recabamos los siguientes datos personales cuando interactúas con nuestro sitio:'
      : 'We collect the following personal data when you interact with our website:' ?></p>
    <ul>
      <li><?= $lang === 'es' ? 'Nombre de usuario' : 'Username' ?></li>
      <li><?= $lang === 'es' ? 'Correo electrónico' : 'Email address' ?></li>
      <li><?= $lang === 'es' ? 'Contraseña (almacenada de forma segura)' : 'Password (securely stored)' ?></li>
      <li><?= $lang === 'es' ? 'Dirección IP y datos de navegación' : 'IP address and browsing data' ?></li>
      <li><?= $lang === 'es' ? 'Cualquier contenido que publiques o compartas en el blog' : 'Any content you post or share on the blog' ?></li>
    </ul>

    <h2><?= $lang === 'es' ? '3. Finalidades del Tratamiento' : '3. Purposes of Data Processing' ?></h2>
    <p><?= $lang === 'es'
      ? 'Utilizamos tus datos personales para:'
      : 'We use your personal data for the following purposes:' ?></p>
    <ul>
      <li><?= $lang === 'es' ? 'Gestionar tu cuenta y proporcionar acceso al sitio' : 'Manage your account and provide access to the site' ?></li>
      <li><?= $lang === 'es' ? 'Enviar notificaciones o comunicaciones relacionadas con el servicio' : 'Send notifications or communications related to the service' ?></li>
      <li><?= $lang === 'es' ? 'Mejorar nuestros servicios, contenido y funcionalidad del sitio web' : 'Improve our services, content, and site functionality' ?></li>
      <li><?= $lang === 'es' ? 'Cumplir con obligaciones legales aplicables' : 'Comply with applicable legal obligations' ?></li>
    </ul>

    <h2><?= $lang === 'es' ? '4. Transferencias de Datos' : '4. Data Transfers' ?></h2>
    <p><?= $lang === 'es'
      ? 'No compartimos tus datos personales con terceros, salvo que exista obligación legal, requerimiento judicial o autorización expresa por tu parte.'
      : 'We do not share your personal data with third parties, unless legally required, by court order, or with your express consent.' ?></p>

    <h2><?= $lang === 'es' ? '5. Derechos ARCO' : '5. ARCO Rights' ?></h2>
    <p><?= $lang === 'es'
      ? 'Puedes ejercer tus derechos de Acceso, Rectificación, Cancelación y Oposición (ARCO) enviando un correo a: <strong>[tu-email@ejemplo.com]</strong>. Para procesar tu solicitud, podríamos solicitar información que permita confirmar tu identidad.'
      : 'You can exercise your rights of Access, Rectification, Cancellation, and Opposition (ARCO) by sending an email to: <strong>[your-email@example.com]</strong>. We may request additional information to verify your identity.' ?></p>

    <h2><?= $lang === 'es' ? '6. Revocación del Consentimiento' : '6. Revocation of Consent' ?></h2>
    <p><?= $lang === 'es'
      ? 'Puedes revocar tu consentimiento para el tratamiento de tus datos personales en cualquier momento contactándonos por correo electrónico. Esto no afectará la legalidad del tratamiento basado en el consentimiento previo a su revocación.'
      : 'You may revoke your consent to the processing of your personal data at any time by contacting us via email. This will not affect the lawfulness of processing based on prior consent.' ?></p>

    <h2><?= $lang === 'es' ? '7. Uso de Cookies' : '7. Use of Cookies' ?></h2>
    <p><?= $lang === 'es'
      ? 'Este sitio puede utilizar cookies propias y de terceros para mejorar la experiencia del usuario, analizar tráfico web y mostrar contenido personalizado. Puedes configurar tu navegador para bloquearlas o eliminarlas.'
      : 'This site may use first- and third-party cookies to enhance user experience, analyze web traffic, and display personalized content. You can configure your browser to block or delete them.' ?></p>

    <h2><?= $lang === 'es' ? '8. Seguridad de la Información' : '8. Information Security' ?></h2>
    <p><?= $lang === 'es'
      ? 'Adoptamos medidas de seguridad administrativas, técnicas y físicas para proteger tus datos personales contra daño, pérdida, alteración, destrucción o uso, acceso o tratamiento no autorizado.'
      : 'We implement administrative, technical, and physical security measures to protect your personal data from damage, loss, alteration, destruction, or unauthorized use, access, or processing.' ?></p>

    <h2><?= $lang === 'es' ? '9. Modificaciones al Aviso de Privacidad' : '9. Changes to This Privacy Notice' ?></h2>
    <p><?= $lang === 'es'
      ? 'Nos reservamos el derecho de modificar este aviso de privacidad en cualquier momento. Las modificaciones se publicarán en esta misma página y serán efectivas desde su publicación.'
      : 'We reserve the right to modify this privacy notice at any time. Modifications will be published on this page and become effective upon posting.' ?></p>

    <p><em><?= $lang === 'es' ? 'Última actualización: 14 de mayo de 2025' : 'Last updated: May 14, 2025' ?></em></p>
  </section>
</main>

<?php
$content = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $lang === 'es' ? 'Aviso de Privacidad' : 'Privacy Notice' ?> | Voces Igualitarias</title>

  <link rel="stylesheet" href="views/css/index.css">
  <link rel="stylesheet" href="views/css/header.css">
  <link rel="stylesheet" href="views/css/footer.css">

  <!-- Agrega el CSS para el aviso de privacidad -->
  <link rel="stylesheet" href="views/css/aviso-privacidad.css">
</head>

<body>

<?php include __DIR__ . '/views/layouts/header.php'; ?>

<?= $content ?>

<?php include __DIR__ . '/views/layouts/footer.php'; ?>

</body>
</html>
