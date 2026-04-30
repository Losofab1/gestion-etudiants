<?php
require 'config.php';

// Récupérer toutes les filières pour le <select>
$filieres = $pdo->query("SELECT * FROM filieres ORDER BY nom");

// Récupérer tous les étudiants avec jointure sur filieres
$sql = "SELECT etudiants.*, filieres.nom AS filiere_nom
        FROM etudiants
        JOIN filieres ON etudiants.filiere_id = filieres.id
        ORDER BY etudiants.nom, etudiants.prenom";
$etudiants = $pdo->query($sql);

// Message flash (après insertion / modification / suppression)
$message = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>Gestion des Étudiants</h1>
</header>

<main>

    <!-- ===== MESSAGE FLASH ===== -->
    <?php if ($message === 'ajoute'): ?>
        <p class="alert alert-success">Étudiant ajouté avec succès.</p>
    <?php elseif ($message === 'modifie'): ?>
        <p class="alert alert-success">Étudiant modifié avec succès.</p>
    <?php elseif ($message === 'supprime'): ?>
        <p class="alert alert-danger">Étudiant supprimé.</p>
    <?php endif; ?>

    <!-- ===== FORMULAIRE D'AJOUT ===== -->
    <section class="card">
        <h2>Ajouter un étudiant</h2>

        <form method="POST" action="traitement.php" id="form-ajout" novalidate>
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" placeholder="Ex : Dupont" required>
                    <span class="field-error" id="err-nom"></span>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Ex : Alice" required>
                    <span class="field-error" id="err-prenom"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="filiere">Filière</label>
                <select>
                    <option>Systeme informatique et logiciel</option>
                    <option>Systeme industriel</option>
                    <option>Reseau informatique et telecommunication</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </section>

    <!-- ===== TABLEAU DES ÉTUDIANTS ===== -->
    <section class="card">
        <h2>Liste des étudiants</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Filière</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rows = $etudiants->fetchAll();
                if (empty($rows)):
                ?>
                <tr>
                    <td colspan="5" class="empty">Aucun étudiant enregistré.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($rows as $i => $e): ?>
                <tr>
                    <td class="td-num"><?= $i + 1 ?></td>
                    <td><strong><?= htmlspecialchars($e['nom']) ?></strong></td>
                    <td><?= htmlspecialchars($e['prenom']) ?></td>
                    <td>
                        <span class="badge"><?= htmlspecialchars($e['filiere_nom']) ?></span>
                    </td>
                    <td class="td-actions">
                        <a href="update.php?id=<?= $e['id'] ?>" class="btn btn-edit">Modifier</a>
                        <a href="delete.php?id=<?= $e['id'] ?>"
                           class="btn btn-danger delete-link">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

</main>

<script src="assets/js/script.js"></script>
</body>
</html>
