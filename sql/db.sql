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
);

CREATE Table IF NOT EXISTS suites
(
    id VARCHAR(36) NOT NULL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    link_to_booking TEXT,
    picture_link TEXT,
    description TEXT NOT NULL,
    price INT(6) NOT NULL,
    establishment_id VARCHAR(36),
    FOREIGN KEY (establishment_id) REFERENCES establishment(id)
);