export default function deletePicture(event){
    const pictureRegex = new RegExp(/(delete)-(.*)/);  
    const pictureId = pictureRegex.exec(event.target.id);  
    
    const pictureIdToDelete = pictureId[2];

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
}