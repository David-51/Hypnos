<div class="row">
    <div class="col-12 text-center mt-1">        
        <h1>Envoyez un message</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-2">
        <form class="mx-4 col">
            <div class="form-group my-1">
                <label for="firstname">Votre prénom</label>
                <input type="text" class="form-control" id="firstname" aria-describedby="name" required>                
            </div>
            <div class="form-group my-1">
                <label for="lastname">Votre nom</label>
                <input type="text" class="form-control" id="lastname" aria-describedby="lastname" required>
                
            </div>
            <div class="form-group my-1">
                <label for="Email">Votre email</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" required>
            </div>            
            <div>
                <label for="subject">Sujet</label>
                <select class="form-select col me-1" aria-label="select-subject" id="subject">
                    <option selected>Choisissez le sujet</option>
                    <option value="information">Je souhaite en savoir plus sur une suite</option>
                    <option value="service">Je souhaite commander un service supplémentaire</option>
                    <option value="complaint">Je souhaite poser une réclamation</option>
                    <option value="application">J'ai un souci avec cette application</option>
                </select>
            </div>
            <div class="form-floating my-2">
                <textarea class="form-control p-1" placeholder="Ecrivez votre message ici" id="message" style="height: 150px"></textarea>
                <label for="message">Comments</label>
            </div>
            <div class="d-grid my-1">
                <button type="submit" class="btn btn-info my-1 btn-block">Submit</button>
            </div>
        </form>
    </div>    
</div>