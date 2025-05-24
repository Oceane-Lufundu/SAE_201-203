<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_utilisateur'])) {
  $pdo = new PDO("mysql:host=localhost;dbname=sae203;charset=utf8", "root", "");
  $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id_utilisateur = ?");
  $stmt->execute([intval($_POST['id_utilisateur'])]);
}
// Redirection après suppression
header("Location: admin.php");
exit;
?>
