<?php
session_start();

// Connexion à la base de données
$host = "localhost";
$dbname = "sae_203";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification des champs du formulaire
if (isset($_POST['Identifiant'], $_POST['mot_de_passe'], $_POST['role'])) {
    $email = $_POST['Identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = $_POST['role'];

    // Requête pour trouver l'utilisateur correspondant
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ? AND role = ?");
    $stmt->execute([$email, $role]);

    if ($stmt->rowCount() > 0) {
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe
        if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['role'] = $utilisateur['role'];

            // Redirection selon le rôle
            switch ($role) {
                case "Agent":
                    header("Location: ../HTML/agent.html");
                    break;
                case "Etudiant":
                    header("Location: ../HTML/etudiant.html");
                    break;
                case "Professeur":
                    header("Location: ../HTML/enseignant.html");
                    break;
                case "admin":
                    header("Location: ../BDD/admin_view.php");
                    break;
                default:
                    header("Location: ../HTML/index.html");
            }
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Identifiant ou rôle incorrect.";
    }
} else {
    echo "Tous les champs sont obligatoires.";
}
?>
