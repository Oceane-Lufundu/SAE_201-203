<?php
// Affichage des erreurs pour faciliter le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à la base de données
$host     = "localhost";
$dbname   = "sae_203";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier que tous les champs du formulaire sont présents
if (
    !empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['nom']) &&
    !empty($_POST['prenom']) && !empty($_POST['date_naissance']) &&
    !empty($_POST['adresse_postale']) && !empty($_POST['role']) && !empty($_POST['mot_de_passe'])
) {
    // Récupération et nettoyage des données
    $email          = trim($_POST['email']);
    $pseudo         = trim($_POST['pseudo']);
    $nom            = trim($_POST['nom']);
    $prenom         = trim($_POST['prenom']);
    $date_naissance = trim($_POST['date_naissance']);
    $adresse_postale= trim($_POST['adresse_postale']);
    $role           = trim($_POST['role']); // Doit être : Etudiant, Enseignant, Agent ou Administrateur
    $mot_de_passe   = trim($_POST['mot_de_passe']);

    // Vérifier que l'email est au bon format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erreur : Format d'email invalide.");
    }

    // Vérifier si l'email existe déjà dans la table 'utilisateurs'
    $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
    } else {
        // Hachage du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insertion dans la table
        $sql = "INSERT INTO utilisateurs (email, mot_de_passe, pseudo, nom, prenom, date_naissance, adresse_postale, role)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$email, $mot_de_passe_hash, $pseudo, $nom, $prenom, $date_naissance, $adresse_postale, $role])) {
            echo "Inscription réussie !";
            header("Location: ../HTML/index.html");
            exit();
        } else {
            echo "Erreur lors de l'insertion dans la base.";
        }
    }
} else {
    echo "Tous les champs sont obligatoires.";
}
?>
