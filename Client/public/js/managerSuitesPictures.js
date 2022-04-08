import addMiniatureForm from "./addMiniatureForm.js";

export default function addPicture(){
    const addPicture = document.getElementById('addPicture');
    const formPicture = document.getElementById('form-picture')
    
    addPicture.addEventListener('change', ()=> {        

        const file = new FormData(formPicture);
        const datafile = file.get('addPicture');

        if(datafile.name !== ''){
            const request = '/api/pictures/add';
            fetch(request, {
                method: "POST",
                body: file
            })
            .then(response => response.json())
            .then((data) => {                
                let data_array = [data];
                addMiniatureForm(data_array);
            })
            
            .catch(error => console.log('error recording file'+error))
        }
    })
}