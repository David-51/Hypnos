import { VerifyMail, VerifyPassword } from "./fieldsVerification.js";
import redirectFromParameters from "./redirectFromParameter.js";

export default function connexion(){    
    

    const helper = document.getElementById('helper');
    const form = document.getElementById('connexion');
    const submitButton = document.getElementById('submit-button');

    form.addEventListener('input', () => {         
        // submit button is disabled by default      
        submitButton.classList.add('disabled');

        if(VerifyMail('email') && VerifyPassword('password')){
                submitButton.classList.remove('disabled');            
        }        
    }) 

    form.addEventListener('submit', (event) => {
        event.preventDefault();

       const formData = new FormData(form);       

       fetch('/api/login', {
           method: "POST",
           body: formData
       })
       .then((response) => {

            switch (response.status){
                case 200:
                    const validation = document.getElementById('validation').classList.add('light-off');  
                    const check = document.getElementById('check').classList.add('check-in');                    
                    setTimeout(()=>{                       
                    redirectFromParameters('./')                                                
                        
                    },3000);
                    break;
                case 403:
                    helper.textContent = "Identifiant ou mot de passe incorrect";
                    break;
                default:
                    helper.textContent = "Une erreur s'est produite, réessayez plus tard..."
            }            
       })
                   
    })
}

connexion();