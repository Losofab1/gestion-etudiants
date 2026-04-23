# Gestion des Étudiants

Mini application web full stack développée dans le cadre d'un TP de révision.

## Stack technique

- **Front-end** : HTML5, CSS3, JavaScript (ES6)
- **Back-end** : PHP 8 avec PDO
- **Base de données** : MySQL
- **Versioning** : Git & GitHub

## Structure du projet

```
gestion-etudiants/
│
├── index.php          # Formulaire d'ajout + tableau des étudiants
├── traitement.php     # Insertion en base (POST)
├── update.php         # Formulaire pré-rempli + mise à jour
├── delete.php         # Suppression d'un étudiant
├── config.php         # Connexion PDO centralisée
├── database.sql       # Script SQL (création + données de test)
│
└── assets/
    ├── css/style.css  # Feuille de style globale
    └── js/script.js   # Validation JS + confirmation suppression
```

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/votre-username/gestion-etudiants.git
cd gestion-etudiants
```

### 2. Créer la base de données

Importez le script SQL dans phpMyAdmin ou via le terminal :

```bash
mysql -u root -p < database.sql
```

### 3. Configurer la connexion

Modifiez `config.php` si nécessaire (hôte, utilisateur, mot de passe).

### 4. Lancer l'application

Placez le dossier dans `htdocs/` (XAMPP) ou `www/` (WAMP), puis ouvrez :

```
http://localhost/gestion-etudiants/
```

## Fonctionnalités

| Fonctionnalité | Fichier | Méthode |
|---|---|---|
| Afficher les étudiants | `index.php` | `SELECT … JOIN` |
| Ajouter un étudiant | `traitement.php` | `INSERT` |
| Modifier un étudiant | `update.php` | `UPDATE` |
| Supprimer un étudiant | `delete.php` | `DELETE` |
| Validation formulaire | `script.js` | JS côté client |
| Validation sécurisée | `traitement.php`, `update.php` | PHP côté serveur |

## Branches Git

| Branche | Rôle |
|---|---|
| `main` | Version stable (structure + BDD) |
| `develop` | Développement des fonctionnalités |

## Historique des commits

```
a3f9c12 (main) Fusion develop → main
b7e1d45 (develop) Ajout modification étudiant
c2a8f67 (develop) Ajout suppression étudiant
d4c3b89 (develop) Affichage des étudiants dans un tableau
e9f2a34 (develop) Ajout insertion étudiant
f1d7e56 (develop) Ajout validation JavaScript
g5b4c78 (develop) Création formulaire + style global
h8a1d23 (develop) Ajout configuration PDO
i2c9f45 (main)   Création base de données et tables
j1k0l23 (main)   Structure initiale du projet
```
