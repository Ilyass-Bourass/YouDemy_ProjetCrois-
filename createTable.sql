DROP DATABASE IF EXISTS YouDemy;
CREATE DATABASE YouDemy;
USE YouDemy;

-- Table des utilisateurs
CREATE TABLE users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('ADMIN', 'ENSEIGNANT','ETUDIANT'),
    status ENUM('active', 'suspendu', 'inactive') DEFAULT 'inactive',
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table des catégories
CREATE TABLE categories (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    name_categorie VARCHAR(100) NOT NULL,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table des cours
CREATE TABLE cours (
    id_cour INT PRIMARY KEY AUTO_INCREMENT,
    id_enseignant INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    img_url VARCHAR(255),
    id_categorie INT NOT NULL,
    prix DECIMAL(10,2),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_enseignant) REFERENCES users(id_user),
    FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie)
);

-- Table des tags
CREATE TABLE tags (
    id_tag INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table de relation cours-tags
CREATE TABLE cours_tags (
    id_cour INT,
    id_tag INT,
    PRIMARY KEY (id_cour, id_tag),
    FOREIGN KEY (id_cour) REFERENCES cours(id_cour) ON DELETE CASCADE,
    FOREIGN KEY (id_tag) REFERENCES tags(id_tag) ON DELETE CASCADE
);

-- Table des inscriptions aux cours
CREATE TABLE inscriptions_cours (
    id_inscription INT PRIMARY KEY AUTO_INCREMENT,
    id_etudiant INT,
    id_cour INT,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('en_cours', 'termine', 'abandonne') DEFAULT 'en_cours',
    progression INT DEFAULT 0,
    derniere_activite DATETIME,
    FOREIGN KEY (id_etudiant) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_cour) REFERENCES cours(id_cour) ON DELETE CASCADE
);

-- Insertion des données de test pour les catégories
INSERT INTO categories (name, description) VALUES 
('Développement Web', 'Cours de développement web et technologies associées'),
('Design', 'Cours de design graphique et UX/UI'),
('Marketing Digital', 'Cours de marketing en ligne'),
('Langues', 'Cours de langues étrangères');

-- Insertion d'un administrateur par défaut
INSERT INTO users (name, email, password, role, status) VALUES
('Admin', 'admin@youdemy.com', '$2y$10$secure_hash_here', 'ADMIN', 'active');