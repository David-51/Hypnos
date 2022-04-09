import removeFadeOut from "./removeFadeOut.js";

export default function adminMessages(){
    
    const messages = document.getElementById('messages-list');

    messages.addEventListener('click', (event) => {
        event.preventDefault();
        const regex = new RegExp(/(done|delete|undone)-(.*)/);
                          
        const eventId = regex.exec(event.target.id);
        const eventParentId = regex.exec(event.target.parentNode.id);
        
        let targetAction;
        let targetId;
        
        if(eventId !== null){
            targetAction = eventId[1];
            targetId = eventId[2];
        }
        else if(eventParentId !== null){
            targetAction = eventParentId[1];
            targetId = eventParentId[2];
        }
        
        const cardId = 'card-'+targetId;
        const card = document.getElementById(cardId);
        const formData = new FormData;
        formData.append('id', targetId);
    
        if(targetAction === 'done' || targetAction === 'undone'){
            const request = '/api/messages/done';
            const statusMessage = targetAction === 'done' ? 1 : 0;
            formData.append('done', statusMessage);
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then((response) => {
                if(response.status === 200){   
                    const prefixId = targetAction === 'done' ? 'undone' : 'done';
                    document.getElementById(targetAction+'-'+targetId).id = prefixId+'-'+targetId;
                    card.classList.toggle('card-done');
                }
            })
            .catch(error => console.error(error));
        }
        if(targetAction === 'delete'){        
            const request = '/api/messages/delete';
            fetch(request, {
                method: "POST",
                body: formData
            })
            .then((response) => {
                if(response.status === 200){
                    removeFadeOut(document.getElementById('card-'+targetId), 1000);                    
                }                
            })
            .catch((error) => console.error('delete error'))
        }
    })
}

adminMessages();