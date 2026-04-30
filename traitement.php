<?php
require 'config.php';

// Sécurité : on accepte uniquement les requêtes POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

// Récupération et nettoyage des données
$nom     = trim($_POST['nom']    ?? '');
$prenom  = trim($_POST['prenom'] ?? '');
$filiere = (int) ($_POST['filiere'] ?? 0);

// Validation côté serveur (indispensable même si JS valide côté client)
$erreurs = [];

if (mb_strlen($nom) < 2) {
    $erreurs[] = "Le nom doit contenir au moins 2 caractères.";
}
if (mb_strlen($prenom) < 2) {
    $erreurs[] = "Le prénom doit contenir au moins 2 caractères.";
}
if ($filiere <= 0) {
    $erreurs[] = "Veuillez sélectionner une filière valide.";
}

if (!empty($erreurs)) {
    // En cas d'erreur, on retourne à l'accueil (amélioration possible : session flash)
    header("Location: index.php");
    exit;
}

// Insertion en base via requête préparée (protection injection SQL)
$sql  = "INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nom, $prenom, $filiere]);

header("Location: index.php?msg=ajoute");
exit;
