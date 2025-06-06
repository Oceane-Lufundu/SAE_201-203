<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$dbname = "sae_203";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT * FROM resamateriel WHERE statut = 'en attente'");
    $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<h2>Demandes en attente</h2>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Email</th>
      <th>Projet</th>
      <th>Matériel</th>
      <th>Actions</th>
    </tr>
</thead>

  <?php foreach ($demandes as $demande): ?>
  <tr>
    <td><?= htmlspecialchars($demande['nom']) ?> <?= htmlspecialchars($demande['prenom']) ?></td>
    <td><?= htmlspecialchars($demande['email_universitaire']) ?></td>
    <td><?= htmlspecialchars($demande['nom_projet']) ?></td>
    <td><?= htmlspecialchars($demande['materiel']) ?></td>
    <td>
      <form method="post" action="traiter_demande.php">
        <input type="hidden" name="id" value="<?= $demande['id'] ?>">
        <button name="action" value="valider" class="btn btn-success btn-sm">Valider</button>
        <button name="action" value="refuser" class="btn btn-danger btn-sm">Refuser</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
<div style="height: 50px;"></div>
