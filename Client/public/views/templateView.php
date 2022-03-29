<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nos hôtels accueillent les couples qui veulent entretenir la flamme dans un cadre luxueux et accueillant">
    <link rel="stylesheet" href="Client/public/css/custom.css">
    
    <title><?= $this->title ?></title>
</head>
<body class="d-flex flex-column ">
    <header>
        <?= $this->header ?> 
    </header> 
    <div class="flex-grow-1">
        <?= $this->body ?>
    </div>
    <footer>
        <?= $this->footer ?>
    </footer>    
</body>
</html>