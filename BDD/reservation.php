<?php
$host = "localhost";
$dbname = "sae_203";
$username = "root"; 
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date_acces = $_POST['date_acces'];
    $heure_acces = $_POST['heure_acces'];
    $heure_remise = $_POST['heure_remise'];
    $projet = $_POST['projet'] ?? null;
    $salle = $_POST['salle'] ?? null;
    $materiel = $_POST['materiel'] ?? null;
    $role = $_POST['role']; // "eleve" ou "enseignant"

    // Vérification du rôle (les enseignants ne peuvent réserver que les salles)
    if ($role === "enseignant" && !empty($materiel)) {
        echo "Erreur : Les enseignants ne peuvent pas réserver du matériel.";
        exit();
    }

    // Insérer la réservation avec statut "en attente"
    $sql = "INSERT INTO reservations (nom, prenom, email, date_acces, heure_acces, heure_remise, projet, salle, materiel, role, statut) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'en attente')";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nom, $prenom, $email, $date_acces, $heure_acces, $heure_remise, $projet, $salle, $materiel, $role]);

    header("Location: ../HTML/etudiant.html");
    exit();
}
?>
