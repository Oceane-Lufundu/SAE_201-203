<?php
$host = "localhost";
$dbname = "sae_203";
$username = "root"; 
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

$id = $_GET['id'];
$action = $_GET['action'];

if ($action == 'valider') {
    $conn->query("UPDATE reservations SET statut='validée' WHERE id=$id");
    echo "Réservation validée.";
} elseif ($action == 'refuser') {
    $conn->query("UPDATE reservations SET statut='refusée' WHERE id=$id");
    echo "Réservation refusée.";
}
?>
