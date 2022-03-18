-- Creation de la base de données
Create DATABASE IF NOT EXISTS hypnos CHARACTER SET = utf8mb4;

-- use hypnos database
Use hypnos;

-- Creation de la table 'establishment'
-- id is an uuid
CREATE Table IF NOT EXISTS establishment
(
    id VARCHAR(36) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    adress TEXT NOT NULL,
    description TEXT NOT NULL
)