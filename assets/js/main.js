document.addEventListener("DOMContentLoaded", () => {
  const windowEl = document.querySelector(".window");
  // exit if there's no .window div
  if (!windowEl) {
    return;
  }

  const windowHeaders = document.querySelectorAll(".window-tab-header");
  // exit if there's only 1 .window-tab-header div
  // I can also remove cursor pointer css for the single .window-tab-header div since we are not going to be implementing click fnctionality - but maybe for now that's gonna be a future to do
  if (windowHeaders.length === 1) {
    return;
  }

  const windowElChildren = windowEl.children;

  windowEl.addEventListener("click", el => {
    if (
      el.target.classList.contains("window-tab-header") ||
      el.target.parentElement.classList.contains("window-tab-header")
    ) {
      for (windowTabChild of windowElChildren) {
        windowTabChild.classList.remove("colored");
        let windowContent = windowTabChild.querySelector(".window-content");
        if (!windowContent) {
          continue;
        }
        windowContent.style.zIndex = 0;
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

  const windowThirdColumn = windowEl.querySelector("#third-column");

  if (!windowThirdColumn) {
    return;
  }
  const header = windowThirdColumn.querySelector(".window-tab-header h1");
  const cards = windowThirdColumn.querySelectorAll(".card");
  let featured = windowThirdColumn.querySelector(".featured img");

  if (!cards) {
    return;
  }

  cards.forEach(card => {
    card.addEventListener("click", () => {
      // render clicked image in featured element
      featured.removeAttribute("srcset");
      featured.removeAttribute("sizes");
      featured.src = card.dataset.largeImage;

      // change image query to current rendered image_slug
      const url = new URL(window.location.href);
      url.searchParams.set("image", card.dataset.imageSlug);
      // using replaceState instead of pushState so that the back button does not go back to previous imageSlug
      window.history.replaceState({ path: url.toString() }, "", url.toString());
      header.innerText = card.dataset.imageSlug;

      // loop through all cards and remove full-opacity class then add only to the card clicked
      for (card_ of cards) {
        card_.classList.remove("full-opacity");
      }
      card.classList.add("full-opacity");
    });
  });
});
