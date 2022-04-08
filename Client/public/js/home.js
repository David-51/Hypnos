const formDestination = document.getElementById('form-destination');

formDestination.addEventListener('submit', (event) => {
    event.preventDefault();
    console.log(formDestination.destination.value);
    document.location.href = '/establishments/suites?id='+formDestination.destination.value;
})