<?php
$pdo = new PDO("mysql:host=localhost;dbname=sae203;charset=utf8", "root", "");

// Récupération des utilisateurs
$utilisateurs = $pdo->query("SELECT * FROM utilisateurs")->fetchAll(PDO::FETCH_ASSOC);

// Récupération du matériel
$materiels = $pdo->query("SELECT * FROM materiel")->fetchAll(PDO::FETCH_ASSOC);

// Récupération des étudiants
$etudiants = $pdo->query("SELECT * FROM etudiants")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Envoi des données au fichier HTML -->
<?php include 'admin_view.php'; ?>
