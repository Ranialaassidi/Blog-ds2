<?php
// like_article.php
require('connexion.php');
session_start();

// Assurez-vous que l'utilisateur est connecté et obtenez son ID
$user_id = $_SESSION['user_id'] ?? null;

if ($user_id && isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
    
    // Ajouter le like à la base de données
    $stmt = $conn->prepare("INSERT INTO likes (article_id, user_id) VALUES (?, ?)");
    $stmt->bindParam(1, $article_id);
    $stmt->bindParam(2, $user_id);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            // Gestion du cas où l'utilisateur a déjà aimé l'article
        } else {
            // Gestion des autres erreurs
        }
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
