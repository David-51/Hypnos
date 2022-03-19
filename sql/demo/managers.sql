\! echo "\033[32m*** ADD managers ***\033[m";
INSERT 
    INTO managers (        
        user_email,
        establishment_id
    )
    VALUES         
        ((SELECT email FROM users WHERE email="bruce@example.com"), (SELECT id FROM establishments WHERE name="La rose d'or")),
        ((SELECT email FROM users WHERE email="frodon@example.com"), (SELECT id FROM establishments WHERE name="Le palace")),
        ((SELECT email FROM users WHERE email="sauron@example.com"), (SELECT id FROM establishments WHERE name="Burj Al Arib")),
        ((SELECT email FROM users WHERE email="gandalf@example.com"), (SELECT id FROM establishments WHERE name="Miou Luxury Spa")),
        ((SELECT email FROM users WHERE email="ragnar@example.com"), (SELECT id FROM establishments WHERE name="Villa Honigg")),
        ((SELECT email FROM users WHERE email="kirk@example.com"), (SELECT id FROM establishments WHERE name="The Obarai Udaivalis")),
        ((SELECT email FROM users WHERE email="alexi@example.com"), (SELECT id FROM establishments WHERE name="Kitakies"));
        