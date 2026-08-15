document.addEventListener("DOMContentLoaded", () => {
  const windowEl = document.querySelector(".window");
  const windowElChildren = windowEl.children;

  windowEl.addEventListener("click", el => {
    if (
      el.target.classList.contains("window-tab-header") ||
      el.target.parentElement.classList.contains("window-tab-header")
    ) {
      for (child of windowElChildren) {
        child.querySelector(".window-content").style.zIndex = 0;
        child.classList.remove("colored");
      }

      el.target
        .closest("section")
        .querySelector(".window-content").style.zIndex = 1;

      if (el.target.parentElement.className !== "window-tab") {
        el.target.parentElement.parentElement.classList.add("colored");
      } else {
        el.target.parentElement.classList.add("colored");
      }
    }
  });
});
