/* IMPORT TOM SELECT FOR SEARCH SELECT */
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

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
