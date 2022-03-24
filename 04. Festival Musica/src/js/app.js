const createLists = () => {
  for (let i = 1; i <= 2; i++) {
    const idRock = `#rock${i}`;
    const idEDM = `#edm${i}`;
    const rock1 = [
      '24:00 | <span>Metallica</span>',
      '22:00 | <span>Pearl Jam</span>',
      '20:00 | <span>KoRn</span>',
      '19:00 | <span>Muse</span>',
      '18:00 | <span>Breaking Benjamin</span>',
      '17:00 | <span>30 Seconds to Mars</span>',
    ];
    const rock2 = [
      '24:00 | <span>Red Hot Chili Peppers</span>',
      '22:00 | <span>The Killers</span>',
      '20:00 | <span>Deftones</span>',
      '19:00 | <span>Limp Bizkit</span>',
      '18:00 | <span>Papa Roach</span>',
      '17:00 | <span>Lamb of God</span>',
    ];
    const edm1 = [
      '24:00 | <span>Deadmau5</span>',
      '22:00 | <span>Tïesto</span>',
      '20:00 | <span>Hardwell</span>',
      '19:00 | <span>Dash Berlin</span>',
      '18:00 | <span>Fedde Legrand</span>',
      '17:00 | <span>Audien</span>',
    ];
    const edm2 = [
      '24:00 | <span>Paul Van Dyk</span>',
      '22:00 | <span>Armin Van Buuren</span>',
      '20:00 | <span>Above & Beyond</span>',
      '19:00 | <span>Eric Prdyz</span>',
      '18:00 | <span>Ferry Corsten</span>',
      '17:00 | <span>Vini Vici</span>',
    ];
    if (i === 1) {
      const listRock = document.querySelector(idRock);
      for (let j = 0; j < rock1.length; j++) {
        const li = document.createElement('li');
        li.innerHTML = rock1[j];
        listRock.appendChild(li);
      }
      const listEDM = document.querySelector(idEDM);
      for (let j = 0; j <edm1.length; j++) {
        const li = document.createElement('li');
        li.innerHTML = edm1[j];
        listEDM.appendChild(li);
      }
    } else {
      const listRock = document.querySelector(idRock);
      for (let j = 0; j < rock2.length; j++) {
        const li = document.createElement('li');
        li.innerHTML = rock2[j];
        listRock.appendChild(li);
      }
      const listEDM = document.querySelector(idEDM);
      for (let j = 0; j <edm2.length; j++) {
        const li = document.createElement('li');
        li.innerHTML = edm2[j];
        listEDM.appendChild(li);
      }
    }
  }
};

const createGallery = () => {
  const gallery = document.querySelector('.images-gallery');
  for (let i = 1; i <= 12; i++) {
    const img = document.createElement('picture');
    img.innerHTML = `
      <source srcset="build/img/thumb/${i}.avif" type="image/avif" />
      <source srcset="build/img/thumb/${i}.webp" type="image/webp" />
      <img 
        width="200" 
        height="300" 
        src="build/img/thumb/${i}.jpg" 
        alt="Imagen Galeria ${i}" 
        loading="lazy" 
      />
    `;
    gallery.appendChild(img);
  }
};

const initApp = () => {
  createLists();
  createGallery();
};

document.addEventListener('DOMContentLoaded', () => initApp());
