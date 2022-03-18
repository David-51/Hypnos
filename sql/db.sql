-- Creation de la base de données

-- Delete 'hypnos' database if already set
DROP DATABASE IF EXISTS hypnos;

-- Create hypnos database
Create DATABASE IF NOT EXISTS hypnos CHARACTER SET = utf8mb4;

-- use hypnos database
Use hypnos;

-- Create 'establishment' Table
-- id is an uuid
CREATE Table IF NOT EXISTS establishment
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    adress TEXT NOT NULL,
    description TEXT NOT NULL
);

-- Create 'suites' table
CREATE Table IF NOT EXISTS suites
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    link_to_booking TEXT,
    description TEXT NOT NULL,
    price INT(6) NOT NULL,
    pictures_id VARCHAR(36),
    establishment_id VARCHAR(36),
    FOREIGN KEY (establishment_id) REFERENCES establishment(id)
        ON DELETE CASCADE
    -- FOREIGN KEY (pictures_id) REFERENCES pictures(id)
    --     ON DELETE CASCADE
);

-- Create 'pictures' tables
CREATE Table IF NOT EXISTS pictures
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY,
    suites_id VARCHAR(36),
    picture_link TEXT NOT NULL,        
    FOREIGN KEY (suites_id) REFERENCES suites(id)
        ON DELETE CASCADE
);

SELECT 'create de la user table';

CREATE Table IF NOT EXISTS users
(
    email VARCHAR(255) NOT NULL UNIQUE PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    password VARCHAR(60) NOT NULL,
    role VARCHAR(3) DEFAULT "use"
);