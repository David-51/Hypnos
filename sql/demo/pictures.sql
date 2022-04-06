-- ADD picture link
\! echo "\033[32m*** Add Picture Link ***\033[m";

INSERT 
    INTO pictures (
        id,
        suite_id,
        picture_link      
    )    
    VALUES (
        UUID(),
        (SELECT id FROM suites WHERE title="Eros"),
        "/Client/public/images/chambre1.jpeg"       
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="La Mariniere"),
        "/Client/public/images/chambre2.jpeg"   
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="La Cupidon"),
        "/Client/public/images/chambre3.jpeg"     
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="La Cupidon"),
        "https://picsum.photos/640/480"     
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="La Cupidon"),
        "https://picsum.photos/640/480"       
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="Eros"),
        "https://picsum.photos/640/480"       
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="Eros"),
        "https://picsum.photos/640/480"        
    );