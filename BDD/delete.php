<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $pdo = new PDO("mysql:host=localhost;dbname=sae203;charset=utf8", "root", "");
    $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $stmt->execute([$id]);
}

// Redirection après suppression
header("Location: admin.php");
exit;
