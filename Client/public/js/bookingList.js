import removeFadeOut from "./removeFadeOut.js";

const modal = new bootstrap.Modal(document.getElementById('modal'));

const bookingsList = document.getElementById('booking-list');
const btnAnnulation = document.getElementById('annulation');
const form = document.getElementById('form-modal');
const helper = document.getElementById('helper');

bookingsList.addEventListener('click', (event) => {
    helper.textContent ='';
    event.preventDefault();
    const regex = new RegExp(/(annulation)-(.*)/);
    if(regex.test(event.target.id)){
        modal.show();
        form.id.value = (regex.exec(event.target.id))[2]
    }
})
btnAnnulation.addEventListener('click', () => {
    modal.hide();
})

form.addEventListener('click', (event) => {
    event.preventDefault();
    const FD = new FormData(form);
    const request = '/api/booking/delete';
    fetch(request, {
        method: "POST",
        body: FD
    })
    .then((response) => {
        if(response.status === 200){
            response.json()
            .then(data => {
                if(data !== 'deleted'){                    
                    helper.textContent = 'Impossible d\'annuler, veuillez contacter l\'hôtel';
                    setTimeout(()=> {
                        modal.hide()
                    }, 3000)
                }
                else{                    
                    const deleteTarget = document.getElementById('booking-'+form.id.value);
                    removeFadeOut(deleteTarget, 1500);
                    modal.hide();
                }
            })            
        }
        else{            
            helper.textContent = 'une erreur s\'est produite, veuillez contacter l\'hôtel';            
        }
    })
    .catch(error => console.error(error))
})