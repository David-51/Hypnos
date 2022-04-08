const modal = new bootstrap.Modal(document.getElementById('modal'));

const bookingsForms = document.getElementsByClassName('booking-form');

Array.from(bookingsForms).forEach(element => element.addEventListener('submit', (event) => {
    event.preventDefault;
    show.modal();
    
}))