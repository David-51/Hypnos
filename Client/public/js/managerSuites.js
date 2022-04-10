import addMiniatureForm from "./addMiniatureForm.js";
import disableFormFields from "./disableFormFields.js";
import { VerifyLink, VerifyName, VerifyNumber, VerifyTextarea } from "./fieldsVerification.js";
import addPicture from "./managerSuitesPictures.js";
import redirectFromParameters from "./redirectFromParameter.js";
import removeElementsByClass from "./removeElementByClass.js";
import removeFadeOut from "./removeFadeOut.js";

export default function managerSuites(){
    
    const addManager = document.getElementById('add-suites');
    const editManager = document.getElementById('suites-list');
    const pictureTable = document.getElementById('pictures-table');
    const picturesUpdateTable = document.getElementsByClassName('formUpdatePicture');
    const picturesDeleteTable = document.getElementsByClassName('actionDeletePicture');
    
    const modal = new bootstrap.Modal(document.getElementById('modal'));
    const form = document.getElementById('form-crud');
    const formFile = document.getElementById('form-picture');
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
        pictureTable.classList.add('d-none');
        modal.show();
    })

    // detect id and action
    editManager.addEventListener('click', (event) => {     
        event.preventDefault();
        pictureTable.classList.remove('d-none');
        removeElementsByClass('formUpdatePicture');

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
                formFile.idPicture.value = targetId;                    
            }
            if(eventParentId !== null){
                targetAction = eventParentId[1];
                targetId = eventParentId[2]                                 
                form.id.value = targetId;
                formFile.idPicture.value = targetId;                    
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
                        return console.error('Something goes wrong...');
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

                    addMiniatureForm(datas.pictures);
                    
                    // event UPDATE and Delete on Pictures
                    Array.from(picturesUpdateTable).forEach(element => element.addEventListener('change', (event) => {
                        
                        const pictureRegex = new RegExp(/(update|delete)-(.*)/);    
                        
                        const pictureData = pictureRegex.exec(event.target.id)
                        const pictureId = pictureData[2];

                        const pictureForm = document.getElementById('form-'+pictureId);
                        const pictureImg = document.getElementById('updatePicture-'+pictureId);
                        const updateForm = new FormData(pictureForm);
                        const request = '/api/pictures/update';
                        
                        fetch(request, {
                            method: "POST",
                            body: updateForm
                        })
                        .then((response) => {                            
                            return response.json()
                        })
                        .then((data) => {                            
                            pictureImg.src = data.picture_link;
                        })
                        .catch(error => console.error(error))
                    }))

                    // Cross to Delete Pictures
                    Array.from(picturesDeleteTable).forEach(element => element.addEventListener('click', (event) => {
                        const pictureRegex = new RegExp(/(delete)-(.*)/);                        
                        const pictureIdToDelete = (pictureRegex.exec(event.target.id))[2]
                        
                        const pictureForm = document.getElementById('form-'+pictureIdToDelete);
                        const deleteForm = new FormData(pictureForm);

                        const request = '/api/pictures/delete';

                        fetch(request, {
                            method: "POST",
                            body: deleteForm
                        })
                        .then((response)=> {                            
                            return response.json()
                        })
                        .then((data) => {
                            pictureForm.remove();                            
                        })
                        .catch(error => console.error(error))
                    }))                    
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
                    response.json().then(data => console.log(data));
                    // console.error('something goes wrong...');                    
                    }                    
                }
            )            
            .catch((error) => console.error(error))
            
        }else if(targetAction === "delete"){            
            const request = "/api/suites/delete";
            fetch(request, {
                method: "POST",
                body: formData
            })            
            .then((response) => {
                if(response.status === 200){
                    const cardId = 'card-'+targetId;                    
                    removeFadeOut(document.getElementById(cardId), 1500);
                }                                       
            })           
            .catch((error) => console.error('Somethings goes wrong...'))
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
            .catch((error) => console.error('error'+ error.status))
            
        }                              
    })

    

    //-----------------------

    // validation fields Event
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
addPicture();