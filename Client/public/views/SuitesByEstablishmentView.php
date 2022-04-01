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
        <a class="me-auto" href="/send-messages"><i class="fas fa-envelope"></i>&ensp;Contact</a>        
    </div>
</div>
<div class="mb-3">
    <?php
    foreach($list as $key => $data){
        if(isset($data->pictures[0]->picture_link)){
            $src_picture = $data->pictures[0]->picture_link;
        }
        else{
            $src_picture = '#';
        }
        ?>
    
    <div class="row border border-light shadow shadow-lg mt-3 rounded put-forward p-2 mx-1">
        <div class="row p-0 m-auto col-12 d-flex justify-content-between">
            <div class="col-9 my-auto p-0">
                <h5 class="m-0 p-0">
                    <?= $data->title ?>
                </h5>
            </div>
            <div class="col-3 my-auto p-0">
                <p class="m-0 p-0 text-end">
                    <?= $data->price/100 ?> €
                </p>
            </div>
        </div>
        <div class="row mt-0 p-0 mx-auto">
            <div class="col-12 mt-2 p-0" >
                <p class="suites-description">
                    
                        <img class="miniature ms-1 me-1 mb-0 p-0 rounded" 
                        src="<?= $src_picture ?>" alt="photo de la chambre"/>
                    
                    <b>Description : </b><?= $data->description ?>
                    <br><a href="<?= $data->link_to_booking ?>">Réserver sur Booking</a>      
                </p>
            </div>
        </div>
        <div class="row mx-auto mt-2">
            <a href="/suites?id=<?= $data->id ?>" type="button" class="btn btn-info col-auto mx-auto">Réserver Maintenant</a>
            <a class="text-info text-center text-sm mt-1" href="/suites?id=<?= $data->id ?>">Plus d'informations</a>
        </div>
    </div>
    <?php
}
?>
</div>