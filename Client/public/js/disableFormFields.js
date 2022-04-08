 /**
     * 
     * @param {array} array fields to toggle state
     * @param {bool} state set the state 
     */
  export default function disableFormFields(form, array, state){
    if(state === true){
        array.forEach(element => {                  
            form[element].setAttribute('disabled','')
        });  
    }
    else{
        array.forEach(element => {                  
            form[element].removeAttribute('disabled')
        });  
    }
}