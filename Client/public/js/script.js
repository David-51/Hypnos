let hamburgerMenu = document.getElementById('hamburgerMenu');
let shutter = document.getElementById('shutter');


hamburgerMenu.addEventListener('click', () => {
    shutter.classList.toggle('displaybar');
})

shutter.addEventListener('click', () => {
    shutter.classList.toggle('displaybar');
})

// getting a vh unit from the 100% windows
let vh = window.innerHeight * 0.01;

const mainContent = document.getElementById('mainContent');
mainContent.style.setProperty('--vh', `${vh}px`);