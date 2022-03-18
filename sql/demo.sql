-- insert data for demo

INSERT 
    INTO establishment (
        id,
        name,
        city,
        adress,
        description
    )    
    VALUES (
        UUID(),
        "La rose dor",
        "Canne",
        "3 avenue de la place",
        "une adresse d'exception qu'il ne faut surtout pas manquer"
    )