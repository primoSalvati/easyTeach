(function () {
    // Alle Löschen Buttons ermitteln
    let btnDelete = $('.btn-delete');

    // jedem Löschen Button ein click event hinzufügen
    btnDelete.click(function (e) {
        let deleteOk = confirm('Are you sure to cancel this row?');
        // Abbrechen, wenn nicht ok geklickt wurde
        if (!deleteOk) {
            return false;
        }

        // $(this) -> der geklickte Button, wir holen uns die aufzurufende URL. $(this) erzeugt ein jQuery Object. 
        let button = $(this);
        let url = button.data('url');
        // die eben ermittelte Adresse per AJAX aufrufen
        $.get(url, function (data) {
            if (data === 'Deleted') {
                // Bei Erfolg die Zeile aus der Tabelle löschen:
                // geklickter_button.nächst_höheres_tr.löschen()
                button.closest('tr').remove();
            } else {
                alert('The student couldn\'t be canceled!');
            }
        });
    });
}());