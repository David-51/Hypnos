import { VerifyMail, VerifyPassword } from "./fieldsVerification.js";
import redirectFromParameters from "./redirectFromParameter.js";

export default function connexion(){    
    

    const helper = document.getElementById('helper');
    const form = document.getElementById('connexion');
    const submitButton = document.getElementById('submit-button');
    const createAccount = document.getElementById('create-account');

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
    createAccount.addEventListener('click', (event) => {
        event.preventDefault();
        const redirect = (new URL(document.location)).searchParams.get('redirect');
        const suites = (new URL(document.location)).searchParams.get('suites')
        const newUrl = '/signin?redirect=';
        let url;
        
        if(redirect !== null && redirect !== ''){
            url = newUrl+redirect;
        
                if(suites !== null && suites !== ''){
                    url = url+'&suites='+suites
                }
        }
        else{
            url = newUrl;
        }
        document.location.href = url
    })

}

connexion();