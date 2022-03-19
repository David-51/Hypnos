\! echo "\033[32m*** ADD Users ***\033[m";
-- Insert a first user without "role"
INSERT INTO users (
    email,
    firstname,
    lastname,
    password 
    )
    VALUES
    ( "john.doe@example.com", "john", "Doe", "passwordhash" ),
    ( "jack@example.com", "jack", "Sparrow", "passwordhash"),
    ( "bruce@example.com", "Bruce", "Wayne", "passwordhash"),
    ( "frodon@example.com", "Frodon", "baggins", "passwordhash"),
    ( "sauron@example.com", "Sauron", "the magic daemon", "passwordhash"),
    ( "gandalf@example.com", "gandalf", "the magician", "passwordhash"),
    ( "ragnar@example.com", "ragnar", "lothbrokes", "passwordhash"),
    ( "kirk@example.com", "kirk", "hammett", "passwordhash"),
    ( "alexi@example.com", "Alexi", "Laiho", "passwordhash"),
    ( "warrel@example.com", "Warrel", "Dane", "passwordhash");
    
        
    
