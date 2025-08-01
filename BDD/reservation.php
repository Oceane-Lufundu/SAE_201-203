<?php
function reserverSalleEtMateriel($nom, $prenom, $email, $date_acces, $heure_acces, $heure_remise, $projet, $salle, $materiel, $role) {
    $host = "localhost";
    $dbname = "sae_203";
    $username = "root"; 
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Définir les règles selon le rôle
        if ($role === "enseignant" && empty($salle)) {
            echo "Erreur : Un enseignant doit réserver une salle.";
            return;
        }

        if ($role === "eleve" && empty($materiel)) {
            echo "Erreur : Un élève doit réserver du matériel.";
            return;
        }

        // Insérer la réservation en base de données
        $sql = "INSERT INTO reservations (nom, prenom, email, date_acces, heure_acces, heure_remise, projet, salle, materiel, role, statut) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'en attente')";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $date_acces, $heure_acces, $heure_remise, $projet, $salle, $materiel, $role]);

        echo "Réservation enregistrée avec succès et en attente de validation.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>