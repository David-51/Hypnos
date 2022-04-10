import { VerifyMail, VerifyName, VerifyPassword, VerifySelect } from "./fieldsVerification.js";
import getToForm from "./getToForm.js";
import redirectFromParameters from "./redirectFromParameter.js";
import removeFadeOut from "./removeFadeOut.js"

export default function adminManager(){
    
    const addManager = document.getElementById('add-managers');
    const editManager = document.getElementById('managers-list');
    const passwordField = document.getElementById('password-field');
    const confirmPasswordField = document.getElementById('confirm-password-field');
    
    const modal = new bootstrap.Modal(document.getElementById('modal'));
    const form = document.getElementById('form-crud')
    const helper = document.getElementById('helper');
    
    const modalTitle = document.getElementById('modal-title');
    const modalSubmitButton = document.getElementById('modal-submit-button');    
    let targetAction;
    let targetId;

    /**
     * 
     * @param {array} array fields to toggle state
     * @param {bool} state set the state 
     */
    function disableFormFields(array, state){
        if(state === true){
            array.forEach(element => {                  
                form[element].setAttribute('disabled','')
            });  
        }
        else{
            array.forEach(element => {                  
                form[element].removeAttribute('disabled')
            });  
        }

    }

    // Button Add 
    addManager.addEventListener('click', (event) => {
        event.preventDefault();
        passwordField.style.display = 'block'; 
        confirmPasswordField.style.display = 'block'; 
        //enable form fields
        disableFormFields(['firstname', 'lastname', 'establishment', 'email', 'password', 'confirm-password'], false);

        modalSubmitButton.classList.remove('btn-danger');
        modalSubmitButton.classList.add('btn-info');

        modalSubmitButton.classList.add('disabled');

        form.reset();
        targetId = "";
        targetAction = "add";
        modalTitle.textContent = "Ajouter un gérant";
        modalSubmitButton.textContent = "Ajouter";
        modal.show();
    })

    // detect id and action
    editManager.addEventListener('click', (event) => {        
        event.preventDefault();
        disableFormFields(['firstname', 'lastname', 'establishment', 'email', 'password', 'confirm-password'], false);
        
        passwordField.style.display = 'none'; 
        confirmPasswordField.style.display = 'none'; 

        modalSubmitButton.classList.remove('btn-danger');
        modalSubmitButton.classList.add('btn-info');

        modalSubmitButton.classList.add('disabled');
        const regex = new RegExp(/(edit|delete)-(.*)/);                  
        const eventId = regex.exec(event.target.id);
        const eventParentId = regex.exec(event.target.parentNode.id);
        

        if(eventId || eventParentId){
                if(eventId !== null){
                targetAction = eventId[1];
                targetId = eventId[2]
                form.id.value = targetId;
    
            }
            if(eventParentId !== null){
                targetAction = eventParentId[1];
                targetId = eventParentId[2]                        
                form.id.value = targetId;
            }
            const request = "/api/manager?id="+targetId;  
            
            if(targetAction === 'edit'){
                modalSubmitButton.textContent = 'Modifier';
                modalTitle.textContent = "Modifier un gérant"                                
            }
            else{
                modalSubmitButton.textContent = 'Supprimer';
                modalSubmitButton.classList.remove('btn-info');
                modalSubmitButton.classList.add('btn-danger');

                disableFormFields(['firstname', 'lastname', 'establishment', 'email', 'password', 'confirm-password'], true);
                modalSubmitButton.classList.remove('disabled');                                

                modalTitle.textContent = "Confirmer la suppression"
            }
            
            // getToForm(request, form, ['firstname', 'lastname', 'establishment', 'email'], modal.show());
            fetch(request)
            .then((response) => {
                if(response.status !==200){
                    return console.log('Something goes wrong...');
                }
                else{            
                    return response.json();
                }
            })
            .then((datas) => {        
                form.firstname.value = datas.firstname;
                form.lastname.value = datas.lastname;
                form.email.value = datas.email;
                form.establishment.value = datas.establishment_id;

                modal.show();
            })
        }

        // Submit Gestion
    })
    modalSubmitButton.addEventListener('click', (event) => {
        event.preventDefault();
        const formData = new FormData(form);        
        
        if(targetAction === 'edit'){
            const request = "/api/manager/update";
            
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then((response) => {
                if(response.status === 200){
                    response.json()
                    .then((datas) => {                        
                        document.getElementById(`firstname-${targetId}`).textContent = datas.firstname;
                        document.getElementById(`lastname-${targetId}`).textContent = datas.lastname.toUpperCase();
                        document.getElementById(`establishment-${targetId}`).textContent = datas.name;
                        document.getElementById(`email-${targetId}`).textContent = datas.email;
                    })
                }
                else{
                    console.error(response.status);
                }
            })
            // .then((datas) => {                
            //     document.getElementById(`firstname-${targetId}`).textContent = datas.firstname;
            //     document.getElementById(`lastname-${targetId}`).textContent = datas.lastname;
            //     document.getElementById(`establishment-${targetId}`).textContent = datas.establishment;
            //     document.getElementById(`email-${targetId}`).textContent = datas.email;
            // })
            .catch((error) => console.error(error))
            
        }else if(targetAction === "delete"){            
            const request = "/api/manager/delete";
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then((response) => {
                const cardId = 'card-'+targetId;
                removeFadeOut(document.getElementById(cardId), 1500);
                
            })           
            .catch((error) => console.log(error))
        }else if(targetAction === "add"){
            const request = "/api/manager/add";
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then((response) => {
                console.log(response.status);
                if(response.status === 201){
                    const validation = document.getElementById('validation').classList.add('light-off');  
                    const check = document.getElementById('check').classList.add('check-in');                               
                    setTimeout(()=>{                       
                    redirectFromParameters('./admin/managers')                                                                        
                    },2000);
                }
            })
            .catch((error) => console.log('error'+ error.status))
            
        }                              
    }) 

    // valid fields
    form.addEventListener('input', () => {         
        // submit button is disabled by default      
        if(targetId === 'add'){
            if(VerifyName('firstname') 
                && VerifyName('lastname') 
                && VerifyMail('email') 
                && VerifySelect('establishment') 
                && VerifyPassword('password')
                && VerifyPassword('confirm-password')){
                    modalSubmitButton.classList.remove('disabled');            
            }
        }else{
            if(VerifyName('firstname') 
                && VerifyName('lastname') 
                && VerifyMail('email') 
                && VerifySelect('establishment')){
                    modalSubmitButton.classList.remove('disabled');            
            }

        }    
    }) 
}

adminManager();