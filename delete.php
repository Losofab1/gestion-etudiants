<?php
require 'config.php';

// Récupérer l'identifiant depuis l'URL
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// Vérifier que l'étudiant existe avant de supprimer
$stmt = $pdo->prepare("SELECT id FROM etudiants WHERE id = ?");
$stmt->execute([$id]);

if (!$stmt->fetch()) {
    header("Location: index.php");
    exit;
}

// Suppression via requête préparée
$pdo->prepare("DELETE FROM etudiants WHERE id = ?")
    ->execute([$id]);

header("Location: index.php?msg=supprime");
exit;
