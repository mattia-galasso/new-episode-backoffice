/* FORM IMAGE UPLOAD PREVIEW */
function setupImagePreview(inputId, previewId, placeholderId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const placeholder = document.getElementById(placeholderId);

    if (!input || !preview || !placeholder) {
        return;
    }

    input.addEventListener("change", function () {
        const file = input.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.classList.remove("d-none");
            placeholder.classList.add("d-none");
        };

        reader.readAsDataURL(file);
    });
}

setupImagePreview("poster", "poster-preview", "poster-placeholder");
setupImagePreview("banner", "banner-preview", "banner-placeholder");
setupImagePreview("photo", "actor-preview", "actor-placeholder");
setupImagePreview("logo_img", "platform-preview", "platform-placeholder");
