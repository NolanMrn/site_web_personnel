const boutonFiltre = document.getElementById("btn-filtre");
const sectionFiltre = document.querySelector(".navFiltre");

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


const telephone = document.querySelector('.telephone');
const remplissage = document.querySelector('.remplissage');

function ajusterHauteur() {
    remplissage.style.height = `${telephone.offsetHeight + 75}px`;
}

window.addEventListener('load', ajusterHauteur);
window.addEventListener('resize', ajusterHauteur);