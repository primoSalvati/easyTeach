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


                button.closest('#detailsTable').remove();

                window.location.replace("/lessons/lessonsList");
            } else {
                alert('The student couldn\'t be canceled!');
            }
        });
    });
}());
