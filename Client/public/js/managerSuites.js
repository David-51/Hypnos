import disableFormFields from "./disableFormFields.js";
import { VerifyLink, VerifyName, VerifyNumber, VerifyTextarea } from "./fieldsVerification.js";
import getToForm from "./getToForm.js";
import redirectFromParameters from "./redirectFromParameter.js";

export default function managerSuites(){
    
    const addManager = document.getElementById('add-suites');
    const editManager = document.getElementById('suites-list');        
    
    const modal = new bootstrap.Modal(document.getElementById('modal'));
    const form = document.getElementById('form-crud')
    const helper = document.getElementById('helper');
    
    const modalTitle = document.getElementById('modal-title');
    const modalSubmitButton = document.getElementById('modal-submit-button');    
    let targetAction;
    let targetId;

    // Button Add 
    addManager.addEventListener('click', (event) => {
        event.preventDefault();
        
        //enable form fields
        disableFormFields(form, ['title', 'description', 'link', 'price'], false);

        modalSubmitButton.classList.remove('btn-danger');
        modalSubmitButton.classList.add('btn-info');

        modalSubmitButton.classList.add('disabled');

        form.reset();
        targetId = "";
        targetAction = "add";
        modalTitle.textContent = "Ajouter une suite";
        modalSubmitButton.textContent = "Ajouter";
        modal.show();
    })

    // detect id and action
    editManager.addEventListener('click', (event) => {        
        event.preventDefault();
        disableFormFields(form, ['title', 'description', 'link', 'price'], false);
        
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

                disableFormFields(form, ['title', 'description', 'link', 'price'], true);
                modalSubmitButton.classList.remove('disabled');                                

                modalTitle.textContent = "Confirmer la suppression"
            }
            getToForm(request, form, ['title', 'description', 'link', 'price'], modal.show());             
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
                if(response.status === 201){
                    response.json()
                    .then((datas) => {
                        console.log(targetId);
                        console.log(datas);
                        document.getElementById(`title-${targetId}`).textContent = datas.title;
                        document.getElementById(`description-${targetId}`).textContent = datas.description;
                        document.getElementById(`link-${targetId}`).textContent = datas.link;
                        document.getElementById(`email-${targetId}`).textContent = datas.email;
                    })
                }
            })
            // .then((datas) => {                
            //     document.getElementById(`firstname-${targetId}`).textContent = datas.firstname;
            //     document.getElementById(`lastname-${targetId}`).textContent = datas.lastname;
            //     document.getElementById(`establishment-${targetId}`).textContent = datas.establishment;
            //     document.getElementById(`email-${targetId}`).textContent = datas.email;
            // })
            .catch((error) => console.log(error))
            
        }else if(targetAction === "delete"){            
            const request = "/api/suites/delete";
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then((response) => {
                const cardId = 'card-'+targetId;

                document.getElementById(cardId).remove();
            })           
            .catch((error) => console.log(error))
        }else if(targetAction === "add"){
            const request = "/api/suites/add";
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then((response) => {
                if(response.status === 201){
                    const validation = document.getElementById('validation').classList.add('light-off');  
                    const check = document.getElementById('check').classList.add('check-in');                    
                    setTimeout(()=>{                       
                    redirectFromParameters('./manager')                                                                        
                    },2000);
                }
            })
            .catch((error) => console.log('error'+ error.status))
            
        }                              
    }) 

    // valid fields
    form.addEventListener('input', () => {         
        // submit button is disabled by default      
        if(VerifyName('title') 
            && VerifyTextarea('description') 
            && VerifyLink('link') 
            && VerifyNumber('price')){
                modalSubmitButton.classList.remove('disabled');            
        }        
    }) 
}

managerSuites();