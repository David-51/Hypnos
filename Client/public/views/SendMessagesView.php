
<div class="row">
    <div class="col-12 text-center mt-1">        
        <h1>Envoyez un message</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-2">
        <form class="mx-4 col" id="send-message">
            <div class="form-group my-1">
                <label for="firstname">Votre prénom</label>
                <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="name" required>                
            </div>
            <div class="form-group my-1">
                <label for="lastname">Votre nom</label>
                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname" required>
                
            </div>
            <div class="form-group my-1">
                <label for="Email">Votre email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" required>
            </div>            
            <div>
                <label for="subject">Sujet</label>
                <select class="form-select col me-1" aria-label="select-subject" id="subject" name="subject" required>
                    <option selected>Choisissez le sujet</option>
                    <option value="information">Je souhaite en savoir plus sur une suite</option>
                    <option value="service">Je souhaite commander un service supplémentaire</option>
                    <option value="complaint">Je souhaite poser une réclamation</option>
                    <option value="application">J'ai un souci avec cette application</option>
                </select>
            </div>
            <div class="form-floating my-2">
                <textarea class="form-control p-1" placeholder="Ecrivez votre message ici" id="message" name="message" style="height: 150px"></textarea>
                <label for="message">Comments</label>
            </div>
            <small class="text-danger" id="helper">&ensp;</small>
            <div class="d-grid my-1">
                <button type="submit" class="btn btn-info my-1 btn-block disabled" id="submit-button">Submit</button>
            </div>
        </form>
    </div>    
</div>
<div id="validation" class="validation"></div>
<i id="check" class="fa-regular fa-circle-check check"></i>
<script type="module" src="Client/public/js/sendMessages.js"></script>