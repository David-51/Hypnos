export default function removeFadeOut( el, speed ) {
    
    const elHeight = el.offsetHeight;
    const seconds = speed/2000;
    el.style.overflow = 'hidden';
    el.style.transition = "opacity "+seconds+"s ease";
    el.style.opacity = 0;
    
    setTimeout(function() {
        el.style.height = elHeight+16+'px';
        el.style.margin = '0px';
        el.style.padding = '0px';
        el.style.transition = "max-height "+seconds+"s ease";
        el.style.maxHeight = '0px';
        setTimeout(function(){
            el.parentNode.removeChild(el);
        },speed/2)
    }, speed/2)
}