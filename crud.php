<?php

require('connexion.php');

class Admin {
    private $conn;

    // Constructeur
    function __construct($conn) {
        $this->conn = $conn;
    }

    
  // Fonction pour créer un utilisateur
function addUser($id, $mail, $password) {
    $query = "INSERT INTO users (id, mail, password) VALUES (:id, :mail, :password)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':mail', $mail);
    $stmt->bindValue(':password', $password);
    return $stmt->execute();
}


    // Fonction pour lire tous les utilisateurs
    function getUsers() {
        $users = array();
        $query = "SELECT * FROM users";
        $result = $this->conn->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) { // Utilisez cette méthode
            $users[] = $row;
        }
        return $users;
    }
    
    // Fonction pour mettre à jour un utilisateur
    function updateUser($id, $mail, $password) {
        $query = "UPDATE users SET mail = ?, password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $mail);
        $stmt->bindValue(2, $password);
        $stmt->bindValue(3, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    // Fonction pour supprimer un utilisateur
    function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT); // PDO::PARAM_INT is used to specify the parameter type explicitly
        return $stmt->execute();
    }
    
}

// Instanciation de la classe Admin avec la connexion à la base de données
$admin = new Admin($conn);

if(isset($_POST['create'])) {
    $id = $_POST['id'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $admin->addUser($id, $mail, $password);
}

if(isset($_POST['read'])) {
    $users = $admin->getUsers();
    foreach($users as $user) {
        // Afficher les détails de chaque utilisateur
        echo "ID: " . $user['id'] . ", Email: " . $user['mail'] . "<br>";
    }
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $admin->updateUser($id, $mail, $password);
}

if(isset($_POST['delete'])) {
    $id = $_POST['id'];
    $admin->deleteUser($id);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        form h3 {
            margin-bottom: 10px;
        }
        input[type=text],
        input[type=email],
        input[type=password],
        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* include padding and border in element's width and height */
        }
        button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .user-list {
            background-color: #e9ecef;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
            overflow-x: auto; /* Enable horizontal scrolling if needed */
        }
        textarea {
            width: 100%;
            resize: none; /* Disable resizing */
        }
        h2{
            text-align:center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Administration des Utilisateurs</h2>
        <form action="logout.php" method="POST">
        <button type="submit" class="btn btn-danger">Déconnexion</button>
    </form>


        <!-- Formulaire pour créer un utilisateur -->
        <form action="crud.php" method="POST">
            <h3>Créer un utilisateur</h3>
            <input type="text" name="id" placeholder="ID" required>
            <input type="email" name="mail" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="create">Créer</button>
        </form>

        <!-- Formulaire pour lire les utilisateurs -->
        <form action="crud.php" method="POST">
            <h3>Lire les utilisateurs</h3>
            <div class="user-list">
            <textarea rows="10" cols="50" readonly>
                <?php
                if (isset($_POST['read'])) {
                    $users = $admin->getUsers();
                    foreach($users as $user) {
                        // Afficher les détails de chaque utilisateur
                        echo "ID: " . $user['id'] . ", Email: " . $user['mail'] . "\n";
                    }
                }
                ?>
            </textarea>
        </div>
        <button type="submit" name="read">Lire</button>
        </form>

        <!-- Formulaire pour mettre à jour un utilisateur -->
        <form action="crud.php" method="POST">
            <h3>Mettre à jour un utilisateur</h3>
            <input type="text" name="id" placeholder="ID de l'utilisateur à mettre à jour" required>
            <input type="email" name="mail" placeholder="Nouvel email">
            <input type="password" name="password" placeholder="Nouveau mot de passe">
            <button type="submit" name="update">Mettre à jour</button>
        </form>

        <!-- Formulaire pour supprimer un utilisateur -->
        <form action="crud.php" method="POST">
            <h3>Supprimer un utilisateur</h3>
            <input type="text" name="id" placeholder="ID de l'utilisateur à supprimer" required>
            <button type="submit" name="delete">Supprimer</button>
        </form>
    </div>
</body>
</html>
