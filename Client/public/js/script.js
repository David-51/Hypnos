let hamburgerMenu = document.getElementById('hamburgerMenu');
let shutter = document.getElementById('shutter');

hamburgerMenu.addEventListener('click', () => {
    shutter.classList.toggle('displaybar');
})

shutter.addEventListener('click', () => {
    shutter.classList.toggle('displaybar');
})

// resolve vh problems with mobile navigators
function appHeight(){
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

window.addEventListener('resize', appHeight);
appHeight();
