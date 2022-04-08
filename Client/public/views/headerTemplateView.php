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
            <li class="nav-item text-light header-nav"><a href="./">Accueil</a></li>
            <li class="nav-item text-light header-nav"><a href="./establishments">Hôtels</a></li>                                                 
            <?php 
            if(isset($_SESSION['role']) 
                && ($_SESSION['role'] === 'use' || $_SESSION['role'] === 'adm' || $_SESSION['role'] === 'man')){?>
            <li class="nav-item text-light header-nav"><a href="./bookings/list">Réservations</a></li>                                    
            <?php } ?>
            <li class="nav-item text-light header-nav"><a href="./send-messages">Nous contacter</a></li>

            <?php if(isset($_SESSION['role'])                     
                    && ($_SESSION['role'] === 'adm' 
                    || $_SESSION['role'] ==='man')){?>
                <li class="nav-item text-light header-nav"><a href="./admin">Administration</a></li>
                <?php } ?>
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
