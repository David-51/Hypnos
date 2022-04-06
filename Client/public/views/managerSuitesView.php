<div class="row mb-3">  
        <div class="col-auto text-center">
            <h1>
                Gestion des suites
            </h1>
        </div>
        <div class="col-auto ms-auto">
            <button type="button" class="btn btn-info" id="add-establishment">Ajouter</button>
        </div>       
    </div>
    <div id="establishments-list">
    <?php    
    foreach($props as $key => $element){ ?>
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
                    <h2 class="curve ms-1 mb-2 col-auto pe-0" id="name-<?= $element->id ?>">
                        <?= $element->title ?>
                    </h2>                                                                               
                </div>         
            </div>
            <div class="row">
                <div>
                    <img class="miniature ms-1 me-2 mb-0 p-0 rounded" src="<?= $element->pictures[0] ?>" alt="chambre <?= $element->title ?>">             
                    <p id="description-<?= $element->id ?>">
                        <?= $element->description ?>
                    </p>
                    <p id="price-<?= $element->id ?>">
                        <?= $element->price/100?> €
                    </p>
                    <div class="text-center">
                        <a href="<?= $element->link_to_booking ?>">Lien Booking.com</a>             
                    </div>
                </div>
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
        <h5 class="modal-title" id="modal-title">Ajouter un établissement</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!--- form --->
        <form class="mx-4 col form-animation" id="form-crud" name="form-crud">
            <input type="hidden" name="id" id="id" value="" />
            <div class="form-group my-1">
                <label for="name">Nom de l'établissement</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="" required>                
            </div>
            <div class="form-group my-2">
                <label for="city">Ville</label>
                <input type="text" class="form-control" id="city" name="city" aria-describedby="city" required>
                
            </div>                
            <div class="form-group my-2">
                <label for="adress">Adresse</label>
                <textarea class="form-control" id="adress" name="adress" style="height: 3rem" required></textarea>                    
            </div>
            <div class="form-group my-2">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" style="height: 5rem" required></textarea>                    
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
<script type="module" src="Client/public/js/managerSuites.js"></script>