-- Creation de la base de données

-- Delete 'hypnos' database if already set


\! echo "\033[31m*** Delete Database if exist ***\033[m";
DROP DATABASE IF EXISTS hypnos;

-- Create hypnos database
-- The default collation is utf8mb4_0900_ai_ci when charst is utf8mb4;
\! echo "\033[33m*** Create Database Hypnos ***\033[m";
Create DATABASE IF NOT EXISTS hypnos CHARACTER SET = utf8mb4;

-- use hypnos database
Use hypnos;

-- Create 'establishment' Table
-- id is an uuid
\! echo "\033[33m*** Create Table establishments ***\033[m";
CREATE Table IF NOT EXISTS establishments
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY COLLATE utf8mb4_0900_as_cs DEFAULT (UUID()),
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    adress TEXT NOT NULL,
    description TEXT NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

-- Create 'suites' table
\! echo "\033[33m*** Create Table suites ***\033[m";
CREATE Table IF NOT EXISTS suites
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY COLLATE utf8mb4_0900_as_cs DEFAULT (UUID()),
    title VARCHAR(255) NOT NULL,
    link_to_booking TEXT,
    description TEXT NOT NULL,
    price INT NOT NULL,    
    establishment_id VARCHAR(36) COLLATE utf8mb4_0900_as_cs,
    FOREIGN KEY (establishment_id) REFERENCES establishments(id)
        ON DELETE CASCADE    
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

-- Create 'pictures' table
\! echo "\033[33m*** Create Table pictures ***\033[m";
CREATE Table IF NOT EXISTS pictures
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY COLLATE utf8mb4_0900_as_cs DEFAULT (UUID()),
    suite_id VARCHAR(36) COLLATE utf8mb4_0900_as_cs,
    picture_link TEXT NOT NULL,        
    FOREIGN KEY (suite_id) REFERENCES suites(id)
        ON DELETE CASCADE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;


-- Create 'users' table
\! echo "\033[33m*** Create Table users ***\033[m";
CREATE Table IF NOT EXISTS users
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY COLLATE utf8mb4_0900_as_cs DEFAULT (UUID()),
    email VARCHAR(255) NOT NULL UNIQUE,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    password VARCHAR(60) NOT NULL,
    role VARCHAR(3) NOT NULL DEFAULT "use"
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

-- Create 'Administrators' table
\! echo "\033[33m*** Create Table administrators ***\033[m";
CREATE Table IF NOT EXISTS administrators
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY COLLATE utf8mb4_0900_as_cs DEFAULT (UUID()),    
    user_id VARCHAR(36) NOT NULL UNIQUE COLLATE utf8mb4_0900_as_cs,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

-- Create 'managers' table
\! echo "\033[33m*** Create Table managers ***\033[m";
CREATE Table IF NOT EXISTS managers
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY COLLATE utf8mb4_0900_as_cs DEFAULT (UUID()),    
    establishment_id VARCHAR(36) NOT NULL COLLATE utf8mb4_0900_as_cs,
    user_id VARCHAR(36) NOT NULL UNIQUE COLLATE utf8mb4_0900_as_cs,
    FOREIGN KEY (establishment_id) REFERENCES establishments(id) ON UPDATE CASCADE ON DELETE CASCADE,    
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE    
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

-- Create 'message' table
\! echo "\033[33m*** Create Table messages ***\033[m";
CREATE Table IF NOT EXISTS messages
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY COLLATE utf8mb4_0900_as_cs DEFAULT (UUID()),
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    done INT NOT NULL DEFAULT 0    
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;


-- Create 'booking' table
\! echo "\033[33m*** Create Table bookings ***\033[m";
CREATE Table IF NOT EXISTS bookings
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY COLLATE utf8mb4_0900_as_cs DEFAULT (UUID()),
    booking_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    user_id VARCHAR(255) NOT NULL COLLATE utf8mb4_0900_as_cs,
    suite_id VARCHAR(36) COLLATE utf8mb4_0900_as_cs,
    date_checkin DATE NOT NULL,
    date_checkout DATE NOT NULL,
    number_of_nights INT GENERATED ALWAYS AS ( DATEDIFF(date_checkout, date_checkin)) STORED,    
    price INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
    FOREIGN KEY (suite_id) REFERENCES suites(id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

-- Create table 'calendar
\! echo "\033[33m*** Create Table Calendar ***\033[m";

CREATE Table IF NOT EXISTS calendars
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY COLLATE utf8mb4_0900_as_cs DEFAULT (UUID()),
    suite_id VARCHAR(36) NOT NULL COLLATE utf8mb4_0900_as_cs,
    user_id VARCHAR(255) NOT NULL COLLATE utf8mb4_0900_as_cs,
    booking_id VARCHAR(36) NOT NULL COLLATE utf8mb4_0900_as_cs,
    date DATE NOT NULL,
    FOREIGN KEY (suite_id) REFERENCES suites(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;