\! echo "\033[32m*** ADD Establishments ***\033[m";

INSERT 
    INTO establishments (
        id,
        name,
        city,
        adress,
        description
    )    
    VALUES 
    ( UUID(), "La rose d'or", "Canne", "3 avenue de la place", "une adresse d'exception qu'il ne faut surtout pas manquer"),
    ( UUID(), "Le palace", "Paris", "31 avenue des champs Elysee", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores eos maxime nam fuga consectetur porro amet adipisci ullam. Sunt aspernatur, a inventore porro dolorem illo perspiciatis recusandae labore excepturi omnis, corrupti necessitatibus quos exercitationem id enim voluptas praesentium? Placeat, vel ipsum. Rem, porro? Cum voluptatum ducimus quis iste voluptate cupiditate."),
    ( UUID(), "Burj Al Arib", "Brest", "13 place du bout du monde", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores eos maxime nam fuga consectetur porro amet adipisci ullam. Sunt aspernatur, a inventore porro dolorem illo perspiciatis recusandae labore excepturi omnis, corrupti necessitatibus quos exercitationem id enim voluptas praesentium? Placeat, vel ipsum. Rem, porro? Cum voluptatum ducimus quis iste voluptate cupiditate."),
    ( UUID(), "Miou Luxury Spa", "Strasbourg", "244 place de l'ocean", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores eos maxime nam fuga consectetur porro amet adipisci ullam. Sunt aspernatur, a inventore porro dolorem illo perspiciatis recusandae labore excepturi omnis, corrupti necessitatibus quos exercitationem id enim voluptas praesentium? Placeat, vel ipsum. Rem, porro? Cum voluptatum ducimus quis iste voluptate cupiditate."),
    ( UUID(), "Villa Honigg", "Lille", "32 place de l'été polaire", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores eos maxime nam fuga consectetur porro amet adipisci ullam. Sunt aspernatur, a inventore porro dolorem illo perspiciatis recusandae labore excepturi omnis, corrupti necessitatibus quos exercitationem id enim voluptas praesentium? Placeat, vel ipsum. Rem, porro? Cum voluptatum ducimus quis iste voluptate cupiditate."),
    ( UUID(), "The Obarai Udaivalis", "Toulouse", "131 rue des indiens", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores eos maxime nam fuga consectetur porro amet adipisci ullam. Sunt aspernatur, a inventore porro dolorem illo perspiciatis recusandae labore excepturi omnis, corrupti necessitatibus quos exercitationem id enim voluptas praesentium? Placeat, vel ipsum. Rem, porro? Cum voluptatum ducimus quis iste voluptate cupiditate."),
    ( UUID(), "Kitakies", "Annecy", "1 place du lac", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores eos maxime nam fuga consectetur porro amet adipisci ullam. Sunt aspernatur, a inventore porro dolorem illo perspiciatis recusandae labore excepturi omnis, corrupti necessitatibus quos exercitationem id enim voluptas praesentium? Placeat, vel ipsum. Rem, porro? Cum voluptatum ducimus quis iste voluptate cupiditate.")
    ;


    
    