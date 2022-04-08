const modal = new bootstrap.Modal(document.getElementById('modal'));

const bookingsForms = document.getElementsByClassName('booking-form');
const btnAnnnulation = document.getElementsByClassName('btn-annulation');
const btnConfirmation = document.getElementById('confirmation')
const btnAnnulation = document.getElementById('annulation')

Array.from(bookingsForms).forEach(element => element.addEventListener('submit', (event) => {
    event.preventDefault();
    console.log(event.target);
    modal.show();

}))