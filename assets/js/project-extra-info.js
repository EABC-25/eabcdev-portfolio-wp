/**
 * Event listener to project_extra_info meta box
 */
document.addEventListener("DOMContentLoaded", () => {
  const input = document.querySelector("#eabcdev-project-extra-info-input");
  const list = document.querySelector("#eabcdev-project-extra-info-list");

  if (!list || !input) {
    return;
  }

  input.addEventListener("click", event => {
    if (!event.target.classList.contains("eabcdev-save-project-extra-info")) {
      return;
    }

    const textBox = input.querySelector("input");

    if (!textBox) {
      return;
    }

    addToList(textBox.value);

    textBox.value = "";
  });

  list.addEventListener("click", event => {
    if (!event.target.classList.contains("eabcdev-delete-project-extra-info")) {
      return;
    }

    const container = event.target.closest(".eabcdev-project-extra-info");

    if (!container) {
      return;
    }

    container.remove();

    const extraInfos = list.querySelectorAll(".eabcdev-project-extra-info");

    extraInfos.forEach((el, index) => {
      const n = index + 1;
      el.querySelector("span").innerText = n;
      el.querySelector("input").name = `project_extra_info[${n}]`;
    });
  });

  function addToList(text) {
    if (text === "") {
      return;
    }

    const index = list.children.length + 1;
    const container = document.createElement("div");
    container.className = "eabcdev-project-extra-info";
    container.innerHTML = `
      <p>
        <label>
          <span>
            ${index}
          </span>
          <input
            type="text"
            class="widefat"
            name="project_extra_info[${index}]"
            value="${text}"
          >
        </label>
      </p>
      <button
        type="button"
        class="button eabcdev-delete-project-extra-info"
      >Delete</button>
    `;

    list.appendChild(container);
  }

  if (
    typeof eabcdevProjectExtraInfo !== "undefined" &&
    Array.isArray(eabcdevProjectExtraInfo.extraInfo)
  ) {
    eabcdevProjectExtraInfo.extraInfo.forEach(text => {
      addToList(text);
    });
  }
});
