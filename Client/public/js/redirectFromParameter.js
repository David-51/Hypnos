/**
 * 
 * @param {string} newUrl is the target URL
 * redirect from to ./newUrl from parameters ?redirect=newUrl
 */
export default function redirectFromParameters(newUrl){
    
    const redirect = (new URL(document.location)).searchParams.get('redirect');
    const suites = (new URL(document.location)).searchParams.get('suites')
    let url;
    if(redirect !== null && redirect !== ''){
        url = newUrl+redirect;
        
        if(suites !== null && suites !== ''){
            url = url+'?suites='+suites
        }
    }
    else{
        url = newUrl;
    }
    document.location.href = url
}
