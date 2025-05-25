<?php
$host = "localhost";
$dbname = "sae_203";
$username = "root"; 
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ? AND role = 'enseignant'");
$stmt->execute([$id]);
$reservation = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma réservation (Enseignant)</title>
</head>
<body>
    <h1>Réservation enseignant effectuée</h1>
    <p><strong>Nom :</strong> <?= htmlspecialchars($reservation['nom']) ?></p>
    <p><strong>Date d'accès :</strong> <?= htmlspecialchars($reservation['date_acces']) ?></p>
    <p><strong>Salle :</strong> <?= htmlspecialchars($reservation['salle']) ?></p>
</body>
</html>
