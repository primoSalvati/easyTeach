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
            /* console.log(data); return false; */
                if (data === 'Deleted') {
        
                button.closest('#detailsTable').remove();

                window.location.replace("/students");
  /*      alternativa, che comunque non funziona     window.location.href = "/students"; */
            } else {
                alert('The student couldn\'t be canceled!');
            } 
        });
    });
}());
