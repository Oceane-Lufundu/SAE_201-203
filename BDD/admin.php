<?php 
$pdo = new PDO("mysql:host=localhost;dbname=sae203;charset=utf8", "root", "");

// Liste des utilisateurs
$requete = $pdo->query("SELECT * FROM utilisateurs");
$utilisateurs = $requete ? $requete->fetchAll(PDO::FETCH_ASSOC) : [];

// Liste du matériel
$requeteMateriel = $pdo->query("SELECT * FROM materiel");
$materiels = $requeteMateriel ? $requeteMateriel->fetchAll(PDO::FETCH_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Site</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

<ul id="nav">
  <li class="nav-item-logo">
    <img src="../images/logo-UGE.jpg" class="logo" height="100px">  
  </li>
  <li id="text">
    <h1>Compte admin</h1>
  </li>  
</ul> 

<h2>Gestion des utilisateurs</h2>
<ul>
  <?php foreach ($utilisateurs as $utilisateur): ?>
    <li class="d-flex align-items-center gap-2">
      <?= htmlspecialchars($utilisateur['nom']) ?>
      <form action="delete.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer <?= htmlspecialchars($utilisateur['nom']) ?> ?');">
        <input type="hidden" name="id" value="<?= $utilisateur['id'] ?>">
        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
      </form>
    </li>
  <?php endforeach; ?>
</ul>

<h2>Gestion du matériel</h2>
<ul>
  <?php foreach ($materiels as $materiel): ?>
    <li id="materiel-<?= $materiel['id_materiel'] ?>" class="d-flex align-items-center gap-2">
      <?= htmlspecialchars($materiel['designation']) ?>
      <button class="btn btn-danger btn-sm" onclick="supprimerMateriel(<?= $materiel['id_materiel'] ?>, '<?= htmlspecialchars($materiel['designation'], ENT_QUOTES) ?>')">Supprimer</button>
    </li>
  <?php endforeach; ?>
</ul>

<!-- Script JS -->
<script>
function supprimerMateriel(id, nom) {
  if (confirm("Voulez-vous vraiment supprimer le matériel : " + nom + " ?")) {
    fetch("supprimer_materiel.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id_materiel=" + id
    })
    .then(response => {
      if (response.ok) {
        document.getElementById("materiel-" + id).remove();
      } else {
        alert("Erreur lors de la suppression.");
      }
    })
    .catch(error => {
      alert("Erreur réseau.");
      console.error(error);
    });
  }
}
</script>

</body>
</html>