new DataTable('#datatable-logs');
console.log('Hello from style.js');
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionne toutes les checkboxes avec la classe spécifique
    let checkboxes = document.querySelectorAll(".checkbox-is-default-page");

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            if (this.checked) {
                // Décoche toutes les autres checkboxes
                checkboxes.forEach(function (otherCheckbox) {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });
});
