<?php
require('connexion.php');
session_start();

// Vérifier si les données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    // Vérifier les informations d'identification de l'administrateur
    // Utilisation de requêtes préparées pour éviter les injections SQL
    $stmt = $conn->prepare("SELECT * FROM admin WHERE id = :id AND mail = :mail AND password = :password");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) == 1) {
        // L'utilisateur est un administrateur, rediriger vers la page souhaitée
        header("Location: crud.php");
        exit();
    } else {
        // L'utilisateur n'est pas un administrateur, afficher un message d'erreur ou rediriger vers une autre page
        echo "Vous n'êtes pas autorisé à accéder à cette page.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="inscription.css">
    <script language="javascript" src="scriptt.js"></script>
    <title>Sign In</title>
</head>
<body>
    <div class="ins">
        <div class="form-ins sign-in">
            <form action="" method="POST">
                <h2>LOGIN</h2>
                <div class="input-group">
                    <input type="text" name="id" required>
                    <label for="">id</label>
                </div>
                <div class="input-group">
                    <input type="text" name="mail" required>
                    <label for="">mail</label>
                </div>
                <div class="input-group">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                        </span>
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                </div>
                <div class="remember">
                    <label><input type="checkbox">Remember Me?</label>
                </div>
                <button type="submit" onclick="return validateForm()">Login</button>
               
            </form> 
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
