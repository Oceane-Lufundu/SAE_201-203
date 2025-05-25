<?php
$host = "localhost";
$dbname = "sae_203";
$username = "root"; 
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

// Supposons que l'élève soit connecté et qu'on récupère son email depuis une session
session_start();
$eleve_email = $_SESSION['email'] ?? '';

$stmt = $conn->prepare("SELECT * FROM reservations WHERE email = ? ORDER BY date_acces DESC");
$stmt->execute([$etudiant_email]);
$reservations = $stmt->fetchAll();

if (count($reservations) === 0) {
    echo "<p>Aucune réservation pour le moment.</p>";
} else {
    echo "<ul>";
    foreach ($reservations as $res) {
        echo "<li><strong>" . htmlspecialchars($res['salle']) . " - " . htmlspecialchars($res['date_acces']) . "</strong> (Statut : " . htmlspecialchars($res['statut']) . ")</li>";
    }
    echo "</ul>";
}
?>
