<?php
session_start();

// Affichage des erreurs pour le débogage
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
if (!empty($_POST['Identifiant']) && !empty($_POST['mot_de_passe']) && !empty($_POST['role'])) {
    // Récupération et nettoyage des données
    $email       = trim($_POST['Identifiant']);
    $mot_de_passe = trim($_POST['mot_de_passe']);
    // Récupération de la valeur soumise pour le rôle
    $roleInput = trim($_POST['role']);

    // Normalisation du rôle selon la valeur attendue dans la BDD
    switch (strtolower($roleInput)) {
        case "admin":
            $role = "Administrateur";
            break;
        case "etudiant":
            $role = "Etudiant";
            break;
        case "enseignant":
            $role = "Enseignant";
            break;
        case "agent":
            $role = "Agent";
            break;
        default:
            $role = $roleInput;
            break;
    }

    // Pour le débogage : affichage des valeurs reçues et du rôle normalisé
    echo "<h3>Données du formulaire reçues :</h3>";
    echo "<p>Email : [$email]</p>";
    echo "<p>Role envoyé : [$roleInput] --> Role normalisé : [$role]</p>";
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    // Vérification d'une syntaxe d'email valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<p style='color: red;'>Erreur : Format d'email invalide.</p>");
    }

    // Requête SQL avec comparaison insensible à la casse pour l'email
    $sql  = "SELECT * FROM utilisateurs WHERE LOWER(email) = LOWER(?) AND role = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $role]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debug : afficher le résultat de la requête SQL
    echo "<h3>Résultat de la requête SQL :</h3>";
    if (!$utilisateur) {
        echo "<p style='color: red;'>Erreur : Aucun utilisateur trouvé avec cet identifiant et ce rôle.</p>";
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    } else {
        echo "<p style='color: green;'>Utilisateur trouvé :</p>";
        echo "<pre>";
        print_r($utilisateur);
        echo "</pre>";

        // Vérification du mot de passe haché
        if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {

            // Stocker en session et rediriger selon le rôle
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['role']           = $utilisateur['role'];
            $_SESSION['nom']            = $utilisateur['nom'];

            echo "<p style='color: green;'>Connexion réussie ! Bienvenue, " . $_SESSION['nom'] . ".</p>";

            // Redirection selon le rôle (en utilisant la valeur normalisée)
            switch (strtolower($role)) {
                case "agent":
                    $redirect_page = "../HTML/agent.html";
                    break;
                case "etudiant":
                    $redirect_page = "../HTML/etudiant.html";
                    break;
                case "enseignant":
                    $redirect_page = "../HTML/enseignant.html";
                    break;
                case "administrateur":
                    $redirect_page = "../HTML/admin.html";
                    break;
                default:
                    $redirect_page = "../HTML/index.html";
                    break;
            }
            header("Location: $redirect_page");
            exit();
        } else {
            echo "<p style='color: red;'>Erreur : Mot de passe incorrect.</p>";
        }
    }