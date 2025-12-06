const boutonFiltre = document.getElementById("btn-filtre");
const sectionFiltre = document.querySelector(".navFiltre");

if (boutonFiltre) {
    boutonFiltre.addEventListener("click", () => {
        if (sectionFiltre.classList.contains("active")) {
            sectionFiltre.style.height = sectionFiltre.scrollHeight + "px";
            requestAnimationFrame(() => {
                sectionFiltre.style.height = "0";
                sectionFiltre.classList.remove("active");
            });
        } else {
            sectionFiltre.classList.add("active");
            const height = sectionFiltre.scrollHeight + "px";
            sectionFiltre.style.height = "0";
            requestAnimationFrame(() => {
                sectionFiltre.style.height = height;
            });
            sectionFiltre.addEventListener("transitionend", () => {
                sectionFiltre.style.height = "auto";
            }, { once: true });
        }
    });
}


const telephone = document.querySelector('.telephone');
const remplissage = document.querySelector('.remplissage');

if (telephone) {
    function ajusterHauteur() {
        remplissage.style.height = `${telephone.offsetHeight + 75}px`;
    }

    window.addEventListener('load', ajusterHauteur);
    window.addEventListener('resize', ajusterHauteur);
}





const boutonMenu = document.getElementById("menu-btn");
const navMenu = document.querySelector(".navMenu");
const iconMenu = document.getElementById("menu-icon");

if (boutonMenu && navMenu && iconMenu) {
    boutonMenu.addEventListener("click", () => {

        iconMenu.src = iconMenu.src.includes("hamburger.png")
        ? "/img/accueil/annuler.png"
        : "/img/accueil/hamburger.png";

        if (navMenu.classList.contains("active")) {
            navMenu.style.height = navMenu.scrollHeight + "px";
            requestAnimationFrame(() => {
                navMenu.style.height = "0";
                navMenu.classList.remove("active");
            });
        } else {
            navMenu.classList.add("active");
            const height = navMenu.scrollHeight + "px";
            navMenu.style.height = "0";
            requestAnimationFrame(() => {
                navMenu.style.height = height;
            });
            navMenu.addEventListener("transitionend", () => {
                navMenu.style.height = "auto";
            }, { once: true });
        }
    });
}
