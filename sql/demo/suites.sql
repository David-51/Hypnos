\! echo "\033[32m*** ADD Suites ***\033[m";
INSERT 
    INTO suites (
        id,
        title,
        link_to_booking,
        description,
        price,        
        establishment_id
    )    
    VALUES (
        UUID(),
        "Eros",
        "https://iamaveryusefullinktobooking.com",
        "Cette suite de 150m2 face à la mer est l'endroit idéal pour ravivez la flamme de votre couple, personne ne peut résister à ce cadre",
        "35000",        
        (SELECT id FROM establishments WHERE city='Canne')
    ),
    (
        UUID(),
        "La Marinière",
        "https://iamaveryusefullinktobooking.com",
        "Cette suite de 150m2 face à la mer est l'endroit idéal pour ravivez la flamme de votre couple, personne ne peut résister à ce cadre",
        "35000",        
        (SELECT id FROM establishments WHERE city='Canne')
    );