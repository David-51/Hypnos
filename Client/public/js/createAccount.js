import { VerifyMail, VerifyName, VerifyPassword } from "./fieldsVerification.js";

export default function createAccount(){
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');
    const helper = document.getElementById('helper');
    const form = document.getElementById('create-account-form');
    const submitButton = document.getElementById('submit-button');

    form.addEventListener('input', () => {         
        // submit button is disabled by default      
        submitButton.classList.add('disabled');

        if(VerifyName('firstname') 
            && VerifyName('lastname') 
            && VerifyMail('email') 
            && VerifyPassword('password') 
            && VerifyPassword('confirm-password')){

            if(document.getElementById('cgu').checked === true){
                helper.textContent = '\u00a0'
                document.getElementById('submit-button').classList.remove('disabled');

                if(password.value === confirmPassword.value){
                    helper.textContent = '\u00a0'
                    submitButton.classList.remove('disabled');
                }
                else{
                    helper.textContent = "vos mots de passe doivent correspondre"
                    submitButton.classList.add('disabled');
                }
            }else{                    
                helper.textContent = "Vous devez accepter les CGU"
                submitButton.classList.add('disabled');
            }                        
        }        
    }) 

    form.addEventListener('submit', (event) => {
        event.preventDefault();

       const formData = new FormData(form);
       fetch('/api/create-account', {
           method: "POST",
           body: formData
       })
       .then(function(response){
           console.log(response.text)
       })            
    })
    
    
}

createAccount();