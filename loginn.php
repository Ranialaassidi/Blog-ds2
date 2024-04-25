<?php
ob_start(); // Commence la mise en tampon de la sortie
require('connexion.php'); // Assurez-vous que ce fichier utilise PDO pour la connexion

// Démarrer la session ici
session_start();

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['password'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    try {
        // Préparez une requête pour chercher l'utilisateur par son ID
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifiez si le mot de passe correspond
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: article.php');
                exit();
            } else {
                // Redirigez avec un message d'erreur dans l'URL
                $message = urlencode('Connexion échouée. Mot de passe incorrect.');
                header("Location: loginn.html?message=$message");
                exit();
            }
        } else {
            // Aucun utilisateur trouvé avec cet ID
            $message = urlencode('Connexion échouée. Aucun utilisateur trouvé avec cet ID.');
            header("Location: loginn.html?message=$message");
            exit();
        }
    } catch (PDOException $e) {
        // Gérer l'exception
        $message = urlencode('Erreur de connexion : ' . $e->getMessage());
        header("Location: loginn.html?message=$message");
        exit();
    }
}

mysqli_close($conn);
ob_end_flush(); // Envoyez le contenu tamponné au navigateur
?>
