// SCROOL FLUID
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// CHANGER APPARENCE
const toggleTheme = document.getElementById('toggleTheme');
toggleTheme.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
});

// FERME LE BUTTON TOGGLE APRES CLIQUE
document.addEventListener("DOMContentLoaded", function () {
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector("#navbarNav");

    document.querySelectorAll("#navbarNav a").forEach(link => {
        link.addEventListener("click", () => {
            if (navbarNav.classList.contains("show")) {
                navbarToggler.click(); // Simule un clic sur le bouton pour fermer le menu
            }
        });
    });
});


// BOUTON POUR SCROOLER TOUT EN HAUT
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}


