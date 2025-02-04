<?php
// Inclure la connexion à la base de données et le modèle Task
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

// Traiter l'ajout de tâche
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['task']) && !empty(trim($_POST['task']))) {
        $task = trim($_POST['task']); // Récupérer et nettoyer l'entrée utilisateur

        // Ajouter la tâche à la base de données
        if ($taskModel->addTask($_SESSION['user_id'], $task)) {
            header('Location: index.php'); // Rediriger vers la page principale après ajout
            exit;
        } else {
            echo "Erreur lors de l'ajout de la tâche. Veuillez réessayer.";
        }
    } else {
        echo "Le champ de la tâche ne peut pas être vide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
</head>
<body>

<h1>Ajouter une nouvelle tâche</h1>
<hr> <!-- Ligne horizontale pour séparer le titre -->

<form method="POST">
    <p>
        <label for="task">Titre de la tâche :</label>
        <input type="text" id="task" name="task" placeholder="Titre de la tâche" required>
    </p>
    <p>
        <button type="submit">Ajouter</button>
    </p>
</form>

</body>
</html>

