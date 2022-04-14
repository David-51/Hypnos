export function VerifyName(div){     
    const firstname = document.getElementById(div);
        const regex = new RegExp(/[A-z0-9éâêèàù'\s]+/);
        return regex.test(firstname.value);
}

export function VerifyMail(div){ 
    const mail = document.getElementById(div);
    const regex = new RegExp(/[\w+-?]+@[a-zA-Z_]{2,}?\.[a-zA-Z]{2,6}/);
    return regex.test(mail.value);           
    
}

export function VerifyPassword(div){    
    const password = document.getElementById(div);    
    const test0 = new RegExp(/.{8,}/);
    const test1 = new RegExp(/[^A-z]{1,}/);
    const test2 = new RegExp(/[a-z]{1,}/);
    const test3 = new RegExp(/[A-Z]{1,}/);
    const test4 = new RegExp(/[0-9]{1,}/);

    const result0 = test0.test(password.value);
    const result1 = test1.test(password.value);
    const result2 = test2.test(password.value);
    const result3 = test3.test(password.value);
    const result4 = test4.test(password.value);

    const result = result0 && result1 && result2 && result3 && result4;

        return result;    
}

export function VerifySelect(div){
    const select = document.getElementById(div);
    return select.selectedIndex !== 0 ? true : false;
}

export function VerifyLink(div){
    const link = document.getElementById(div);
    const regex = new RegExp(/^http[s]?:\/\/[A-z0-9-]+\.[A-z0-9-]{3,}[.\w+0-9-\?\&=%]*$/);
    return regex.test(link.value);           
}
export function VerifyNumber(div){
    const number = document.getElementById(div);
    const regex = new RegExp(/^[0-9]+\.?[0-9]*$/);
    return regex.test(number.value);           
}

export function VerifyTextarea(div){
    return (document.getElementById(div).value !== (null || '') ? true : false);
}
/**
 * 
 * @param {String} checkin 
 * @param {String} checkout 
 * @param {HTMLElement} helper 
 * @returns 
 */
export function VerifyDate(checkin, checkout, helper){
    // const helper = document.getElementById(helperId);
    helper.textContent = '';
    const check_in = new Date(document.getElementById(checkin).value);
    const check_out = new Date(document.getElementById(checkout).value);
    const now = new Date();

    if(check_in < now){
        helper.textContent = 'Votre date d\'arrivée doit être supérieur à la date du jour';
    }
    if(check_out <= check_in){
        helper.textContent = 'Votre date de départ doit être supérieur à votre date d\'arrivée';
    }
    if(check_in > now && check_out > check_in){
        return true
    }
    else{
        return false;
    }
}