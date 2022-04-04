import { VerifyName, VerifyTextarea } from "./fieldsVerification.js";
import getToForm from "./getToForm.js";

export default function adminManager(){
    
    const addEstablishment = document.getElementById('add-establishment');
    const editEstablishment = document.getElementById('establishments-list')
    
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
    addEstablishment.addEventListener('click', (event) => {
        event.preventDefault();

        //enabme form fields
        disableFormFields(['name', 'city', 'adress', 'description'], false);

        modalSubmitButton.classList.remove('btn-danger');
        modalSubmitButton.classList.add('btn-info');

        modalSubmitButton.classList.add('disabled');

        form.reset();   
        modalTitle.textContent = "Ajouter un établissement";
        modalSubmitButton.textContent = "Ajouter";
        modal.show();
    })

    // detect id and action
    editEstablishment.addEventListener('click', (event) => {
        disableFormFields(['name', 'city', 'adress', 'description'], false);
        event.preventDefault();
        modalSubmitButton.classList.remove('btn-danger');
        modalSubmitButton.classList.add('btn-info');

        modalSubmitButton.classList.add('disabled');
        const regex = new RegExp(/(edit|delete)-(.*)/);                  
        const eventId = regex.exec(event.target.id);
        const eventParentId = regex.exec(event.target.parentNode.id);
        

        if(eventId || eventParentId){
            console.log('does somthing ...');
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
            const request = "/api/establishment?id="+targetId;            
            if(targetAction === 'edit'){
                modalSubmitButton.textContent = 'Modifier';
                modalTitle.textContent = "Modifier un établissement"                                
            }
            else{
                modalSubmitButton.textContent = 'Supprimer';
                modalSubmitButton.classList.remove('btn-info');
                modalSubmitButton.classList.add('btn-danger');

                disableFormFields(['name', 'city', 'adress', 'description'], true);
                modalSubmitButton.classList.remove('disabled');                                

                modalTitle.textContent = "Confirmer la suppression"
            }
            getToForm(request, form, ['name', 'city', 'adress', 'description'], modal.show()); 
        }

        // Submit Gestion
    })
    modalSubmitButton.addEventListener('click', (event) => {
        event.preventDefault();
        const formData = new FormData(form);        
        
        if(targetAction === 'edit'){
            const request = "/api/establishment/update";
            
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then((datas) => {                
                document.getElementById(`name-${targetId}`).textContent = datas.name;
                document.getElementById(`city-${targetId}`).textContent = datas.city;
                document.getElementById(`adress-${targetId}`).textContent = datas.adress;
                document.getElementById(`description-${targetId}`).textContent = datas.description;
            })
            .catch((error) => console.log(error))
            
        }else if(targetAction === "delete"){            
            const request = "/api/establishment/delete";
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then(response => response.json())            
            .catch((error) => console.log(error))
        }                            
    }) 

    // valid fields
    form.addEventListener('input', () => {         
        // submit button is disabled by default      
        
        if(VerifyName('name') 
            && VerifyName('city') 
            && VerifyTextarea('adress')            
            && VerifyTextarea('description')){
                modalSubmitButton.classList.remove('disabled');            
        }        
    }) 
}

adminManager();