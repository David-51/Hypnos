/**
 * 
 * @param {string} request the request to fetch
 * @param {Element.form} form the document.element.form to update
 * @param {array} array the parameters to fetch and update
 * @param {function} callback a function modal.show for example.
 * @returns 
 */
 export default function getToForm(request, form, array, callback){
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
        array.forEach(element => {    
            
            if(element !== 'undefined'){
                form[element].value = datas[element];
            } 
        });                
        callback;
    })
}