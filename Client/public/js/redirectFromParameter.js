/**
 * 
 * @param {string} newUrl is the target URL
 * redirect from to ./newUrl from parameters ?redirect=newUrl
 */
export default function redirectFromParameters(newUrl){
    
    let redirect = (new URL(document.location)).searchParams.get('redirect')    
    let url;
    if(redirect !== null && redirect !== ''){
        url = newUrl+redirect;
    }
    else{
        url = newUrl;
    }
    document.location.href = url
}
