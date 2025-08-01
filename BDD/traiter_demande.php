<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'], $_POST['action'])) {
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    $host = "localhost";
    $dbname = "sae_203";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($action === "valider") {
            $sql = "UPDATE resamateriel SET statut = 'validée' WHERE id = ?";
        } elseif ($action === "refuser") {
            $sql = "UPDATE resamateriel SET statut = 'refusée' WHERE id = ?";
        } else {
            throw new Exception("Action inconnue.");
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        header("Location: admin_action.php");
        exit;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Requête invalide.";
}
?>