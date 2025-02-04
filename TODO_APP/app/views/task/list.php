<?php
// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tâches</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<h1>Liste des tâches</h1>
<p><a href="../logout.php">Se déconnecter</a></p>

<h2>Vos Tâches</h2>
<?php if (isset($tasks) && count($tasks) > 0): ?>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li><?= htmlspecialchars($task['title']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune tâche à afficher pour le moment.</p>
<?php endif; ?>

<h3>Ajouter une nouvelle tâche</h3>
<form method="POST" action="../add_task.php">
    <input type="text" name="title" placeholder="Titre de la tâche" required>
    <button type="submit">Ajouter</button>
</form>
</body>
</html>
