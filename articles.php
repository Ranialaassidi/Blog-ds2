<?php
$lang = $_GET['lang'] ?? 'fr'; // 'fr' pour le français par défaut, 'en' pour l'anglais
$translations = require __DIR__ . "/translations_{$lang}.php";
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $translations['title']; ?></title>
    <style>
    h2{
        text-align:center;
    }
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
        background-image: url('bibi.jpg'); /* Assurez-vous que le chemin de l'image est correct */
        background-repeat: no-repeat;
        background-size: cover;
        line-height: 1.6;
    }
    header {
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent pour la lisibilité */
        color: #333; /* Couleur plus foncée pour le contraste */
        padding: 20px 0;
        text-align: center;
    }

    nav ul {
        list-style-type: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        color: #333; /* Couleur foncée pour le contraste */
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    nav ul li a:hover, .nav-btn:hover {
        background-color: #007bff;
        color: #fff; /* Texte blanc sur fond bleu au survol */
    }

    .nav-btn {
        background-color: #fff;
        color: #333;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer; /* Indique qu'il s'agit d'un bouton cliquable */
    }

    .container {
        max-width: 800px;
        margin: 30px auto; /* Plus de marge en haut et en bas */
        background-color: #fff; /* Fond blanc pour les articles */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .article-block {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px; /* Espace entre les articles */
        background-color: #f8f8f8; /* Un fond légèrement différent pour chaque bloc */
        overflow: hidden; /* Garde tout le contenu à l'intérieur du bloc */
    }

    .article img {
    width: auto; /* La largeur s'ajuste automatiquement en fonction de la hauteur */
    height: auto; /* La hauteur s'ajuste automatiquement pour maintenir le rapport d'aspect */
    max-width: 150px; /* Largeur maximale réduite pour les images */
    max-height: 100px; /* Hauteur maximale pour les images */
    border-radius: 8px; /* Coins arrondis pour l'image */
    margin-right: 15px; /* Marge à droite de l'image */
    margin-bottom: 10px; /* Marge en dessous de l'image */
    float: left; /* Permet au texte de s'enrouler autour de l'image */
}

    .article h3, .article p {
        margin: 10px 0; /* Marge en haut et en bas pour les titres et paragraphes */
    }

    .read-more a {
        display: inline-block; /* Permet les marges */
        margin-top: 10px;
        color: #007bff;
        text-decoration: underline;
    }

    .read-more a:hover {
        text-decoration: none; /* Pas de soulignement au survol */
    }
</style>


    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="home.php">home</a></li>
                <li><a href="?lang=en">English</a></li>
                <li><a href="?lang=fr">Français</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2><?php echo $translations['heading']; ?></h2>
        <!-- Article 1 -->
        <div class="article-block">
            <img src="bebe.jpg" alt="Image article 1">
            <h3><?php echo $translations['history_article_title']; ?></h3>
            <p><?php echo $translations['history_article_content']; ?></p>
            <!-- Bouton de lecture complète ou de réduction du texte -->
        </div>
        <!-- Article 2 -->
        <div class="article-block">
            <img src="lolo.jpg" alt="Image article 2">
            <h3><?php echo $translations['conflict_article_title']; ?></h3>
            <p><?php echo $translations['conflict_article_content']; ?></p>
            <!-- Bouton de lecture complète ou de réduction du texte -->
        </div>
        <!-- Article 3 -->
        <div class="article-block">
            <img src="bibiii.jpg" alt="Image article 3">
            <h3><?php echo $translations['culture_article_title']; ?></h3>
            <p><?php echo $translations['culture_article_content']; ?></p>
            <!-- Bouton de lecture complète ou de réduction du texte -->
        </div>
    </div>
</body>
</html>

    
