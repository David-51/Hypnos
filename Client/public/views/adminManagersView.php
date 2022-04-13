<?php
[$list, $hotels] = $props;
?>
    <div class="row mb-2">  
        <div class="col-auto text-center">
            <h1>
                Gérants
            </h1>
        </div>
        <div class="col-auto ms-auto">
            <button type="button" class="btn btn-info" id="add-managers">Ajouter</button>
        </div>       
    </div>
    <div id="managers-list">
    <?php    
    foreach($list as $key => $element){ ?>
        <div class="border border-light rounded shadow-light put-forward custom-card" id="card-<?= $element->id ?>">        
            <div class="col-auto ms-auto my-auto custom-card-container">                
                <button class="btn m-0 p-0 text-light edit" type="button" id="edit-<?= $element->id ?>">
                    <i class="fa-solid fa-pen-to-square icone"></i>
                </button>
                <button class="btn m-0 p-0 text-danger delete" type="button" id="delete-<?= $element->id ?>">
                    <i class="fa-solid fa-trash-can text-danger ms-1 icone"></i>
                </button>                
            </div>
            <div class="row">
                <div class="row col-10">
                    <h2 class="mb-0 col-auto pe-0 mt-auto" id="fullname-<?= $element->id ?>">
                    <span id="lastname-<?= $element->id ?>"><?= htmlspecialchars(strtoupper($element->lastname)) ?></span>
                    <span id="firstname-<?= $element->id ?>"><?= htmlspecialchars(ucFirst($element->firstname)) ?> </span>
                    </h2>                
                    <h3 class="card-city mb-0 mt-auto ps-2 col-auto" id="establishment-<?= $element->id ?>">
                        <?= htmlspecialchars($element->name) ?>
                    </h3>                                            
                </div>         
            </div>
            <div class="row">
                <p class="font-light mb-1" id="email-<?= $element->id ?>">
                    <?= htmlspecialchars($element->email) ?>
                </p>                    
            </div>                                
        </div>
    <?php
    };
    ?>
    </div>
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down">
    <div class="modal-content put-forward text-light border border-light">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Ajouter un gérant</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--- form --->
        <form class="mx-4 col form-animation" id="form-crud" name="form-crud">
            <input type="hidden" name="id" id="id" value="" />
            <div class="form-group my-1">
                <label for="firstname">Prénom</label>
                <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="firstname" value="" required>                
            </div>
            <div class="form-group my-1">
                <label for="lastname">Nom</label>
                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname" value="" required>                
            </div>
            <div class="form-group my-2">
                <label for="email">Email</label>
                <input type="mail" class="form-control" id="email" name="email" aria-describedby="email" required>                
            </div>                
            <div class="form-group my-2" id="password-field">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" aria-describedby="password" required>                
            </div>                
            <div class="form-group my-2" id="confirm-password-field">
                <label for="confirm-password">Confirmez le mot de passe</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" aria-describedby="confirm-password" required>                
            </div>                
            <div>
                <label for="establishment">Etablissement</label>
                <select class="form-select col me-1" aria-label="select-establishment" id="establishment" name="establishment" required>
                    <option selected>Choisissez l'hôtel</option>
                    <?php
                    foreach($hotels as $hotel){?>
                        <option value="<?= $hotel->id ?>"><?= $hotel->name ?></option>

                    <?php } ?>
                    
                </select>
            </div>
            
            <div>
                <small class="text-danger" id="helper">&ensp;</small>
            </div>
            <div class="d-grid">
                <button id="modal-submit-button" type="submit" class="btn btn-info my-1 btn-block disabled" data-bs-dismiss="modal" id="modal-button">Ajouter</button>
            </div>
        </form>
        <!--- end of form --->
      </div>     
    </div>
  </div>
</div>
<div id="validation" class="validation"></div>
<i id="check" class="fa-regular fa-circle-check check"></i>
<script type="module" src="Client/public/js/adminManagers.js"></script>