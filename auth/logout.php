<?php
// auth/logout.php
session_start();

// Get language for redirection
$lang = $_GET['lang'] ?? 'es';

// Clear all session variables
$_SESSION = array();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Clear the "remember me" cookies if they exist
if (isset($_COOKIE['usuario_id'])) {
    setcookie('usuario_id', '', time() - 3600, '/');
}
if (isset($_COOKIE['usuario_nombre'])) {
    setcookie('usuario_nombre', '', time() - 3600, '/');
}
// Clear admin cookie if exists
if (isset($_COOKIE['es_admin'])) {
    setcookie('es_admin', '', time() - 3600, '/');
}

// Redirect to homepage
header("Location: ../index.php?lang=$lang");
exit;