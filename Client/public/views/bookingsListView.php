<div class="row">  
    <div class="col text-center">
        <h1>
            Vos réservations
        </h1>
    </div>        
</div>
    <?php
    foreach($props as $key => $element){ ?>
<div class="mt-2 mb-3 p-2 border border-light rounded shadow-light put-forward">        
    <form class="row p-2 booking-form" id="bookings-list">
        <input type="hidden" name="id" id="id" value="<?= $element->booking_id ?>">
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
            <button type="submit" class="btn btn-annulation put-forward border-none" href="#" id="annulation">Annuler</button> 
        </div>                                
    </form>            
</div>
    <?php
    };
    ?>
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down">
    <div class="modal-content put-forward text-light border border-light">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Confirmation d'annulation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>     
    </div>
  </div>
</div>
<div id="validation" class="validation"></div>
<i id="check" class="fa-regular fa-circle-check check"></i>

<script type="module" src="Client/public/js/bookingList.js"></script>