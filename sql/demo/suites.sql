INSERT 
    INTO suites (
        id,
        title,
        link_to_booking,
        description,
        price,
        pictures_id,
        establishment_id
    )    
    VALUES (
        UUID(),
        "Eros",
        "https://iamaveryusefullinktobooking.com",
        "Cette suite de 150m2 face à la mer est l'endroit idéal pour ravivez la flamme de votre couple, personne ne peut résister à ce cadre",
        "35000",
        "123456",
        (SELECT id FROM establishment WHERE city='Canne')
    );