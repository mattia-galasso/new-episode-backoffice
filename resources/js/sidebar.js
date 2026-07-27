/* SIDEBAR */
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
        if (window.innerWidth < 768) {
            return;
        }

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
