import { VerifyMail, VerifyName, VerifySelect, VerifyTextarea } from "./fieldsVerification.js";

export default function sendMessages(){    
    const helper = document.getElementById('helper');
    const form = document.getElementById('send-message');
    const submitButton = document.getElementById('submit-button');

    form.addEventListener('input', () => {         
        // submit button is disabled by default      
        submitButton.classList.add('disabled');

        if(VerifyName('firstname') 
            && VerifyName('lastname') 
            && VerifyMail('email')             
            && VerifySelect('subject')
            && VerifyTextarea('message')){
                submitButton.classList.remove('disabled');            
        }        
    }) 

    form.addEventListener('submit', (event) => {
        event.preventDefault();

       const formData = new FormData(form);       

       fetch('/api/send-message', {
           method: "POST",
           body: formData
       })
       .then((response) => {
            if(response.status === 201){
                const validation = document.getElementById('validation').classList.add('light-off');  
                const check = document.getElementById('check').classList.add('check-in');
                setTimeout(()=>{
                    document.location.href='/'
                },3000);
            }
            else{
                helper.textContent = "Une erreur s'est produite ... Veuillez réessayer plus tard."
            }
       })
                   
    })
    
    
}

sendMessages();