-- Création de la base de données
CREATE DATABASE IF NOT EXISTS estract_db;
USE estract_db;

-- Table Utilisateur
CREATE TABLE Utilisateur (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    age INT,
    sexe ENUM('M', 'F', 'Autre'),
    role VARCHAR(20) NOT NULL
);

-- Table Administrateur
CREATE TABLE Administrateur (
    id_admin INT PRIMARY KEY,
    FOREIGN KEY (id_admin) REFERENCES Utilisateur(id_user)
);

-- Table Responsable
CREATE TABLE Responsable (
    id_responsable INT PRIMARY KEY,
    FOREIGN KEY (id_responsable) REFERENCES Utilisateur(id_user)
);

-- Table Client
CREATE TABLE Client (
    id_client INT PRIMARY KEY,
    FOREIGN KEY (id_client) REFERENCES Utilisateur(id_user)
);

-- Table Destinataire
CREATE TABLE Destinataire (
    id_destinataire INT AUTO_INCREMENT PRIMARY KEY,
    nom_destinataires VARCHAR(50) NOT NULL,
    prenom_destinataires VARCHAR(50) NOT NULL,
    telephone_destinataire VARCHAR(15)
);

-- Table Colis
CREATE TABLE Colis (
    id_colis INT AUTO_INCREMENT PRIMARY KEY,
    nature VARCHAR(50) NOT NULL,
    nom_expediteur VARCHAR(50) NOT NULL,
    nom_destinataire VARCHAR(50) NOT NULL,
    destination VARCHAR(100) NOT NULL
);

-- Table Recu
CREATE TABLE Recu (
    id_recu INT AUTO_INCREMENT PRIMARY KEY,
    nom_expediteur VARCHAR(50) NOT NULL,
    telephone_expediteur VARCHAR(15),
    nom_dest VARCHAR(50) NOT NULL,
    telephone_dest VARCHAR(15),
    natureColis VARCHAR(50) NOT NULL,
    destination_colis VARCHAR(100) NOT NULL,
    numero_suivi VARCHAR(20) UNIQUE NOT NULL
);

-- Table de relation entre Responsable et Colis
CREATE TABLE Responsable_Colis (
    id_responsable INT,
    id_colis INT,
    PRIMARY KEY (id_responsable, id_colis),
    FOREIGN KEY (id_responsable) REFERENCES Responsable(id_responsable),
    FOREIGN KEY (id_colis) REFERENCES Colis(id_colis)
);

-- Table de relation entre Client et Colis
CREATE TABLE Client_Colis (
    id_client INT,
    id_colis INT,
    PRIMARY KEY (id_client, id_colis),
    FOREIGN KEY (id_client) REFERENCES Client(id_client),
    FOREIGN KEY (id_colis) REFERENCES Colis(id_colis)
);

-- Table de relation entre Destinataire et Colis
CREATE TABLE Destinataire_Colis (
    id_destinataire INT,
    id_colis INT,
    PRIMARY KEY (id_destinataire, id_colis),
    FOREIGN KEY (id_destinataire) REFERENCES Destinataire(id_destinataire),
    FOREIGN KEY (id_colis) REFERENCES Colis(id_colis)
);