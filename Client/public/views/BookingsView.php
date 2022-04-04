<div class="row">
    <div class="col-12 text-center mt-1">        
        <h1>Réservez votre suite</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-2">
        <form class="mx-4 col" id="booking">
            <div id="select-establishments" class="mb-3">
                <label for="establishment" class="form-label">Votre hôtel</label>              
                <select class="form-select col me-1" aria-label="select-establishment" id="establishment" name="establishment" required>
                    <option selected>Choisissez l'hôtel</option>
                    <option value="information">Je souhaite en savoir plus sur une suite</option>
                    <option value="service">Je souhaite commander un service supplémentaire</option>
                    <option value="complaint">Je souhaite poser une réclamation</option>                    
                </select>
            </div>
            <div id="select-suites" class="mb-3">                
                <label for="suites" class="form-label">Votre suite</label>              
                <select class="form-select col me-1" aria-label="select-suite" id="suites" name="suites" required>
                    <option selected>Choisissez votre suite</option>
                    <option value="information">Je souhaite en savoir plus sur une suite</option>
                    <option value="service">Je souhaite commander un service supplémentaire</option>
                    <option value="complaint">Je souhaite poser une réclamation</option>                    
                </select>
            </div>
            <div class="mb-3">
                <label for="checkin" class="form-label">Date d'arrivée</label>
                <input type="date" class="form-control" id="checkin" required placeholder="Choisissez">
            </div>
            <div class="mb-3">
                <label for="checkout" class="form-label">Date de départ</label>
                <input type="date" class="form-control" id="checkout" required placeholder="Choisissez">
            </div>
            <small class="text-danger" id="helper">Tous les champs sont requis</small>   
            <div class="d-grid">
                    <button id="submit-button" type="submit" class="btn btn-info my-1 btn-block disabled">Réserver mon séjour</button>
            </div>            
        </form>
    </div>    
</div>
<div id="validation" class="validation"></div>
<i id="check" class="fa-regular fa-circle-check check"></i>
<script type="module" src="Client/public/js/bookings.js"></script>