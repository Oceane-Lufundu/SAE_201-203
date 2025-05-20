<html>
    <title>Mon Site</title>
    <head></head>
    <body>
        <form action="utilisateur.php" method="POST">
            <label>Email :</label>
                <input type="email" name="email" required><br>

            <label>Mot de passe :</label>
             <input type="password" name="mot_de_passe" required><br>
  
            <button type="submit">Envoyer</button>
        </form>
    </body>
</html>
<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "sae203";
$username = "root";
$password = ""; // ou ton mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les données du formulaire
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Requête d'insertion
$sql = "INSERT INTO utilisateurs (email, mot_de_passe, pseudo, nom, prenom, date_naissance, adresse_postale, role)
        VALUES (?, ?, 'pseudoTest', 'NomTest', 'PrenomTest', '2000-01-01', 'Adresse Test', 'étudiant')";

$stmt = $pdo->prepare($sql);
$stmt->execute([$email, $mot_de_passe]);

echo "Utilisateur ajouté avec succès.";
?>


