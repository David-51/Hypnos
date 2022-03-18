
-- Insert a first user without "role"
INSERT INTO users (
    email,
    firstname,
    lastname,
    password 
    )
    VALUES (
        "david@example.com",
        "David",
        "Grignon",
        "PasswordHash"     
    );

INSERT INTO users (
    email,
    firstname,
    lastname,
    password,
    role
    )
    VALUES (
        "Bigoude@example.com",
        "Bigoude",
        "Laroute",
        "PasswordHash",
        "adm"    
    );
INSERT INTO users (
    email,
    firstname,
    lastname,
    password,
    role
    )
    VALUES (
        "Biroute@example.com",
        "Biroute",
        "Macron",
        "PasswordHash",
        "man"    
    );
