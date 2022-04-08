import { VerifyDate, VerifySelect} from "./fieldsVerification.js";
import redirectFromParameters from "./redirectFromParameter.js";

export default function booking(){    
    const helper = document.getElementById('helper');
    const form = document.getElementById('booking');
    const submitButton = document.getElementById('submit-button');    
    const selectSuites = document.getElementById('suites');
    const selectEstablishment = document.getElementById('establishment');
    const dynamicItems = document.getElementsByClassName('dynamic-item');

    // if suites in url
    const preselect = (new URL(document.location)).searchParams.get('suites')    
    if(preselect){                
        
        const request = '/api/suites?id='+preselect
        fetch(request)
        .then((response) => {
            if(response.status === 200) {
                response.json()
                .then(data => {
                    form.establishment.value = data.establishment_id;
                    
                    const option = document.createElement('option');
                    option.setAttribute('value', data.id);
                    option.innerText = data.title;
                    option.classList.add('dynamic-item');
                    selectSuites.appendChild(option);
                    form.suites.value = data.id;
                })
            }
        })
    }
    selectEstablishment.addEventListener('change', (event) => {
        console.log(event.target.value)
        if(event.target.value){
            const formData = new FormData(form);
            const request = '/api/establishment/suites?id='+event.target.value;
            fetch(request,{
                method: "POST",
                body: formData
            })
            .then((response) => {
                if(response.status === 200){
                    response.json()
                    .then((data) => {
                        Array.from(dynamicItems).forEach(element => {
                            element.remove();
                        })
                        data.forEach(element => {
                            const option = document.createElement('option');
                            option.setAttribute('value', element.id);
                            option.innerText = element.title;
                            option.classList.add('dynamic-item');
                            selectSuites.appendChild(option);
                        });
                        console.log(data)
                    })
                }
                else{
                    helper.textContent = "Une erreur est survenue, veuillez réessayer...";
                }
            })

        }
    })
    document.getElementById('checkin').addEventListener('change', (event) => {
        // console.log(event.target.value)
    })
    
    form.addEventListener('input', () => {         
        
        // submit button is disabled by default      
        submitButton.classList.add('disabled');

        if(VerifySelect('establishment')
            && VerifySelect('suites')
            && VerifyDate('checkin', 'checkout', helper)){
                submitButton.classList.remove('disabled');            
        }        
    }) 

    form.addEventListener('submit', (event) => {
        event.preventDefault();

       const formData = new FormData(form);       

       fetch('/api/booking', {
           method: "POST",
           body: formData
       })
       .then((response) => {
            if(response.status === 201){
                
                const validation = document.getElementById('validation').classList.add('light-off');  
                const check = document.getElementById('check').classList.add('check-in');
                setTimeout(()=>{
                    redirectFromParameters('./bookings/list')
                },3000);
            }
            else if(response.status === 202){
                response.json()
                .then(data => {
                    if(data === 'notempty'){
                        helper.textContent = "Désolé, ces dates sont indisponibles, veuillez en choisir d'autres"
                    }
                })
            }
            else{
                console.log(response.status);
                // inclure disponibilité des dates
                helper.textContent = "Une erreur s'est produite ... Veuillez réessayer plus tard."
                response.json()
                .then(data => console.log(data));                
            }
       })
       .catch(error => console.log(error));
    })    
}

booking();