import disableFormFields from "./disableFormFields.js";
import { VerifyLink, VerifyName, VerifyNumber, VerifyTextarea } from "./fieldsVerification.js";
// import getToForm from "./getToForm.js";
import redirectFromParameters from "./redirectFromParameter.js";
import removeFadeOut from "./removeFadeOut.js";

export default function managerSuites(){
    
    const addManager = document.getElementById('add-suites');
    const editManager = document.getElementById('suites-list');        
    
    const modal = new bootstrap.Modal(document.getElementById('modal'));
    const form = document.getElementById('form-crud');
    const helper = document.getElementById('helper');
    
    const modalTitle = document.getElementById('modal-title');
    const modalSubmitButton = document.getElementById('modal-submit-button');    
    let targetAction;
    let targetId;

    // Button Add 
    addManager.addEventListener('click', (event) => {
        event.preventDefault();
        
        //enable form fields
        disableFormFields(form, ['title', 'description', 'link_to_booking', 'price'], false);

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
        disableFormFields(form, ['title', 'description', 'link_to_booking', 'price'], false);                

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
            const request = "/api/suites?id="+targetId;  
            
            if(targetAction === 'edit'){
                modalSubmitButton.textContent = 'Modifier';
                modalTitle.textContent = "Modifier une suite"                                
            }
            else{
                modalSubmitButton.textContent = 'Supprimer';
                modalSubmitButton.classList.remove('btn-info');
                modalSubmitButton.classList.add('btn-danger');

                disableFormFields(form, ['title', 'description', 'link_to_booking', 'price'], true);
                modalSubmitButton.classList.remove('disabled');                                

                modalTitle.textContent = "Confirmer la suppression"
            }
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
                    form.title.value = datas.title;
                    form.description.value = datas.description;
                    form.price.value = datas.price/100;
                    form.link_to_booking.value = datas.link_to_booking;
                    modal.show();
                })


            // getToForm(request, form, ['title', 'description', 'link_to_booking', 'price'], modal.show());            
        }

        // Submit Gestion
    })
    modalSubmitButton.addEventListener('click', (event) => {
        event.preventDefault();
        const formData = new FormData(form);  
        // formData.set('price', formData.get('price')/100);

        if(targetAction === 'edit'){
            const request = "/api/suites/update";
            
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then((response) => {
                if(response.status === 201){    
                    console.log(response.status)                                    
                    response.json()
                    .then((datas) => {                        
                        document.getElementById(`title-${targetId}`).textContent = datas.title;
                        document.getElementById(`description-${targetId}`).textContent = datas.description;
                        document.getElementById(`link_to_booking-${targetId}`).href = datas.link_to_booking;                        
                        document.getElementById(`price-${targetId}`).textContent = datas.price/100;
                        if(datas.pictures[0] && datas.pictures[0].picture_link){
                            document.getElementById(`picture-${targetId}`).src = datas.pictures[0].picture_link;
                        }                
                    })
                }
                else{
                    console.log('something goes wrong...');
                    // return response.text()
                    // .then((text) => {
                    //     console.log(text);
                    //     document.getElementById('debug').textContent = text;
                    }                    
                }
            )            
            .catch((error) => console.log(error))
            
        }else if(targetAction === "delete"){            
            const request = "/api/suites/delete";
            fetch(request, {
                method: "POST",
                body: formData
            })            
            .then((response) => {
                if(response.status === 200){
                    const cardId = 'card-'+targetId;
                    // console.log(cardId);
                    removeFadeOut(document.getElementById(cardId), 1500);
                }
                else{
                    console.log(response.status);
                    console.log(response.text());
                }                
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
            && VerifyLink('link_to_booking') 
            && VerifyNumber('price')){
                modalSubmitButton.classList.remove('disabled');            
        }        
    }) 
}

managerSuites();