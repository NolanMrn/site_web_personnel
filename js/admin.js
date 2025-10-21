function initSection(div) {
    const btnOrientation = div.querySelectorAll('.btn-orientation');
    const inputOrdre = div.querySelector('.ordre');
    const btnRetour = div.querySelector('.btn-retour');
    let ordre = [];

    btnOrientation.forEach(btn => {
        btn.addEventListener('click', () => {
            const typeOrientation = btn.dataset.orientation;
            ordre.push(typeOrientation);
            let res = '';
            for (let i = 0 ; i < ordre.length ; i++) {
                res += (i + 1) + '.' + ordre[i];
                if (i < ordre.length - 1) {
                    res += ' / ';
                }
            }
            inputOrdre.value = res;
        });
    });

    btnRetour.addEventListener('click', () => {
        ordre.pop();
        let res = '';
        for (let i = 0 ; i < ordre.length ; i++) {
            res += (i + 1) + '.' + ordre[i];
            if (i < ordre.length - 1) {
                res += ' / ';
            }
        }
        inputOrdre.value = res;
    });
}


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
    initSection(nouvelleSection);
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
    nbSectionsInput.value = nbSection;
    }
});