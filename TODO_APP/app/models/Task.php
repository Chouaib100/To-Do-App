<?php

class Task {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getTasksByUserId($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTask($user_id, $task) {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (user_id, task) VALUES (:user_id, :task)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':task', $task, PDO::PARAM_STR);

        return $stmt->execute(); // Retourne true ou false
    }
}
