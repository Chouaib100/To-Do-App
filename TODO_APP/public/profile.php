<?php
// Inclure la fonction de connexion à la base de données et le modèle User
require_once '../config/database.php';
require_once '../app/models/User.php';

// Obtenir la connexion PDO
$pdo = getPDO();

// Créer une instance de User
$userModel = new User($pdo);

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupérer les informations de l'utilisateur connecté
$user = $userModel->getUserById($_SESSION['user_id']);

// Traiter la modification du profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Mettre à jour le profil
    if ($userModel->updateProfile($_SESSION['user_id'], $username, $email)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erreur lors de la modification du profil. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<h1>Mon Profil</h1>
<form method="POST">
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
    <button type="submit">Modifier</button>
</form>
</body>
</html>
