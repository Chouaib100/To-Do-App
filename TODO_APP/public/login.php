<?php
require '../app/models/User.php';
require '../config/database.php';

session_start(); // Démarrer la session en premier

$pdo = getPDO();
$userModel = new User($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($userModel->login($email, $password)) {
        // Redirection vers l'accueil après connexion
        header("Location: index.php");
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
<h2>Connexion</h2> <br> <br>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required><br> <br>
    <input type="password" name="password" placeholder="Mot de passe" required> <br> <br>
    <button type="submit">Se connecter</button> <br>
</form>
</body>
</html>
