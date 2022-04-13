<div class="d-flex flex-column align-content-between h-100">
    <div class="col-12 text-center mt-5 mb-auto">
        <img width="60%" src="/Client/public/images/logo_hypnos01.png" alt="logo Hypnos">
        <p class="mt-4 mb-1">Lorem, ipsum dolor.</p>
    </div>
    
        <div class="col-12 mx-auto"> 
            <form class="row mx-auto" id="form-destination">
                <select class="form-select col me-1" aria-label="select-destination" name="destination">
                    <option selected>destination</option>
                    <?php
                    foreach($props as $element){?>
                    <option value="<?= $element->id ?>"><?= htmlspecialchars($element->city) ?></option>
                    <?php } ?>                    
                </select>
                <button type="submit" class="btn btn-info col-auto py-0 my-0 ms-1">Go !</button>            
            </form>
        </div>
        <a href="/establishments" class="text-info text-center mt-2 mb-4">Voir la liste de nos Hôtels</a> 
</div>
<script type="module" src="/Client/public/js/home.js"></script>