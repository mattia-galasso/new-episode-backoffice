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
window.addEventListener('resize', handleResponsiveSidebar);

/* FORM IMAGE UPLOAD PREVIEW */
const posterInput = document.getElementById("poster");
const bannerInput = document.getElementById("banner");
const posterPreview = document.getElementById("poster-preview");
const bannerPreview = document.getElementById("banner-preview");
const posterPlaceholder = document.getElementById("poster-placeholder");
const bannerPlaceholder = document.getElementById("banner-placeholder");




/* Aggiornare l'elemento nel DOM per mostrare l'anteprima dell'immagine */
function updatePreview(input, preview) {
    const file = input.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
}

if (posterInput && posterPreview) {
    posterInput.addEventListener("change", () => {
        posterPreview.classList.remove('d-none');
        posterPlaceholder.classList.add('d-none');
        updatePreview(posterInput, posterPreview);
    });
}

if (bannerInput && bannerPreview) {
    bannerInput.addEventListener("change", () => {
        bannerPreview.classList.remove('d-none');
        bannerPlaceholder.classList.add('d-none');
        updatePreview(bannerInput, bannerPreview);
    });
}


/* SEARCH SELECT */
const productionCompanySelect = document.getElementById("production_company_id");


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