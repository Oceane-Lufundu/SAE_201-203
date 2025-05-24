<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['designation'])) {
    $id = intval($_POST['designation']);

    $pdo = new PDO("mysql:host=localhost;dbname=sae203;charset=utf8", "root", "");
    $stmt = $pdo->prepare("DELETE FROM materiel WHERE designation = ?");
    $stmt->execute([$id]);

    http_response_code(200); // succès
    exit;
}
// Redirection après suppression
header("Location: admin.php");
exit;