document.addEventListener("DOMContentLoaded", () => {
  const windowEl = document.querySelector(".window");

  if (!windowEl) {
    return;
  }

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

  const cards = windowEl.querySelectorAll(".card");
  let featured = windowEl.querySelector(".featured img");

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

      // loop through all cards and remove full-opacity class then add only to the card clicked
      for (card_ of cards) {
        card_.classList.remove("full-opacity");
      }
      card.classList.add("full-opacity");
    });
  });
});
