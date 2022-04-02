export function VerifyName(div){     
    const firstname = document.getElementById(div);
        const regex = new RegExp(/[a-zA-Z-\']{2,}\s?[a-zA-Z-\']*/);
        return regex.test(firstname.value);
}

export function VerifyMail(div){ 
    const mail = document.getElementById(div);
        const regex = new RegExp(/[\w+-?]+@[a-zA-Z_]{2,}?\.[a-zA-Z]{2,6}/);
        return regex.test(mail.value);           
    
}

export function VerifyPassword(div){    
    const password = document.getElementById(div);    
        const regex = new RegExp(/.{8,}/);
        return regex.test(password.value);    
}

export function VerifySelect(div){
    const select = document.getElementById(div);
    return select.selectedIndex !== 0 ? true : false;
}

export function VerifyTextarea(div){
    return (document.getElementById(div).value !== (null || '') ? true : false);
    
}