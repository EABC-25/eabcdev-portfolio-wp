/**
 * Event listener to project_images meta box
 */
document.addEventListener("DOMContentLoaded", () => {
  let imageIndex = 0;
  const button = document.querySelector("#eabcdev-add-project-image");
  const list = document.querySelector("#eabcdev-project-images-list");

  if (!button || !list) {
    return;
  }

  button.addEventListener("click", () => {
    const frame = wp.media({
      title: "Select Project Image",
      button: {
        text: "Use This Image",
      },
      multiple: false,
    });

    frame.on("select", () => {
      const attachment = frame.state().get("selection").first().toJSON();

      addProjectImage({
        image_id: attachment.id,
        url: attachment.url,
        slug: "",
        caption: "",
      });
    });

    frame.open();
  });

  list.addEventListener("click", event => {
    if (!event.target.classList.contains("eabcdev-remove-project-image")) {
      return;
    }

    const image = event.target.closest(".eabcdev-project-image");

    if (!image) {
      return;
    }

    // image is div
    image.remove();
  });

  function addProjectImage(imageData) {
    const index = imageIndex++;
    const image = document.createElement("div");

    image.className = "eabcdev-project-image";

    image.innerHTML = `
    <input
      type="hidden"
      name="project_images[${index}][image_id]"
      value="${imageData.image_id}"
    >
    <img
      src="${imageData.url}"
      alt=""
      style="max-width: 200px; height: auto;"
    >
    <p>
      <label>
        slug
        <input
          type="text"
          class="widefat"
          name="project_images[${index}][slug]"
          value="${imageData.slug || ""}"
        >
      </label>
    </p>
    <p>
      <label>
        Caption
          <input
            type="text
            class="widefat"
            name="project_images[${index}][caption]"
            value="${imageData.caption || ""}"
          >
      </label>
    </p>
    <button
      type="button"
      class="button eabcdev-remove-project-image"
    >
      Remove Image
    </button>
  `;

    list.appendChild(image);
  }

  if (
    typeof eabcdevProjectImages !== "undefined" &&
    Array.isArray(eabcdevProjectImages.images)
  ) {
    eabcdevProjectImages.images.forEach(image => {
      addProjectImage(image);
    });
  }
});
