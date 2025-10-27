const filtresActifs = {
    categorie: null,
    pays: null,
    annee: null
};

function ajusterNbArticle() {
    const conteneur = document.querySelector(".explos_photos");
    const ancienArticleVide = conteneur.querySelectorAll(".articleVide")
    ancienArticleVide.forEach(p => {
        p.remove();
    });
    const tousLesLieux = conteneur.querySelectorAll(".unLieu");
    const tableauLieux = Array.from(tousLesLieux);
    const lieuxVisibles = tableauLieux.filter(lieu => lieu.style.display !== "none");
    const visibles = lieuxVisibles.length;
    const reste = visibles % 3;
    let nbAjouter = 0;
    if (reste !== 0) {
        nbAjouter = 3 - reste;
    }
    for (let i = 0; i < nbAjouter; i++) {
        const article = document.createElement("article");
        article.classList.add("articleVide");
        article.style.backgroundColor = "#222222";
        conteneur.appendChild(article);
    }
}

const boutonsFiltre = document.querySelectorAll(".btn_filtre");
boutonsFiltre.forEach(btn => {
    btn.addEventListener("click", () => {
        btn.classList.add("active-click");
        setTimeout(() => btn.classList.remove("active-click"), 300);

        const filtreChoisi = btn.id;
        const lstLieux = document.querySelectorAll(".unLieu");
        const parentArticle = btn.closest("article");
        let typeFiltre = parentArticle.dataset.filtre;
        if (filtresActifs[typeFiltre] === filtreChoisi) {
            filtresActifs[typeFiltre] = null;
        } else {
            filtresActifs[typeFiltre] = filtreChoisi;
        }
        lstLieux.forEach(lieu => {
            lieu.classList.add("hidden");
        });
        setTimeout(() => {
            lstLieux.forEach(lieu => {
                const categorie = lieu.dataset.categorie;
                const pays = lieu.dataset.pays;
                const annee = lieu.dataset.annee;
                let estVisible = true;
                if (filtresActifs.categorie && filtresActifs.categorie !== categorie) {
                    estVisible = false;
                }
                if (filtresActifs.pays && filtresActifs.pays !== pays) {
                    estVisible = false;
                }
                if (filtresActifs.annee && filtresActifs.annee !== annee) {
                    estVisible = false;
                }
                    if (estVisible) {
                    lieu.style.display = "block";
                } else {  
                    lieu.style.display = "none";
                }
            });
            ajusterNbArticle();
            setTimeout(() => {
                lstLieux.forEach(lieu => {
                    if (lieu.style.display === "block") {
                            lieu.classList.remove("hidden");
                    }
                });
            }, 50);
        }, 300);
        boutonsFiltre.forEach(b => {
            let actif = false;
            for (const valeur of Object.values(filtresActifs)) {
                if (valeur === b.id) {
                    actif = true;
                    break;
                }
            }
            if (actif) {
                b.style.backgroundColor = "#222222";
            } else {
                b.style.backgroundColor = "";
            }
        });
    })
});

