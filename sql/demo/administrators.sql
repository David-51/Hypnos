\! echo "\033[32m*** ADD Administrators ***\033[m";
INSERT 
    INTO administrators (        
        user_id
    )
    VALUES         
        ((SELECT id FROM users WHERE email="john.doe@example.com")),
        ((SELECT id FROM users WHERE email="jack@example.com"));
    