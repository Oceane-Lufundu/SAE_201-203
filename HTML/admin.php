<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Administrateur</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header class="bandeau3">
        <h1>Bienvenue sur votre espace administrateur</h1>
    </header>
    <div style="height: 50px;"></div>
    <?php include("../BDD/admin_action.php"); ?>

<!--Utilisateur-->
    <h2>Gestion des utilisateurs</h2>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"></th>
            <td></td>
            <td><button type="submit" class="btn btn-danger btn-sm">Supprimer</button></td>
        </tr>
    </tbody>
    </table>
    <div style="height: 50px;"></div>

    <!--matériel-->
     <h2>Gestion du matériel</h2>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Désignation</th>
            <th>état</th>
            <th>Quantité</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>
            <td></td>
            <td><button type="submit" class="btn btn-danger btn-sm">Supprimer</button></td>
        </tr>
    </tbody>
    </table>
    <div style="height: 50px;"></div>

    <!--étudiant-->
     <h2>Gestion des étudiant</h2>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>ID utilisateurs</th>
            <th>N° étudiant</th>
            <th>Téléphone</th>
            <th>TD</th>
            <th>TP</th>
            <th>Promo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><button type="submit" class="btn btn-danger btn-sm">Supprimer</button></td>
        </tr>
    </tbody>
    </table>

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
 