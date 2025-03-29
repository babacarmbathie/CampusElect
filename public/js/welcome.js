// Initialisation AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out-quad',
    once: true
});

// Effet de rétrécissement de la navbar au scroll
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('mainNav');
    if (window.scrollY > 50) {
        navbar.style.padding = '10px 0';
        navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
    } else {
        navbar.style.padding = '15px 0';
        navbar.style.boxShadow = 'none';
    }
}); 