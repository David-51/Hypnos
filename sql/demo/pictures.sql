-- ADD picture link
INSERT 
    INTO pictures (
        id,
        suites_id,
        picture_link      
    )    
    VALUES (
        UUID(),
        (SELECT id FROM suites WHERE title="Eros"),
        "https://picsum.photos/200/300"       
    );