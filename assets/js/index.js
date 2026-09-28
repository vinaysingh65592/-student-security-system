// For the Navbar OnScroll Color Change 

const nav = document.querySelector('nav');
const header = document.querySelector('header');

const options = {

}

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            nav.classList.remove('changeColor')
        }
        else {
            nav.classList.add('changeColor')
        }
    })
}, options)

observer.observe(header)

$(document).ready(function() {
    /*
    var defaults = {
    containerID: 'toTop', // fading element id
    containerHoverID: 'toTopHover', // fading element hover id
    scrollSpeed: 1200,
    easingType: 'linear' 
    };
    */
$().UItoTop({ easingType: 'easeOutQuart' });
});