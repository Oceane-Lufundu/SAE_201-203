<?php
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

// Vérifier que toutes les données du formulaire sont présentes
if (
    isset($_POST['email'], $_POST['pseudo'], $_POST['nom'], $_POST['prenom'],
    $_POST['date_naissance'], $_POST['adresse_postale'], $_POST['role'], $_POST['mot_de_passe'])
) {
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse_postale = $_POST['adresse_postale'];
    $role = $_POST['role'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hash du mot de passe

    // Vérifier si l'email existe déjà
    $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
    } else {
        // Insertion
        $sql = "INSERT INTO utilisateurs (email, mot_de_passe, pseudo, nom, prenom, date_naissance, adresse_postale, role)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $mot_de_passe, $pseudo, $nom, $prenom, $date_naissance, $adresse_postale, $role]);

        echo "Inscription réussie !";
        header("Location: index.php"); // redirection vers la page de connecion
        exit();
    }
} else {
    echo "Tous les champs sont obligatoires.";
}
?>
