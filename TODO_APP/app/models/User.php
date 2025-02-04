<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Vérifier si la session est active
    private function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Vérifier si l'email existe déjà
    private function emailExists($email) {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    // Enregistrement d'un utilisateur
    public function register($username, $email, $password) {
        if ($this->emailExists($email)) {
            return false; // Empêcher l'inscription avec un email déjà utilisé
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    // Connexion d'un utilisateur
    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $this->startSession(); // Démarrer la session si nécessaire
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true; // Connexion réussie
        }

        return false; // Connexion échouée
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($id) {
        $sql = "SELECT id, username, email FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par son email
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        $this->startSession();
        session_unset();
        session_destroy();
    }
}

?>
