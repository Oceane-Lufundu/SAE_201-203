<?php
// Informations de connexion à la base de données
$host = "localhost";
$dbname = "sae_203";
$username = "root";
$password = ""; // ou ton mot de passe

try {
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configuration des options PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Affiche les erreurs
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Mode de récupération des données
} catch (PDOException $e) {
    // En cas d'erreur, affiche un message (à désactiver en production)
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
