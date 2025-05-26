<?php
$host = "localhost";
$dbname = "sae_203";
$username = "root"; 
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reservation_id']) && isset($_POST['statut'])) {
    $reservation_id = $_POST['reservation_id'];
    $statut = $_POST['statut']; // "validé" ou "refusé"

    // Vérifier que le statut est valide
    if (!in_array($statut, ['validé', 'refusé'])) {
        echo "Erreur : Statut invalide.";
        exit();
    }

    // Mettre à jour la réservation
    $sql = "UPDATE reservations SET statut = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$statut, $reservation_id]);

    echo "Réservation mise à jour avec succès !";
}
?>