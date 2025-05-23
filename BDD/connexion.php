<?php
session_start();
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

// Vérification que les champs sont remplis
if (!empty($_POST['Identifiant']) && !empty($_POST['mdp'])) {
    $email = $_POST['Identifiant']; // Correspond maintenant au champ HTML
    $mot_de_passe = $_POST['mdp'];  // Correspond maintenant au champ HTML

    // Debug temporaire : Voir les données envoyées (à supprimer après test)
    var_dump($_POST);

    // Vérification de l'utilisateur dans la base de données
    $stmt = $pdo->prepare("SELECT id, mot_de_passe FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Vérification du mot de passe
    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];  // Stocker l'ID en session
        header("Location: ../HTML/dashboard.html");  // Redirection vers le dashboard
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
} else {
    echo "Veuillez remplir tous les champs.";
}
?>
