<?php 
$pdo = new PDO("mysql:host=localhost;dbname=sae203;charset=utf8", "root", "");

// Récupération des données
$utilisateurs = $pdo->query("SELECT * FROM utilisateurs")->fetchAll(PDO::FETCH_ASSOC);
$materiels = $pdo->query("SELECT * FROM materiel")->fetchAll(PDO::FETCH_ASSOC);
$etudiants = $pdo->query("SELECT * FROM etudiants")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/style_2.css">
</head>
<body class="p-4">

    <ul id="bar">
            <li class="nav-item-logo">
                <img src="../Images/logo-univ.png" class="logo" height="75px">  
            </li>
            
            <li id="text">
                <h1>Compte admin</h1>
            </li>  
    </ul> 

<div style="height: 50px;"></div>

<!-- Utilisateurs -->
<h2>Gestion des utilisateurs</h2>
<table class="table table-striped">
  <thead>
    <tr><th>ID</th><th>Nom</th><th>Action</th></tr>
  </thead>
  <tbody>
    <?php foreach ($utilisateurs as $u): ?>
    <tr id="user-<?= $u['id'] ?>">
      <td><?= $u['id'] ?></td>
      <td><?= htmlspecialchars($u['nom']) ?></td>
      <td>
        <form action="supprimer_utilisateur.php" method="post" onsubmit="return confirm('Supprimer <?= htmlspecialchars($u['nom']) ?> ?');">
          <input type="hidden" name="id" value="<?= $u['id'] ?>">
          <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Matériel -->
<h2>Gestion du matériel</h2>
<table class="table table-striped">
  <thead>
    <tr><th>ID</th><th>Désignation</th><th>État</th><th>Quantité</th><th>Action</th></tr>
  </thead>
  <tbody>
    <?php foreach ($materiels as $m): ?>
    <tr id="materiel-<?= $m['id_materiel'] ?>">
      <td><?= $m['id_materiel'] ?></td>
      <td><?= htmlspecialchars($m['designation']) ?></td>
      <td><?= $m['etat_global'] ?></td>
      <td><?= $m['quantite'] ?></td>
      <td>
        <button class="btn btn-danger btn-sm" onclick="supprimerMateriel(<?= $m['id_materiel'] ?>, '<?= htmlspecialchars($m['designation'], ENT_QUOTES) ?>')">Supprimer</button>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Étudiants -->
<h2>Gestion des étudiants</h2>
<table class="table table-striped">
  <thead>
    <tr><th>ID utilisateur</th><th>Num. étudiant</th><th>Téléphone</th><th>TP</th><th>TD</th><th>Promo</th><th>Action</th></tr>
  </thead>
  <tbody>
    <?php foreach ($etudiants as $e): ?>
    <tr id="etudiant-<?= $e['id_utilisateur'] ?>">
      <td><?= $e['id_utilisateur'] ?></td>
      <td><?= $e['num_etudiant'] ?></td>
      <td><?= $e['num_tel'] ?></td>
      <td><?= htmlspecialchars($e['groupe_tp']) ?></td>
      <td><?= $e['groupe_td'] ?></td>
      <td><?= htmlspecialchars($e['promotion']) ?></td>
      <td>
        <button class="btn btn-danger btn-sm" onclick="supprimerEtudiant(<?= $e['id_utilisateur'] ?>)">Supprimer</button>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- JavaScript -->
<script>
function supprimerMateriel(id, nom) {
  if (confirm("Supprimer le matériel : " + nom + " ?")) {
    fetch("supprimer_materiel.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id_materiel=" + id
    }).then(r => {
      if (r.ok) document.getElementById("materiel-" + id).remove();
      else alert("Erreur suppression.");
    });
  }
}

function supprimerEtudiant(id) {
  if (confirm("Supprimer cet étudiant ?")) {
    fetch("supprimer_etudiant.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id_utilisateur=" + id
    }).then(r => {
      if (r.ok) document.getElementById("etudiant-" + id).remove();
      else alert("Erreur suppression.");
    });
  }
}
</script>

</body>
</html>
