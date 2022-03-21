\! echo "\033[32m*** ADD Administrators ***\033[m";
INSERT 
    INTO administrators (        
        user_email
    )
    VALUES         
        ((SELECT email FROM users WHERE email="john.doe@example.com")),
        ((SELECT email FROM users WHERE email="jack@example.com"));
    