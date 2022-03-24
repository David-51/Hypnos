\! echo "\033[32m*** ADD messages ***\033[m";
INSERT 
    INTO messages (        
        user_id,
        message,
        done
    )
    VALUES         
        ((SELECT id FROM users WHERE email="warrel@example.com"), "Bonjour, est-il possible de louer une voiture en arrivant ?", 1),
        ((SELECT id FROM users WHERE email="alexi@example.com"), "Hi from the heaven, I would like to see my friends warrel, would you know when it comes ?", 0);