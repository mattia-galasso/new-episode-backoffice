import "./bootstrap";
import "~resources/scss/app.scss";
import "~icons/bootstrap-icons.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);

/* IMPORT TOM SELECT FOR SEARCH SELECT */
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

const sidebarToggle = document.getElementById("sidebar-toggle");
const sidebarToggleIcon = document.getElementById("sidebar-toggle-icon");
const body = document.body;

// Faccio un controllo se ci troviamo nel layout App per evitare errori di elementi inesistenti
if (sidebarToggle && sidebarToggleIcon) {
    
    // Recupero lo stato della Sidebar dal LocalStorage
    const sidebarState = localStorage.getItem("sidebar");

    // Apporto le modifiche se nel LocalStorage la sidebar è collassata
    if (sidebarState === "collapsed") {
        body.classList.add("sidebar-collapsed");
        sidebarToggleIcon.classList.replace(
            "bi-layout-sidebar-inset",
            "bi-layout-sidebar-inset-reverse",
        );
    } else {
        body.classList.remove("sidebar-collapsed");

        sidebarToggleIcon.classList.replace(
            "bi-layout-sidebar-inset-reverse",
            "bi-layout-sidebar-inset",
        );
    }

    // Se viene cliccato il Button della sidebar
    sidebarToggle.addEventListener("click", function () {
        // Se è presente la classe la rimuovo o viceversa
        body.classList.toggle("sidebar-collapsed");

        if (body.classList.contains("sidebar-collapsed")) {
            sidebarToggleIcon.classList.replace(
                "bi-layout-sidebar-inset",
                "bi-layout-sidebar-inset-reverse",
            );
            // Salvo il nuovo stato nel LocalStorage
            localStorage.setItem("sidebar", "collapsed");
        } else {
            sidebarToggleIcon.classList.replace(
                "bi-layout-sidebar-inset-reverse",
                "bi-layout-sidebar-inset",
            );
            // Salvo il nuovo stato nel LocalStorage
            localStorage.setItem("sidebar", "expanded");
        }
    });

    function handleResponsiveSidebar() {
        // MOBILE
        if (window.innerWidth < 576) {
            return;
        }

        // TABLET
        if (window.innerWidth < 768) {
            body.classList.add("sidebar-collapsed");
            return;
        }

        // DESKTOP
        if (sidebarState === "collapsed") {
            body.classList.add("sidebar-collapsed");
        } else {
            body.classList.remove("sidebar-collapsed");
        }
    }

    handleResponsiveSidebar();
    window.addEventListener("resize", handleResponsiveSidebar);
}

/* FORM IMAGE UPLOAD PREVIEW */
function setupImagePreview(inputId, previewId, placeholderId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const placeholder = document.getElementById(placeholderId);

    if (!input || !preview || !placeholder) {
        return;
    }

    input.addEventListener("change", function () {
        const file = this.files[0];

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

/* SEARCH SELECT TOM SELECT */
const productionCompanySelect = document.getElementById(
    "production_company_id",
);

if (productionCompanySelect) {
    new TomSelect(productionCompanySelect, {
        create: false,
        allowEmptyOption: true,
        closeAfterSelect: true,
        sortField: {
            field: "text",
            direction: "asc",
        },
        placeholder: "Seleziona una casa di produzione",
    });
}

/* ACTOR SEARCH SELECT TOM SELECT */
const actorSelect = document.getElementById("actor_id");

if (actorSelect) {
    new TomSelect("#actor_id", {
        valueField: "id",
        labelField: "name",
        searchField: "name",

        load: function (query, callback) {
            if (!query.length) return callback();

            fetch(`/api/actors/search?name=${encodeURIComponent(query)}`)
                .then((response) => response.json())

                .then((json) => callback(json))

                .catch(() => callback());
        },

        render: {
            option: function (item, escape) {
                const photo = item.photo
                    ? `/storage/${item.photo}`
                    : "/img/actor_image_not_found.png";

                return `
            <div class="d-flex align-items-center py-2 px-2">

                <img
                    src="${photo}"
                    class="actor-search-photo me-3"
                    alt="${escape(item.name)}">

                <span>

                    ${escape(item.name)}

                </span>

            </div>
        `;
            },

            item: function (item, escape) {
                const photo = item.photo
                    ? `/storage/${item.photo}`
                    : "/img/actor_image_not_found.png";

                return `
            <div class="d-flex align-items-center">

                <img
                    src="${photo}"
                    class="actor-search-photo me-2"
                    alt="${escape(item.name)}">

                <span>

                    ${escape(item.name)}

                </span>

            </div>
        `;
            },
        },
    });
}
