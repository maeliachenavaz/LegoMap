<?php
// URL de l'API (nom du service Docker "api" pour communication interne)
$apiUrl = "http://api/users.php";

// Appel de l'API
$response = file_get_contents($apiUrl);
$users = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Utilisateurs</h1>
    <ul>
        <?php foreach($users as $user): ?>
            <li><?= htmlspecialchars($user['name']) ?> (ID: <?= $user['id'] ?>)</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
