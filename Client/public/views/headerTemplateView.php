<?php
// variable accessible par l'objet appelant $this->header_props;
?>
<nav class="navbar navbar-expand-md p-2 mt-auto mb-auto bg-bar">
    <div class="col-auto">
        <a class="navbar-brand ms-2" href="/">
            <img src="/Client/public/images/hypnos_logo_name.png" alt="Hypnos logo" width="100">
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item text-light header-nav"><a href="./"><i class="fa-solid fa-house"></i>&ensp;Accueil</a></li>
            <li class="nav-item text-light header-nav"><a href="./establishments"><i class="fa-solid fa-hotel"></i>&ensp;Hôtels</a></li>                                                 
            <?php 
            if(isset($_SESSION['role']) 
                && ($_SESSION['role'] === 'use' || $_SESSION['role'] === 'adm' || $_SESSION['role'] === 'man')){?>
            <li class="nav-item text-light header-nav"><a href="./bookings/list"><i class="fa-solid fa-suitcase"></i>&ensp;Réservations</a></li>                                    
            <?php } ?>
            <li class="nav-item text-light header-nav"><a href="./send-messages"><i class="fa-solid fa-envelope"></i>&ensp;Nous contacter</a></li>

            <?php if(isset($_SESSION['role'])                     
                    && ($_SESSION['role'] === 'adm' 
                    || $_SESSION['role'] ==='man')){?>
                    <div class="dropdown">
                        <li class="nav-item text-light header-nav">
                            <a class="dropdown-toggle" id="admin-menu" role="button" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gear"></i>&ensp;Administration</a>
                            <ul class="dropdown-menu bg-bar" aria-labelledby="admin-menu">
                                <?php if($_SESSION['role'] === 'adm'){
                                    ?>
                                <li><a class="bg-bar" href="/admin/establishments"><i class="fa-solid fa-hotel"></i>&ensp;Etablissements</a></li>
                                <li><a class="bg-bar" href="/admin/managers"><i class="fa-solid fa-user-group"></i>&ensp;Gérants</a></li>
                                <li><a class="bg-bar" href="/admin/messages"><i class="fa-solid fa-message"></i>&ensp;Messages</a></li>
                                <?php } else { ?>
                                    <li><a class="bg-bar" href="/manager/suites"><i class="fa-solid fa-bed"></i>&ensp;Suites</a></li>

                                <?php } ?>
                            </ul>
                        </li>
                            
                        <?php } ?>
                    </div>
        </ul>
    </div>
    <div class="ms-auto hello-user">
        <ul class="navbar-nav me-2">
            <?php
            if(isset($_SESSION['firstname'])){?>
            <li class="nav-item text-light header-nav">Bonjour <?= $_SESSION['firstname'] ?></li>
        <?php } ?>
        </ul>
    </div>
    <div class="ms-auto col-auto" id="hamburgerMenu">
        <div class="burger"></div>
        <div class="burger"></div>
        <div class="burger"></div>
    </div>
</nav>
