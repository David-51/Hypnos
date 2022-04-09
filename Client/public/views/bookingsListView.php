<div class="row">  
    <div class="col text-center">
        <h1>
            Vos réservations
        </h1>
    </div>        
</div>
<div id="booking-list">
    <?php

    foreach($props as $key => $element){ ?>
<div class="mt-2 mb-3 p-2 border border-light rounded shadow-light put-forward <?= $element->done ? 'card-done' : '' ?>" 
    id="booking-<?= $element->booking_id ?>">        
    <div class="row p-2">        
        <div class="col">
            <h2 class="curve">
                <?= $element->name ?>
            </h2>
            <h3>
                Suite "<?= $element->title ?>"
            </h3>
            <p>
            du <?= date('d-m-Y', strtotime($element->date_checkin)) ?> au <?= date('d-m-Y', strtotime($element->date_checkout)) ?>
            </p>                  
        </div>
        <div class="ms-auto col-auto text-center my-auto">
            <button class="btn btn-annulation put-forward border-none 
            <?= $element->annulation ? '' : 'disabled' ?>         
            " id="annulation-<?= $element->booking_id ?>" >Annuler</button> 
        </div>                                
    </div>            
</div>
    <?php
    };
    ?>

</div>
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content put-forward text-light border border-light">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Confirmation d'annulation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <p class="text-center">
          Êtes vous sûr de vouloir annuler votre réservation ?
          </p>
          <div class="row">
              <div class="col text-center my-auto">
                  <form id="form-modal">
                    <input type="hidden" name="id" value="">
                    <button type="submit" class="btn btn-annulation" id="confirmation">
                          Oui, j'annule
                    </button>
                  </form>
              </div>
              <div class="col text-center my-auto">
                  <button class="btn btn-danger" id="annulation">
                        Non, je me suis trompé(e)
                  </button>
              </div>
          </div>
          <div class="helper">
              <small class="text-danger" id="helper">&ensp;</small>
          </div>
      </div>     
    </div>
  </div>
</div>
<div id="validation" class="validation"></div>
<i id="check" class="fa-regular fa-circle-check check"></i>

<script type="module" src="Client/public/js/bookingList.js"></script>