\! echo "\033[32m*** ADD managers ***\033[m";
INSERT 
    INTO managers (        
        user_email,
        establishment_id
    )
    VALUES         
        ((SELECT email FROM users WHERE email="bruce@example.com"), (SELECT id FROM establishments WHERE name="La rose d'or")),
        ((SELECT email FROM users WHERE email="frodon@example.com"), (SELECT id FROM establishments WHERE name="Le palace"));
        
    