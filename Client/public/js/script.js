let hamburgerMenu = document.getElementById('hamburgerMenu');
let shutter = document.getElementById('shutter');

hamburgerMenu.addEventListener('click', () => {
    shutter.classList.toggle('displaybar');
})

shutter.addEventListener('click', () => {
    shutter.classList.toggle('displaybar');
})