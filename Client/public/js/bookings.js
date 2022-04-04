import { VerifySelect} from "./fieldsVerification.js";
import redirectFromParameters from "./redirectFromParameter.js";

export default function sendMessages(){    
    const helper = document.getElementById('helper');
    const form = document.getElementById('booking');
    const submitButton = document.getElementById('submit-button');

    form.addEventListener('input', () => {         
        // submit button is disabled by default      
        submitButton.classList.add('disabled');

        if(VerifySelect('establishment')
            && VerifySelect('suites')){
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
                    redirectFromParameters('./')
                },3000);
            }
            else{
                helper.textContent = "Une erreur s'est produite ... Veuillez réessayer plus tard."
            }
       })
                   
    })
    
    
}

sendMessages();