<?php
// logout.php

session_start(); // Commencez ou reprenez la session.

// Détruisez toutes les données de session.
$_SESSION = array(); // Effacez les variables de session.
if (ini_get("session.use_cookies")) { // Si vous utilisez des cookies pour la session.
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy(); // Détruisez finalement la session.

header("Location: home.php"); // Redirigez vers la page de connexion.
exit();
?>
