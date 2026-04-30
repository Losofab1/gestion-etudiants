<?php
require 'config.php';

// Récupérer l'identifiant depuis l'URL
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// Charger les données actuelles de l'étudiant
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
$stmt->execute([$id]);
$etudiant = $stmt->fetch();

if (!$etudiant) {
    header("Location: index.php");
    exit;
}

// Traitement du formulaire après soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom     = trim($_POST['nom']    ?? '');
    $prenom  = trim($_POST['prenom'] ?? '');
    $filiere = (int) ($_POST['filiere'] ?? 0);

    // Validation côté serveur
    if (mb_strlen($nom) >= 2 && mb_strlen($prenom) >= 2 && $filiere > 0) {
        $pdo->prepare("UPDATE etudiants SET nom = ?, prenom = ?, filiere_id = ? WHERE id = ?")
            ->execute([$nom, $prenom, $filiere, $id]);

        header("Location: index.php?msg=modifie");
        exit;
    }
}

// Charger les filières pour le <select>
$filieres = $pdo->query("SELECT * FROM filieres ORDER BY nom");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un étudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>Modifier un étudiant</h1>
</header>

<main>
    <section class="card">
        <h2>Modifier les informations</h2>

        <form method="POST" id="form-ajout" novalidate>
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text"
                           id="nom"
                           name="nom"
                           value="<?= htmlspecialchars($etudiant['nom']) ?>"
                           required>
                    <span class="field-error" id="err-nom"></span>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text"
                           id="prenom"
                           name="prenom"
                           value="<?= htmlspecialchars($etudiant['prenom']) ?>"
                           required>
                    <span class="field-error" id="err-prenom"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="filiere">Filière</label>
                <select id="filiere" name="filiere" required>
                    <?php foreach ($filieres as $f): ?>
                        <option value="<?= htmlspecialchars($f['id']) ?>"
                            <?= $f['id'] == $etudiant['filiere_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($f['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                <a href="index.php" class="btn">Annuler</a>
            </div>
        </form>
    </section>
</main>

<script src="assets/js/script.js"></script>
</body>
</html>
