<?php

// Fonction pour obtenir la connexion à la base de données
function getPDO() {
    $host = 'localhost';
    $db = 'todo_app';
    $user = 'root';
    $pass = 'Chouaib2004';

    try {
        // Créer une instance PDO pour la connexion à la base de données
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}
