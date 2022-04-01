import { VerifyMail, VerifyName, VerifyPassword } from "./fieldsVerification.js";

export default function createAccount(){
    const password = document.getElementById('password');
    const  confirmPassword = document.getElementById('confirm-password');
    const helper = document.getElementById('helper');
    const form = document.getElementById('create-account-form');    
    form.addEventListener('input', () => {               
        
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
                    document.getElementById('submit-button').classList.remove('disabled');
                }
                else{
                    helper.textContent = "vos mots de passe doivent correspondre"
                    document.getElementById('submit-button').classList.add('disabled');
                }
            }else{                    
                helper.textContent = "Vous devez accepter les CGU"
                document.getElementById('submit-button').classList.add('disabled');
            }                        
        }        
    }) 

    form.addEventListener('submit', () => {
        if(password.value !== confirmPassword.value){
            helper.textContent = "Vos mots de passe ne correspondent pas"
        }
        else{
            helper.textContent = '\u00a0'
        }
    })
    
    
}

createAccount();