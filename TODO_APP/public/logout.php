<?php
// Démarrer la session
session_start();

// Détruire la session pour déconnecter l'utilisateur
session_destroy();

// Rediriger vers la page de connexion
header('Location: login.php');
exit;
