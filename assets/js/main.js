document.addEventListener("DOMContentLoaded", () => {
  let active = false;
  const windowAbsBtn = document.querySelector("#window-absolute-button");
  const windowAbsContainer = document.querySelector(
    ".window-absolute-container",
  );

  windowAbsBtn.addEventListener("click", () => {
    if (windowAbsContainer) {
      if (!active && !windowAbsContainer.classList.contains("active")) {
        active = true;
        windowAbsContainer.classList.add("active");
        windowAbsContainer.firstElementChild.classList.remove("furled");
        windowAbsContainer.firstElementChild.classList.add("unfurled");
      } else {
        active = false;
        windowAbsContainer.classList.remove("active");
        windowAbsContainer.firstElementChild.classList.remove("unfurled");
        windowAbsContainer.firstElementChild.classList.add("furled");
      }
    }
  });
});
