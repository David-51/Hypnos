\! echo "\033[32m*** ADD messages ***\033[m";
INSERT 
    INTO messages (        
        firstname,
        lastname,
        email,
        subject,
        message,
        done
    )
    VALUES         
        ("Warrel", "Dane", "warrel@example.com", "Je voudrais louer un service supplémentaire", "Bonjour, est-il possible de louer une voiture en arrivant ?", 1),
        ("Will", "Smith", "Will@example.com", "Je souhaite en savoir plus sur une suite", "there are Zombie here ?", 0),
        ("Chris", "Roc", "Chris@example.com", "Je souhaite en savoir plus sur une suite", "have you some Ice in this suite ?", 0),
        ("Dwayne", "Johnson", "Dwayne@example.com", "J'ai un souci avec cette application", "i don't know how that work, can you help me ?", 1),
        ("Bill", "Gates", "Bill@example.com", "Je voudrais louer un service supplémentaire", "Ive lost my Macbook, Have some computer here ?", 0);
        