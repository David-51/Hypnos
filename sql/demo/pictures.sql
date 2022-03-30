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
        "https://picsum.photos/300/300"       
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="La Mariniere"),
        "https://picsum.photos/300/300"       
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="La Cupidon"),
        "https://picsum.photos/300/300"       
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="La Cupidon"),
        "https://picsum.photos/300/300"       
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="La Cupidon"),
        "https://picsum.photos/300/300"       
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="Eros"),
        "https://picsum.photos/300/300"       
    ),
    (
        UUID(),
        (SELECT id FROM suites WHERE title="Eros"),
        "https://picsum.photos/300/300"       
    );