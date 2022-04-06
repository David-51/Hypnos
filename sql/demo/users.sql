\! echo "\033[32m*** ADD Users ***\033[m";
-- Insert a first user without "role"
INSERT INTO users (
    email,
    firstname,
    lastname,
    password,
    role 
    )
    VALUES
    ( "john.doe@example.com", "john", "Doe", "passwordhash","adm" ),
    ( "jack@example.com", "jack", "Sparrow", "passwordhash", "adm"),
    
    ( "bruce@example.com", "Bruce", "Wayne", "passwordhash", "man"),
    ( "frodon@example.com", "Frodon", "baggins", "passwordhash", "man"),
    ( "sauron@example.com", "Sauron", "the magic daemon", "passwordhash", "man"),
    ( "gandalf@example.com", "gandalf", "the magician", "passwordhash", "man"),
    ( "ragnar@example.com", "ragnar", "lothbrokes", "passwordhash", "man"),
    ( "kirk@example.com", "kirk", "hammett", "passwordhash", "man"),
    ( "alexi@example.com", "Alexi", "Laiho", "passwordhash", "man"),
    ( "david@example.com", "david", "moi", "$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a", "man"), -- 12345678

    ( "jeff@example.com", "Jeff", "Loomis", "passwordhash", "use"),
    ( "warrel@example.com", "Warrel", "Dane", "passwordhash", "use"),
    ( "Danny@example.com", "Danny", "Ocean", "passwordhash", "use"),
    ( "Rusty@example.com", "Rusty", "Ryan", "passwordhash", "use"),
    ( "Jordan@example.com", "Jordan", "Belfort", "passwordhash", "use");
    
        
    
