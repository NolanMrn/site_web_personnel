window.onload = function() {
  const overlay = document.querySelector('.photo_acc article');
  const header = document.querySelector('header');
  const filtre = document.querySelector(".filtre");
  if(filtre) {
    filtre.classList.add("anim_section");
  }
  if (window.location.pathname.includes("galerie") && localStorage.getItem("alreadyAnimated") === "true") {
    header.style.transition = "0s";
    header.style.opacity = 1;
    header.style.transform = 'translateY(0)';
    filtre.classList.remove("anim_section");
  } else {
    header.style.transition = "1.5s";
    if (overlay) {
      overlay.style.opacity = 1;
      overlay.style.transform = 'scale(1)'; 
      setTimeout(() => {
          header.style.opacity = 1;
          header.style.transform = 'translateY(0)';
      }, 800);
    } else {
      setTimeout(() => {
          header.style.opacity = 1;
          header.style.transform = 'translateY(0)';
      }, 400);
    }
    if (window.location.pathname.includes("galerie")) {
      localStorage.setItem("alreadyAnimated", "true");
    } else {
      localStorage.setItem("alreadyAnimated", "false");
    }
  }
}

const animSections = document.querySelectorAll('.anim_section');

function showSections() {
  animSections.forEach(section => {
    const rect = section.getBoundingClientRect();
    if (rect.top < window.innerHeight - 100) {
      section.classList.add('visible');
    }
  });
}

window.addEventListener('scroll', showSections);
window.addEventListener('load', showSections);


document.querySelectorAll('.anim-link').forEach(a => {
  a.addEventListener('click', (e) => {
    e.preventDefault();
    const url = a.href;

    const articles = document.querySelectorAll('.unLieu');
    articles.forEach(lieu =>{
      if (lieu) {
        lieu.classList.add('fadeout');
      }
    })

    setTimeout(() => {
      window.location.href = url;
    }, 500);
  });
});