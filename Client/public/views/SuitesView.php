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
        <a class="me-auto" href="#"><i class="fas fa-envelope"></i>&ensp;Contact</a>        
    </div>
</div>
<div class="mb-3">
    <div class="row">
       <!-- debut carousel -->
       <div id="carousel" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
        </div>

<!-- The slideshow/carousel -->
        <div class="carousel-inner mx-auto">
            <?php
            $i=0;
            foreach($props->pictures as $data){
                ?>
            <div class="carousel-item <?= $i === 0 ? 'active' : ''; ?>">
                <img src="<?= $data->picture_link ?>" alt="Los Angeles" class="d-block mx-auto" style="width:50%">
            </div>        
            <?php $i++; } ?>
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
    <div class="row">
        <p>
            <?= $props->description ?>
            <br>
            <a href="<?= $props->link_to_booking ?>">Lien Booking</a>
            
        </p>
        <a class="btn btn-info col-auto mx-auto" type="button" href="http://">Réserver maintenant</a>
    </div>
</div>