(function () {

    let btnDelete = $('.btn-delete');


    btnDelete.click(function (e) {
        let deleteOk = confirm('Are you sure to cancel this student?');

        if (!deleteOk) {
            return false;
        }

        let button = $(this);
        let url = button.data('url');

        $.get(url, function (data) {
            if (data === 'Student_deleted') {
           

                button.closest('#detailsTable').remove();

                window.location.replace("/students/seeAllStudents");
            } else {
                alert('The student couldn\'t be canceled!');
            }
        });
    });
}());
