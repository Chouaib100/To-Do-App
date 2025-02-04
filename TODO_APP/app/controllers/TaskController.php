<?php
require_once '../models/Task.php';

class TaskController {

    public function listTasks($pdo) {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../public/login.php');
            exit;
        }

        // Créer une instance du modèle Task
        $taskModel = new Task($pdo);

        // Récupérer les tâches de l'utilisateur connecté
        $tasks = $taskModel->getTasksByUserId($_SESSION['user_id']);

        // Inclure la vue pour afficher les tâches
        require_once '../views/tasks/list.php';
    }

    public function addTask($pdo, $title) {
        // Créer une instance du modèle Task
        $taskModel = new Task($pdo);

        // Ajouter la nouvelle tâche
        $taskModel->addTask($_SESSION['user_id'], $title);

        // Rediriger vers la page de liste des tâches
        header('Location: list.php');
        exit;
    }
}
