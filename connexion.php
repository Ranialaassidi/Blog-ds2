<?php
// Configuration de la connexion à la base de données
define('SERVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'utilisateurs');

try {
    // Tentative de connexion à la base de données via PDO
    $conn = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DATABASE, USERNAME, PASSWORD);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Définir l'encodage des caractères pour la connexion
    $conn->exec("set names utf8");

    echo 'Connexion réussie.';

} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    die("Erreur de connexion : " . $e->getMessage());
}
?>
