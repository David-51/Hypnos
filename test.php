<form class="mx-4 col" id="send-message" spellcheck="false">
    <div class="form-group my-1">
        <label for="firstname">Votre prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="name" required>                
    </div>
    <div class="form-group my-1">
        <label for="lastname">Votre nom</label>
        <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname" required>
        
    </div>
    <div class="form-group my-1">
        <label for="email">Votre email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" required>
    </div>            
    <div>
        <label for="subject">Sujet</label>
        <select class="form-select col me-1" aria-label="select-subject" id="subject" name="subject" required>
            <option selected>Choisissez le sujet</option>
            <option value="Je souhaite en savoir plus sur une suite">Je souhaite en savoir plus sur une suite</option>
            <option value="Je souhaite commander un service supplémentaire">Je souhaite commander un service supplémentaire</option>
            <option value="Je souhaite poser une réclamation">Je souhaite poser une réclamation</option>
            <option value="J'ai un souci avec cette application">J'ai un souci avec cette application</option>
        </select>
    </div>
    <div class="form-floating my-2">
        <textarea class="form-control p-1" placeholder="Ecrivez votre message ici" id="message" name="message" style="height: 150px"></textarea>
        <label for="message">Comments</label>
    </div>
    <div class="helper">
        <small class="text-danger" id="helper"></small>
    </div>
    <div class="d-grid my-1">
        <button type="submit" class="btn btn-info my-1 btn-block disabled" id="submit-button">Submit</button>
    </div>
</form>