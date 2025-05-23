<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $reference_materiel = $_POST['reference_materiel'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $type_materiel = $_POST['type_materiel'] ?? null;
    $date_achat = $_POST['date_achat'] ?? null;
    $etat_global = $_POST['etat_global'] ?? 'Bon';
    $quantite = $_POST['quantite'] ?? 1;
    $descriptif = $_POST['descriptif'] ?? null;
    $lien_demo = $_POST['lien_demo'] ?? null;

    // Upload image
    $photo_url = null;
    if (isset($_FILES['photo_url']) && $_FILES['photo_url']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['photo_url']['name']);
        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $target_path = $upload_dir . time() . '_' . $filename;
        if (move_uploaded_file($_FILES['photo_url']['tmp_name'], $target_path)) {
            $photo_url = $target_path;
        }
    }

    // Requête d'insertion (sans id_materiel car AUTO_INCREMENT)
    $sql = "INSERT INTO materiel (reference_materiel, designation, photo_url, type_materiel, date_achat, etat_global, quantite, descriptif, lien_demo)
            VALUES (:reference_materiel, :designation, :photo_url, :type_materiel, :date_achat, :etat_global, :quantite, :descriptif, :lien_demo)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':reference_materiel' => $reference_materiel,
        ':designation' => $designation,
        ':photo_url' => $photo_url,
        ':type_materiel' => $type_materiel,
        ':date_achat' => $date_achat,
        ':etat_global' => $etat_global,
        ':quantite' => $quantite,
        ':descriptif' => $descriptif,
        ':lien_demo' => $lien_demo
    ]);

    header('Location: confirmation.php');
    exit;
} else {
    echo "❌ Accès refusé.";
}
