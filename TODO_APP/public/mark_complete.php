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

    // Marquer la tâche comme terminée
    if ($taskModel->markTaskComplete($taskId)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erreur lors de la mise à jour de la tâche. Veuillez réessayer.";
    }
}
?>
