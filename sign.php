<?php
require('connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $mail = $_POST['mail'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($id && $mail && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo $hashedPassword;


        try {
            $stmt = $conn->prepare("INSERT INTO users (id, mail, password) VALUES (:id, :mail, :password)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                header('Location: loginn.html');
                exit;
            } else {
                // Avec PDO, cette partie est généralement traitée via des exceptions
                echo 'Inscription échouée. Veuillez réessayer.';
            }
        } catch (PDOException $e) {
            echo 'Inscription échouée. Erreur : ' . $e->getMessage();
        }
    } else {
        echo 'Veuillez remplir tous les champs requis.';
    }
}
?>
