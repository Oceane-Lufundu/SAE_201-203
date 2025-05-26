<?php
$host = "localhost";
$dbname = "sae_203";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT * FROM reservations WHERE statut = 'en attente'");
    $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<h2>Demandes en attente</h2>
<table border="1">
  <tr>
    <th>Nom</th><th>Email</th><th>Projet</th><th>Salle</th><th>Matériel</th><th>Actions</th>
  </tr>
  <?php foreach ($demandes as $demande): ?>
  <tr>
    <td><?= htmlspecialchars($demande['nom']) ?> <?= htmlspecialchars($demande['prenom']) ?></td>
    <td><?= htmlspecialchars($demande['email']) ?></td>
    <td><?= htmlspecialchars($demande['projet']) ?></td>
    <td><?= htmlspecialchars($demande['salle']) ?></td>
    <td><?= htmlspecialchars($demande['materiel']) ?></td>
    <td>
      <form method="post" action="traiter_demande.php">
        <input type="hidden" name="id" value="<?= $demande['id'] ?>">
        <button name="action" value="valider">Valider</button>
        <button name="action" value="refuser">Refuser</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
