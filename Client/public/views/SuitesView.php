<?php
[$establishment_name, $props] = $props;
?>
<div class="row">
    <div class="col-auto text-center">
        <h1>
            <?= $props->title ?>
        </h1>
        <div class="liner m-auto mb-1">

        </div>
        <div class="text-center adress">                
            <p class="props"><?= $establishment_name ?></p>
        </div>
    </div>
    <div class="col-4 ms-auto mt-auto mb-3 text-end">
        <a class="me-auto" href="/send-messages"><i class="fas fa-envelope"></i>&ensp;Contact</a>        
    </div>
</div>
<div class="mb-3 put-forward p-3 rounded border border-light">
    <div class="row">
       <!-- debut carousel -->
       <div id="carousel" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <?php
                $i=0;
                foreach($props->pictures as $data){
                    ?>
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ?'active': '' ?>"></button>
                <?php 
                $i++;
                }

                ?>                
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner mx-auto">
                <?php
                $j=0;
                foreach($props->pictures as $data){
                    ?>
                <div class="carousel-item <?= $j === 0 ? 'active' : ''; ?>">
                    <img src="<?= $data->picture_link ?>" alt="Los Angeles" class="d-block mx-auto" style="width:80%">
                </div>        
                <?php $j++; } ?>
            </div>
            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        <!-- fin du Carroussel -->
    </div>
    <div class="row mt-3">
        <p>
            <?= $props->description ?>
            <br>
            <a href="<?= $props->link_to_booking ?>">Lien Booking</a>
            
        </p>
        <a class="btn btn-info col-auto mx-auto" type="button" href="./bookings?suites=<?= $props->id ?>">Réserver maintenant</a>
    </div>
</div>