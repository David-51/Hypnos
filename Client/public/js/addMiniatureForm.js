export default function addMiniatureForm(datasPictures){
    datasPictures.forEach(element => {
        const addPicture = document.getElementById('form-picture')
        const pictureTable = document.getElementById('pictures-table')
        const pictureForm = document.createElement('form');
        pictureForm.classList.add('col-auto', 'my-1', 'mx-1', 'picture-item', 'rounded', 'formUpdatePicture');
        pictureForm.id = 'form-'+element.id;
        pictureForm.enctype = "multipart/form-data";                        
        pictureTable.insertBefore(pictureForm, addPicture);

        // Delete Button
        const button = document.createElement('button');
        button.type = 'button';
        button.classList.add('btn-close', 'btn-close-white', 'picture-close', 'actionDeletePicture');
        button.ariaLabel = 'close';
        button.id = 'delete-'+element.id;
        pictureForm.appendChild(button);
        
        // input hidden with picture Id
        const inputPictureId = document.createElement('input');
        inputPictureId.type = 'hidden';
        inputPictureId.name = 'pictureId';
        inputPictureId.id = 'pictureId-'+element.id;
        inputPictureId.required =true;
        inputPictureId.value = element.id;
        pictureForm.appendChild(inputPictureId);

        // input hidden with suite Id
        const inputSuiteId = document.createElement('input');
        inputSuiteId.type = 'hidden';
        inputSuiteId.name = 'suiteId';
        inputSuiteId.id = 'suiteId-'+element.id;
        inputSuiteId.required =true;
        inputSuiteId.value = element.suite_id;
        pictureForm.appendChild(inputSuiteId);        

        // label
        const pictureLabel =document.createElement('label');
        pictureLabel.setAttribute('for', 'update-'+element.id);
        pictureLabel.classList.add('picture-label')
        pictureForm.appendChild(pictureLabel);

        //Image
        const pictureImg = document.createElement('img');
        pictureImg.src = element.picture_link;  
        pictureLabel.appendChild(pictureImg);     
        pictureImg.classList.add('rounded','miniature')
        pictureImg.id = 'updatePicture-'+element.id;

        // input hidden type file
        const pictureFile = document.createElement('input');
        pictureFile.type = 'file';
        pictureFile.name = 'updatePicture',
        pictureFile.id = 'update-'+element.id;
        pictureFile.classList.add('d-none');
        pictureForm.appendChild(pictureFile);
    });
}