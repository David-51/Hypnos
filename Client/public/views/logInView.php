<div class="row">
    <div class="col-12 text-center mt-1">
        <img class="login-logo" src="/Client/public/images/logo_hypnos01.png" alt="logo Hypnos">
        <p class="mt-4 mb-1">Connectez-vous</p>
    </div>
    <div class="row mt-2 mx-auto">
        <form class="col-9 mx-auto" id="connexion" spellcheck="false">            
            <div class="form-group my-3">
                <label for="Email">Votre email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" required>
            </div>
            <div class="form-group my-3">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <small class="text-danger" id="helper">&ensp;</small>
            <div class="d-grid">
                <button type="submit" 
                    class="btn btn-info my-1 btn-block disabled" id="submit-button">Connexion</button>
            </div>
            <div class="text-center my-2">
                <a class="text-danger" href="/signin" id="create-account">Créer un compte</a>
            </div>
        </form>
    </div>    
</div>
<div id="validation" class="validation"></div>
<i id="check" class="fa-regular fa-circle-check check"></i>

<script type="module" src="Client/public/js/connexion.js"></script>