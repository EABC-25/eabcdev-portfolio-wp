document.addEventListener("DOMContentLoaded", () => {
  const windowEl = document.querySelector(".window");
  // exit if there's no .window div
  if (!windowEl) {
    return;
  }

  // make all carousels run
  runCarousel(windowEl);

  // Projects Column (at the very top, because for sure whenever there's windowEl - #first-column will also exist)
  const windowFirstColumn = windowEl.querySelector("#first-column");

  const projectsList = windowFirstColumn.querySelector(".projects-list");

  if (!windowFirstColumn || !projectsList) {
    return;
  }

  projectsList.addEventListener("click", el => {
    console.log(el.target);
    return;
    if (
      el.target.classList.contains("project-list-header") ||
      el.target.parentElement.classList.contains("project-list-header")
    ) {
      const listParent = el.target.closest("li");
      const listParentFullHeight = listParent.getBoundingClientRect().height;
      // google search's ai taught me this lol
      if (!listParent.parentElement.classList.contains("active")) {
        // Snap it right back to the closed state instantly so it can animate
        listParent.parentElement.style.height = "30px";
        // Force a browser "reflow" so it registers the snap-back before animating
        listParent.parentElement.offsetHeight;
        // INJECT HEIGHT
        listParent.parentElement.classList.add("active");
        listParent.parentElement.style.height = `${listParentFullHeight}px`;
      } else {
        listParent.parentElement.classList.remove("active");
        listParent.parentElement.style.height = "30px";
      }
    }
  });

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
        windowContent.style.zIndex = 10;
      }

      el.target
        .closest("section")
        .querySelector(".window-content").style.zIndex = 11;

      if (el.target.parentElement.className !== "window-tab") {
        el.target.parentElement.parentElement.classList.add("colored");
      } else {
        el.target.parentElement.classList.add("colored");
      }
    }
  });

  // Project Images Column
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

function runCarousel(windowEl) {
  const carousels = windowEl.querySelectorAll(".carousel");

  for (const carousel of carousels) {
    const chariot = carousel.querySelector(".chariot");
    const charioteer = chariot?.querySelector(".charioteer");

    if (!chariot || !charioteer) {
      continue;
    }

    const carouselWidth = carousel.getBoundingClientRect().width;

    const charioteerWidth = charioteer.getBoundingClientRect().width;

    if (!carouselWidth || !charioteerWidth) {
      continue;
    }

    const charioteerCount = Math.ceil(carouselWidth / charioteerWidth) + 1;

    for (let i = 1; i < charioteerCount; i++) {
      chariot.appendChild(charioteer.cloneNode(true));
    }

    setupCarousel(carousel);
  }
}

function setupCarousel(carousel) {
  const observer = new IntersectionObserver(
    entries => {
      for (const entry of entries) {
        handleSentinel(entry, observer, carousel);
      }
    },
    {
      root: carousel,
      threshold: 0,
    },
  );

  const chariot = carousel.querySelector(".chariot");

  setupChariot(carousel, chariot, observer);
}

function setupChariot(carousel, chariot, observer) {
  const carouselWidth = carousel.getBoundingClientRect().width;

  chariot.style.transition = "none";
  chariot.style.transform = `translateX(${carouselWidth}px)`;

  const sentinel = chariot.querySelector(".chariot-sentinel");

  if (!sentinel) {
    return;
  }

  observer.observe(sentinel);

  requestAnimationFrame(() => {
    animateChariot(carousel, chariot);
  });
}

function animateChariot(carousel, chariot) {
  const carouselRect = carousel.getBoundingClientRect();

  const chariotRect = chariot.getBoundingClientRect();

  const distance = chariotRect.right - carouselRect.left;

  chariot.style.transition = "transform 100s linear";

  chariot.style.transform = `translateX(-${distance}px)`;
}

function handleSentinel(entry, observer, carousel) {
  const sentinel = entry.target;
  const chariot = sentinel.parentElement;

  if (!chariot) {
    return;
  }

  const rootBounds = entry.rootBounds;
  const sentinelRect = entry.boundingClientRect;

  if (!rootBounds) {
    return;
  }

  if (entry.isIntersecting && sentinelRect.left >= rootBounds.right - 1) {
    createNextChariot(carousel, chariot, observer);
  }

  if (!entry.isIntersecting && sentinelRect.right <= rootBounds.left) {
    removeChariot(chariot, observer);
  }
}

function createNextChariot(carousel, previousChariot, observer) {
  const previousRect = previousChariot.getBoundingClientRect();

  const carouselRect = carousel.getBoundingClientRect();

  const newChariot = previousChariot.cloneNode(true);

  /*
   * Append it to the carousel.
   */
  carousel.appendChild(newChariot);

  /*
   * Calculate where the new chariot's LEFT edge
   * needs to be.
   */
  const newLeft = previousRect.right - carouselRect.left;

  newChariot.style.transition = "none";

  newChariot.style.transform = `translateX(${newLeft}px)`;

  /*
   * Watch the new chariot's sentinel
   * with the SAME observer.
   */
  const sentinel = newChariot.querySelector(".chariot-sentinel");

  if (sentinel) {
    observer.observe(sentinel);
  }

  /*
   * Start moving it.
   */
  requestAnimationFrame(() => {
    animateChariot(carousel, newChariot);
  });
}

function removeChariot(chariot, observer) {
  const sentinel = chariot.querySelector(".chariot-sentinel");

  if (sentinel) {
    observer.unobserve(sentinel);
  }

  chariot.remove();
}
