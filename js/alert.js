(function () {

    /* wie bekomme ich hier die Daten von $_POST */
    let button = $(this);
    let url = button.data('url');
    // die eben ermittelte Adresse per AJAX aufrufen
    $.get(url, function (data) {
                if (data === 'Deleted') {
                    // Bei Erfolg die Zeile aus der Tabelle löschen:
                    // geklickter_button.nächst_höheres_tr.löschen()
                    button.closest('option').remove();
                } else {
                    alert('The row couldn\'t be canceled!');
                }
});