<i id="check" class="fa-regular fa-circle-check check"></i>                
<div id="create_account bg-primary">  
    <div class="row">
        <div class="col-12 text-center mt-1">
            <img class="signin-logo" src="/Client/public/images/logo_hypnos01.png" alt="logo Hypnos">
            <p class="my-1">Créez votre compte</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 mt-2">
            <div id="validation" class="validation">                
                </div>
            <form class="mx-4 col form-animation" id="create-account-form">
                <div class="form-group my-1">
                    <label for="firstname">Votre prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="name">                
                </div>
                <div class="form-group my-1">
                    <label for="lastname">Votre nom</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname">
                    
                </div>
                <div class="form-group my-1">
                    <label for="Email">Votre email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" required>
                </div>
                <div class="form-group my-1">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-group my-1">
                    <label for="confirm-password">Confirmez votre mot de passe</label>
                    <input type="password" class="form-control" name="confirm-password" id="confirm-password" required>
                </div>
                <div class="form-check my-1">
                    <input type="checkbox" class="form-check-input" id="cgu" name="cgu" required>
                    <label class="cgu" for="exampleCheck1">J'ai lu et j'accepte les conditions d'utilisation</label>
                </div>
                <div>
                    <small class="text-danger" id="helper">&ensp;</small>
                </div>
                <div class="d-grid">
                    <button id="submit-button" type="submit" class="btn btn-info my-1 btn-block disabled">Créer mon compte</button>
                </div>
            </form>
        </div>    
    </div>
</div>
<script type="module" src="Client/public/js/createAccount.js"></script>