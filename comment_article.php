<?php
// comment_article.php

require('connexion.php');
session_start();

// Assurez-vous que l'utilisateur est connecté et obtenez son ID.
// Ici, vous devez implémenter votre propre logique de vérification de l'utilisateur.
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion ou affichez un message.
    die('You must be logged in to comment.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['article_id']) && !empty($_POST['comment'])) {
    $article_id = $_POST['article_id'];
    $comment = $_POST['comment'];
    $created_at = date('Y-m-d H:i:s'); // Utilisez la date et l'heure actuelles pour le timestamp du commentaire.

    try {
        // Préparez la requête d'insertion des commentaires.
        $stmt = $conn->prepare("INSERT INTO comments (article_id, user_id, comment, created_at) VALUES (?, ?, ?, ?)");
        $stmt->execute([$article_id, $user_id, $comment, $created_at]);

        // Redirigez l'utilisateur vers la page précédente ou vers la page de l'article avec un message de succès.
        $_SESSION['message'] = 'Comment added successfully!';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } catch (PDOException $e) {
        // Gérez les erreurs de base de données ici.
        error_log('Error inserting comment: ' . $e->getMessage());
        $_SESSION['error'] = 'Failed to add comment.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    // Si les données nécessaires ne sont pas présentes, redirigez avec un message d'erreur.
    $_SESSION['error'] = 'All fields are required.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

