export default function addPicture(){
    const addPicture = document.getElementById('addPicture');
    console.log('load');
    const formPicture = document.getElementById('form-picture')

    addPicture.addEventListener('change', ()=> {

        const file = new FormData(formPicture);
        if(file.get('addPicture')){
            const request = '/api/pictures/add';
            fetch(request, {
                method: "POST",
                body: file
            })
            .then((response) => {
                return response.text()                        
            })
            .then((text) => document.getElementById('debug').textContent = text)
        }
        else{
            console.log('non pas maintenant')
        }
    })
}

addPicture();