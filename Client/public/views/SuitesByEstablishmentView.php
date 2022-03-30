<?php
[$name, $city, $list] = $props;
?>
<div class="row">
    <div class="col-auto">
        <h1>
            <?= $name ?>
        </h1>
        <div class="liner m-auto mb-1">

        </div>
        <div class="text-center adress">                
            <?= $city ?>
        </div>
    </div>
    <div class="col-4 ms-auto mt-auto text-end">
        <a class="me-auto" href="#"><i class="fas fa-envelope"></i>&ensp;Contact</a>        
    </div>
</div>
<div class="mb-3">
    <?php
    foreach($list as $key => $data){
        ?>
    
    <div class="row border border-light shadow shadow-lg mt-3 rounded put-forward p-2 mx-1">
        <div class="row p-0 m-auto col-12 d-flex justify-content-between">
            <div class="col-9 my-auto p-0">
                <h5 class="m-0 p-0">
                    <?= $data->suites_title ?>
                </h5>
            </div>
            <div class="col-3 my-auto p-0">
                <p class="m-0 p-0 text-end">
                    <?= $data->suites_price ?>
                </p>
            </div>
        </div>
        <div class="row mt-0 p-0 mx-auto">
            <div class="col-12 mt-2 p-0" >
                <p class="suites-description">
                    
                        <img class="miniature ms-1 me-1 mb-0 p-0" src="#" alt="photo de la chambre" async lazy/>
                    
                    <b>Description : </b><?= $data->suites_description ?>
                </p>        
            </div>
        </div>
        <div class="row mx-auto">
            <button type="button" class="btn btn-info col-auto mx-auto">Réserver Maintenant</button>
            <a class="text-info text-center text-sm mt-1" href="#">Plus d'informations</a>
        </div>
    </div>
    <?php
}?>
</div>