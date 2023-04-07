document.addEventListener("DOMContentLoaded", () => {
  eventListeners();
  darkMode();
});

// all event listeners
const eventListeners = () => {
  // to show or hidden mobile menu
  const mobileMenu = document.querySelector(".mobile-menu");
  mobileMenu.addEventListener("click", responsiveNavigation);
  // to show delete property pop up
  const deleteDivs = document.getElementsByClassName("open-delete") ?? null;
  if (deleteDivs) {
    for (let i = 0; i < deleteDivs.length; i++) {
      let arr = deleteDivs[i].id.split("-");
      let table = arr[2];
      let id = arr[3];
      deleteDivs[i].addEventListener(
        "click",
        () => changeDisplay(`#delete-confirmation-${table}-${id}`, "block"),
        false
      );
    }
  }
  // to hidde delete property pop up
  const keepButtons = document.getElementsByClassName("close-delete") ?? null;
  if (keepButtons) {
    for (let i = 0; i < keepButtons.length; i++) {
      let arr = keepButtons[i].id.split("-");
      let table = arr[2];
      let id = arr[3];
      keepButtons[i].addEventListener("click", () =>
        changeDisplay(`#delete-confirmation-${table}-${id}`, "none")
      );
    }
  }
  // to show or hidden inputs in contact form
  const contactType = document.querySelectorAll('input[name="contact-type"]');
  contactType.forEach((input) =>
    input.addEventListener("click", changeContactInputs)
  );
};

// change display of selector
const changeDisplay = (nameSelector, display) => {
  const element = document.querySelector(nameSelector);
  element.style.display = display;
};

// show or hidde mobile menu
const responsiveNavigation = () => {
  const navigation = document.querySelector(".navigation");
  navigation.classList.toggle("show");
};

// enable or disable dark mode
const darkMode = () => {
  const preferenceDarkMode = window.matchMedia("(prefers-color-scheme: dark");
  // review device config
  if (preferenceDarkMode.matches) document.body.classList.add("darkmode");
  else document.body.classList.remove("darkmode");
  // local storage data
  const darkModeLocalStorage = localStorage.getItem("darkmode");
  if (darkModeLocalStorage == "true") document.body.classList.add("darkmode");
  else if (darkModeLocalStorage == "false")
    document.body.classList.remove("darkmode");
  // change listener to change mode
  preferenceDarkMode.addEventListener("change", () => {
    if (preferenceDarkMode.matches) {
      document.body.classList.add("darkmode");
      localStorage.setItem("darkmode", "true");
    } else {
      document.body.classList.remove("darkmode");
      localStorage.setItem("darkmode", "false");
    }
  });
  // click listener to change mode
  const buttonDarkMode = document.querySelector(".button-darkmode");
  buttonDarkMode.addEventListener("click", () => {
    if (document.body.classList.contains("darkmode")) {
      document.body.classList.remove("darkmode");
      localStorage.setItem("darkmode", "false");
    } else {
      document.body.classList.add("darkmode");
      localStorage.setItem("darkmode", "true");
    }
  });
};

const changeContactInputs = (event) => {
  const divContact = document.querySelector("#contact");
  if (event.target.value === "contact-phone") {
    divContact.innerHTML = `
      <label for="phone">Número de Teléfono</label>
      <input type="tel" name="phone" id="phone" placeholder="Ej: +56912345678" />
      <p>¿Cuándo quiere ser contactado?</p>
      <label for="date">Fecha</label>
      <input type="date" name="date" id="date" />
      <label for="time">Hora</label>
      <input type="time" name="time" id="time" min="09:00" max="18:00" />
    `;
  } else {
    divContact.innerHTML = `
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Ej: user@correo.com" />
    `;
  }
};
