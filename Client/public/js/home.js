const formDestination = document.getElementById('form-destination');

formDestination.addEventListener('submit', (event) => {
    event.preventDefault();    
    document.location.href = '/establishments/suites?id='+formDestination.destination.value;
})