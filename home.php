<?php
// Déterminez la langue à utiliser en fonction du paramètre de langue dans l'URL
$lang = isset($_GET['lang']) ? htmlspecialchars($_GET['lang']) : 'en';
$translations = [];
// Incluez le fichier de traduction approprié
$allowed_langs = ['fr', 'en'];
if (in_array($lang, $allowed_langs)) {
    $translation_file = "translations_{$lang}.php";
    if (file_exists($translation_file)) {
        require_once $translation_file;
    } else {
        require_once "translations_en.php";  // Fallback to English if the translation file doesn't exist
    }
} else {
    require_once "translations_en.php";  // Fallback to English if an unsupported language is requested
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palestine Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="loginn.html" class="nav-btn"><?php echo isset($translations['login']) ? $translations['login'] : 'Login'; ?></a></li>
                <li><a href="signup.html" class="nav-btn"><?php echo isset($translations['signUp']) ? $translations['signUp'] : 'Sign Up'; ?></a></li>
                <li><a href="?lang=en">English</a></li>
                <li><a href="?lang=fr">Français</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <!-- Contenu de la page avec des traductions -->
        <h2><?php echo isset($translations['welcomeTitle']) ? $translations['welcomeTitle'] : 'Default Title'; ?></h2>
<p><?php echo isset($translations['welcomeMessage']) ? $translations['welcomeMessage'] : 'Default message'; ?></p>
    </section>
    <footer>
        <p>&copy; 2024 Palestine Blog</p>
    </footer>
</body>
</html>