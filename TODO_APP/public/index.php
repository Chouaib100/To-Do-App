<?php
// Inclure la connexion à la base de données et les modèles
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

// Obtenir les tâches de l'utilisateur
$tasks = $taskModel->getTasksByUserId($_SESSION['user_id']);

// Vérifier si le formulaire de création de tâche est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier que le titre de la tâche a bien été envoyé
    if (isset($_POST['task']) && !empty($_POST['task'])) {
        $taskTitle = $_POST['task'];
        // Ajouter la tâche dans la base de données
        $taskModel->addTask($_SESSION['user_id'], $taskTitle);
        // Rediriger vers la même page pour éviter de soumettre plusieurs fois le formulaire
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des tâches</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<h1>Bienvenue sur votre Todo App</h1>
<a href="logout.php">Se déconnecter</a>

<h2>Liste des tâches</h2>

<!-- Formulaire pour ajouter une tâche -->
<form method="POST">
    <input type="text" name="task" placeholder="Titre de la tâche" required>
    <button type="submit">Ajouter</button>
</form>

<h3>Tâches :</h3>
<ul>
    <?php
    // Afficher les tâches existantes
    foreach ($tasks as $task) {
        echo "<li>" . htmlspecialchars($task['task']) . "</li>";
    }
    ?>
</ul>
</body>
</html>
