<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nos hôtels accueillent les couples qui veulent entretenir la flamme dans un cadre luxueux et accueillant">
    <base href="/">
    <link rel="stylesheet" href="Client/public/css/custom.css">
    
    <title><?= $this->title ?></title>
</head>
<body class="text-light bg-bar">
    <?= $this->navbar ?>
    <header class="fixed-top">
        <?= $this->header ?> 
    </header>
    <div class="content bg-primary text-light">
        <?= $this->body ?>
    </div>
    <footer class="d-flex align-items-end justify-content-center text-light gradient fixed-bottom">
        <?= $this->footer ?>
    </footer>
    <script src="Client/public/js/script.js"></script>
</body>
</html>