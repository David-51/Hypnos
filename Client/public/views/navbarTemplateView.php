<nav class="wrapper bg-bar" id="shutter">
    <div class="sidebar-logo mt-3 mb-4">                      
        <a class="navbar-brand" href="/">
            <img src="/Client/public/images/hypnos_logo_name.png" alt="Hypnos logo" width="100">
        </a>        
    </div>
    <div class="dismiss" id="dismiss-menu">
        <i class="fas fa-arrow-left"></i>
    </div>
    <p class="sidebar-title">menu</p>
    <ul class="sidebar">        
        <li class="sidebar-item">
            <a href="/">Accueil</a>
        </li>
        <li class="sidebar-item">
            <a href="/establishments">Nos Hôtels</a>
        </li>
        <?php if(isset($_SESSION['role'])
                && ($_SESSION['role'] === 'use' 
                || $_SESSION['role'] === 'adm'
                || $_SESSION['role'] === 'man')){?>

            <li class="sidebar-item">
                <a href="/bookings">Vos réservations</a>
            </li>
            <?php } ?>
        </ul>
    
    <?php if(isset($_SESSION['role'])
            && ($_SESSION['role'] === 'adm'
            || $_SESSION['role'] === 'man')){?>
        
    <ul class="sidebar">
        <li class="nav-item sidebar-item sidebar-subtitle">
            <p class="sidebar-item">Administration</p>                
        </li>
        <li class="nav-item sidebar-item">
            <a href="/admin/establishments">Etablissements</a>
        </li>
        <li class="nav-item sidebar-item">
            <a href="/admin/managers">Gérants</a>
        </li>
        <li class="nav-item sidebar-item">
            <a href="/admin/messages">Messages</a>
        </li>
    </ul>
        <?php } ?>
    <ul class="sidebar">
        <li class="sidebar-item">
            <?php
            if(isset($_SESSION['firstname'])){?>
                <a href="/logout">Se déconnecter</a>
        <?php }else{?>
            <a href="/login">Se connecter</a>
        <?php } ?>
        </li>
        <li class="sidebar-item">
            <a href="/send-messages">Envoyer un message</a>
        </li>
    </ul>
</nav>
