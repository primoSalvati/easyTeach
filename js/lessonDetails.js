(function () {

    let btnDelete = $('.btn-delete');


    btnDelete.click(function (e) {
        let deleteOk = confirm('Are you sure to cancel this lesson?');

        if (!deleteOk) {
            return false;
        }

        let button = $(this);
        let url = button.data('url');

        $.get(url, function (data) {
            if (data === 'Deleted') {

/* forse che il problema sia qua? detailstabel o table? non va bene forse, la cosa strana è che ha sempre funzionato */
                button.closest('table').remove();

                window.location.replace("/lessons");
            } else {
                alert('The student couldn\'t be canceled!');
            }
        });
    });
}());
