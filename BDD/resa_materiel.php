<?php
function reserverSalleEtMateriel($nom, $prenom, $numero_etudiant, $email, $date_reservation, $heure_remise, $nom_projet, $enseignant_responsable, $materiel) {
    $host = "localhost";
    $dbname = "sae_203";
    $username = "root"; 
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insérer la réservation en base de données
        $sql = "INSERT INTO reservations (nom, prenom, numero_etudiant, email, date_reservation, heure_remise, nom_projet, enseignant_responsable, materiel, statut) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'en attente')";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$nom, $prenom, $numero_etudiant, $email, $date_reservation, $heure_remise, $nom_projet, $enseignant_responsable, $materiel]);

        echo "Réservation enregistrée avec succès et en attente de validation.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"] ?? '';
    $prenom = $_POST["prenom"] ?? '';
    $numero_etudiant = $_POST["numero_etudiant"] ?? '';
    $email = $_POST["email_universitaire"] ?? '';
    $date_reservation = $_POST["date_reservation"] ?? '';
    $heure_remise = $_POST["heure_remise"] ?? '';
    $nom_projet = $_POST["nom_projet"] ?? '';
    $enseignant_responsable = $_POST["enseignant_responsable"] ?? '';

    // Récupérer le matériel demandé (exemple simple)
    $materiel = "";
    $materielList = [
        "PC de Bureau" => $_POST["pc_bureau_quantite"] ?? 0,
        "Casque Oculus Quest 2" => $_POST["casque_quantite"] ?? 0,
        "Câble Oculus Link" => $_POST["cable_oculus_quantite"] ?? 0,
        "Caméra 360° Ricoh Theta SCA" => $_POST["camera_quantite"] ?? 0,
        "Trépied" => $_POST["trepied_quantite"] ?? 0,
        "Microphone HyperX Quadcast" => $_POST["micro_quantite"] ?? 0
    ];
    foreach ($materielList as $nomMat => $qte) {
        if ($qte > 0) {
            $materiel .= "$nomMat ($qte), ";
        }
    }
    $materiel = rtrim($materiel, ", ");

    reserverSalleEtMateriel($nom, $prenom, $numero_etudiant, $email, $date_reservation, $heure_remise, $nom_projet, $enseignant_responsable, $materiel);
}
?>