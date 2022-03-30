// toggle Hamburger Menu

hamburgerMenu = document.getElementById('hamburgerMenu');
shutter = document.getElementById('shutter');

hamburgerMenu.addEventListener('click', () => {
    shutter.classList.toggle('displaybar');
})

shutter.addEventListener('click', () => {
    shutter.classList.toggle('displaybar');
})

