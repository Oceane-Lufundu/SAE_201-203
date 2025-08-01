<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$dbname = "sae_203";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Récupérer les champs du formulaire (à adapter selon ton formulaire HTML)
        $reference = $_POST["reference_materiel"] ?? '';
        $designation = $_POST["designation"] ?? '';
        $photo_url = $_POST["photo_url"] ?? '';
        $type = $_POST["type_materiel"] ?? '';
        $date_achat = $_POST["date_achat"] ?? '';
        $etat = $_POST["etat_global"] ?? '';
        $quantite = $_POST["quantite"] ?? 0;
        $descriptif = $_POST["descriptif"] ?? '';
        $lien_demo = $_POST["lien_demo"] ?? '';

        $sql = "INSERT INTO materiel (reference_materiel, designation, photo_url, type_materiel, date_achat, etat_global, quantite, descriptif, lien_demo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$reference, $designation, $photo_url, $type, $date_achat, $etat, $quantite, $descriptif, $lien_demo]);

        echo "Matériel ajouté avec succès.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>