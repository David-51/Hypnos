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
            <a href="/"><i class="fa-solid fa-house"></i>&ensp;Accueil</a>
        </li>
        <li class="sidebar-item">
            <a href="/establishments"><i class="fa-solid fa-hotel"></i>&ensp;Nos Hôtels</a>
        </li>
        <?php if(isset($_SESSION['role'])
                && ($_SESSION['role'] === 'use' 
                || $_SESSION['role'] === 'adm'
                || $_SESSION['role'] === 'man')){?>

            <li class="sidebar-item">
                <a href="/bookings/list"><i class="fa-solid fa-suitcase"></i>&ensp;Vos réservations</a>
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
        <?php if($_SESSION['role']=== 'adm'){
            ?>
            <li class="nav-item sidebar-item">
                <a href="/admin/establishments"><i class="fa-solid fa-hotel"></i>&ensp;Etablissements</a>
            </li>
            <li class="nav-item sidebar-item">
                <a href="/admin/managers"><i class="fa-solid fa-user-group"></i>&ensp;Gérants</a>
            </li>
            <li class="nav-item sidebar-item">
                <a href="/admin/messages"><i class="fa-solid fa-message"></i>&ensp;Messages</a>
            </li>
            
            <?php   }else if($_SESSION['role'] === 'man'){
                ?>
                <li class="nav-item sidebar-item">
                    <a href="/manager"><i class="fa-solid fa-bed"></i>&ensp;Gestion des suites</a>
                </li>

         <?php
     } ?>
    </ul>
        <?php } ?>
    <ul class="sidebar">
        <li class="sidebar-item">
            <?php
            if(isset($_SESSION['firstname'])){?>
                <a href="/logout"><i class="fa-solid fa-right-from-bracket"></i>&ensp;Se déconnecter</a>
        <?php }else{?>
            <a href="/login"><i class="fa-solid fa-right-to-bracket"></i>&ensp;Se connecter</a>
        <?php } ?>
        </li>
        <li class="sidebar-item">
            <a href="/send-messages"><i class="fa-solid fa-envelope"></i>&ensp;Envoyer un message</a>
        </li>
    </ul>
</nav>
