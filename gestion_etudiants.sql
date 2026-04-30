-- ============================================
-- BASE DE DONNÉES : gestion_etudiants
-- ============================================

CREATE DATABASE IF NOT EXISTS gestion_etudiants
    CHARACTER SET utf8
    COLLATE utf8_general_ci;

USE gestion_etudiants;

-- ----------------------
-- Table : filieres
-- ----------------------
CREATE TABLE IF NOT EXISTS filieres (
    id  INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

-- ----------------------
-- Table : etudiants
-- ----------------------
CREATE TABLE IF NOT EXISTS etudiants (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nom        VARCHAR(100) NOT NULL,
    prenom     VARCHAR(100) NOT NULL,
    filiere_id INT NOT NULL,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

-- ----------------------
-- Données de test
-- ----------------------
INSERT INTO filieres (nom) VALUES
    ( 'Systèmes Informatique et Logiciel'),
    ( 'Réseaux Informatique et Télécom'),
    ( 'Système Industriel');

INSERT INTO etudiants (id ,nom, prenom, filiere_id) VALUES
    ('Ahouansou', 'Didier' , 1),
    ('Kpossou',   'Mariame' , 2),
    ('Zinsou',    'Boris' , 3);
