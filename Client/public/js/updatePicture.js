export default function updatePicture(event){
    const pictureRegex = new RegExp(/(update)-(.*)/);
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
}