<?php
// Inclure la fonction de connexion à la base de données et le modèle Task
require_once '../config/database.php';
require_once '../app/models/Task.php';

// Obtenir la connexion PDO
$pdo = getPDO();

// Créer une instance de Task
$taskModel = new Task($pdo);

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Vérifier si l'ID de la tâche est présent dans l'URL
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $task = $taskModel->getTaskById($taskId);

    // Vérifier si la tâche appartient à l'utilisateur connecté
    if ($task['user_id'] != $_SESSION['user_id']) {
        header('Location: index.php');
        exit;
    }
}

// Traiter la modification de tâche
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];

    // Mettre à jour la tâche dans la base de données
    if ($taskModel->updateTask($taskId, $title)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erreur lors de la modification de la tâche. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la tâche</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<h1>Modifier la tâche</h1>
<form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($task['title']); ?>" required>
    <button type="submit">Modifier</button>
</form>
</body>
</html>
