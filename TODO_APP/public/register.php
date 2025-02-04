<?php
// Inclure la configuration de la base de données et le modèle User
require_once '../config/database.php';
require_once '../app/models/User.php';

// Obtenir la connexion PDO en appelant la fonction getPDO()
$pdo = getPDO();  // Appel de la fonction pour obtenir la connexion PDO

// Traiter l'inscription
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Créer une instance de User
    $userModel = new User($pdo);

    // Inscrire l'utilisateur
    if ($userModel->register($username, $email, $password)) {
        header('Location: login.php');
        exit;
    } else {
        echo "Erreur lors de l'inscription. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<h1>Créer un compte</h1><br> <br>
<form method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required> <br>
    <input type="email" name="email" placeholder="Email" required> <br>
    <input type="password" name="password" placeholder="Mot de passe" required> <br>
    <button type="submit">S'inscrire</button> <br><br>
</form>
<p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
</body>
</html>
