document.addEventListener("DOMContentLoaded", () => {
  eventListeners();
  darkMode();
});

// all event listeners
const eventListeners = () => {
  const mobileMenu = document.querySelector(".mobile-menu");
  mobileMenu.addEventListener("click", responsiveNavigation);
  const deleteDiv = document.querySelector(".open-delete") ?? null;
  if (deleteDiv)
    deleteDiv.addEventListener("click", () =>
      changeDisplay(".delete-confirmation", "block")
    );
  const keepButton = document.querySelector(".close-delete") ?? null;
  if (keepButton)
    keepButton.addEventListener("click", () =>
      changeDisplay(".delete-confirmation", "none")
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
