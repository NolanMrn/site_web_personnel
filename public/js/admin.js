function initSection(div, id) {
    const btnOrientation = div.querySelectorAll('.btn-orientation');
    const inputOrdre = div.querySelector('.ordre');
    const btnRetour = div.querySelector('.btn-retour');

    let ordre = sections.get(id);
    if (!ordre) {
        const texteExistant = inputOrdre.value.trim();
        ordre = texteExistant
            ? texteExistant.split(' / ').map(s => s.split('.').slice(1).join('.'))
            : [];
        sections.set(id, ordre);
    }
    inputOrdre.value = ordre.map((val, i) => (i+1) + "." + val).join(" / ");

    btnOrientation.forEach(btn => {
        btn.addEventListener('click', () => {
            const nbPhotosInput = document.getElementById('nbPhotos');
            let nbPhotos = parseInt(nbPhotosInput.value, 10)
            const typeOrientation = btn.dataset.orientation;
            ordre.push(typeOrientation);
            sections.set(id, ordre);
            let res = '';
            for (let i = 0 ; i < ordre.length ; i++) {
                res += (i + 1) + '.' + ordre[i];
                if (i < ordre.length - 1) {
                    res += ' / ';
                }
            }
            inputOrdre.value = res;
            nbPhotos++;
            nbPhotosInput.value = nbPhotos;
        });
    });

    btnRetour.addEventListener('click', () => {
        const nbPhotosInput = document.getElementById('nbPhotos');
        let nbPhotos = parseInt(nbPhotosInput.value, 10)
        ordre.pop();
        sections.set(id, ordre);
        let res = '';
        for (let i = 0 ; i < ordre.length ; i++) {
            res += (i + 1) + '.' + ordre[i];
            if (i < ordre.length - 1) {
                res += ' / ';
            }
        }
        inputOrdre.value = res;
        if (nbPhotos > 0) {
            nbPhotos--;
            nbPhotosInput.value = nbPhotos;
        }
    });
}

document.querySelectorAll('.section').forEach(div => {
    const id = div.querySelector('.ordre').id;
    initSection(div, id);
});

const page = document.querySelector('.container');
let nbSection = parseInt(page.dataset.nbsections);
const nbSectionsInput = document.getElementById('nbSections');

const btnAjouterSection = document.querySelector('.btn-ajouter_section');

btnAjouterSection.addEventListener('click', () => {
    nbSection++;
    page.dataset.nbsections = nbSection;
    nbSectionsInput.value = nbSection;
    const nouvelleSection = document.createElement('div');
    nouvelleSection.classList.add('section', 'section' + nbSection);
    nouvelleSection.innerHTML = `
        <div class="form-group">
            <label for="paragraphe${nbSection}">Paragraphe n°${nbSection} :</label>
            <textarea id="paragraphe${nbSection}" name="paragraphe${nbSection}" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label>Images :</label>
            <div class="choix-orientation">
                <button type="button" class="btn-orientation" data-orientation="vertical">Vertical</button>
                <button type="button" class="btn-orientation" data-orientation="horizontal">Horizontal</button>
                <button type="button" class="btn-retour">Annuler la dernière image</button>
            </div>
        </div>
        <div class="form-group">
            <label for="ordre${nbSection}">Ordre :</label>
            <textarea id="ordre${nbSection}" name="ordre${nbSection}" class="ordre" rows="2" readonly></textarea>
        </div>
    `;
    const form = page.querySelector('form');
    form.insertBefore(nouvelleSection, btnAjouterSection.closest('.form-group'));
    initSection(nouvelleSection, `ordre${nbSection}`);
});


const btnSupprimerSection = document.querySelector('.btn-supprimer_section');

btnSupprimerSection.addEventListener('click', () => {
    if (nbSection > 0) {
        
        const derniereSection = document.querySelector('.section' + nbSection);
        if (derniereSection) {
            derniereSection.remove();
        }
    nbSection--;
    page.dataset.nbsections = nbSection;
    const nbPhotosInput = document.getElementById('nbPhotos');
    let nbPhotos = parseInt(nbPhotosInput.value, 10)
    const derniereClef = Array.from(sections.keys()).pop();
    const nbPhotoDerniereSection = sections.get(derniereClef).length;
    const nbPhotoApresSupp = nbPhotos - nbPhotoDerniereSection;
    nbPhotosInput.value = nbPhotoApresSupp;
    sections.delete(derniereClef);
    }
});


function nouveauPaysCategorie(select, container, idString) {
    select.addEventListener('change', function() {
        if (this.value === 'autre') {
            container.style.display = 'contents';
            document.getElementById(idString).required = true;
        } else {
            container.style.display = 'none';
            document.getElementById(idString).required = false;
            document.getElementById(idString).value = "";
        }
    });
}
const selectCategorie = document.getElementById('categorie');
const nouvelleCategorieContainer = document.getElementById('nouvelle_categorie_container');
const idStringCategorie = 'nouvelle_categorie';
if (selectCategorie && nouvelleCategorieContainer) {
    nouveauPaysCategorie(selectCategorie, nouvelleCategorieContainer, idStringCategorie);
}
const selectPays = document.getElementById('pays');
const nouveauPaysContainer = document.getElementById('nouveau_pays_container');
const idStringPays = 'nouveau_pays';
if (selectPays && nouveauPaysContainer) {
    nouveauPaysCategorie(selectPays, nouveauPaysContainer, idStringPays);
}


function validerFormulaire() {
    const dateExplo = document.getElementById('date_explo').value;
    if (!/^\d{4}-\d{2}$/.test(dateExplo)) {
        alert("Date invalide, utilisez AAAA/MM");
        return false;
    }
    const mois = parseInt(dateExplo.slice(5, 7), 10);
    if (mois < 1 || mois > 12) {
        alert("Mois invalide, utilisez les chiffres de 01 à 12");
        return false;
    }
    const numBanniere = parseInt(document.getElementById('num_banniere').value);
    let nbPhotoTotal = 0
    sections.forEach(valeurs => {
        nbPhotoTotal += valeurs.length;
    });
    if (numBanniere <= 0) {
        alert("Numéro de photo de bannière invalide, utilisé un numéro positif")
        return false;
    }
    if (nbPhotoTotal === 0) {
        alert("Veuillez mettre au moins une photo")
        return false;
    }
    if (numBanniere > nbPhotoTotal) {
        alert("Numéro de photo de bannière invalide, utilisé un numéro d'image qui existe (inférieur à " + (nbPhotoTotal + 1) + (")"))
        return false;
    }
    return true;
}