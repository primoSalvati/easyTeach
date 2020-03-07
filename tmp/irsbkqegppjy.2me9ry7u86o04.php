
<table class="pure-table pure-table-striped" id="detailsTable">
    <tbody>
        <tr>
            <td><strong>Name</strong></td>
            <td><?= ($studentDetails['name']) ?></td>
        </tr>
        <tr>
            <td><strong>Surname</strong></td>
            <td><?= ($studentDetails['surname']) ?></td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td><?= ($studentDetails['email']) ?></td>
        </tr>
        <tr>
            <td><strong>Phone</strong></td>
            <td><?= ($studentDetails['phone']) ?></td>
        </tr>
        <tr>
            <td><strong>Date of Birth</strong></td>
            <td><?= ($studentDetails['format_date_of_birth']) ?></td>
        </tr>
        <tr>
            <td><strong>Student Price</strong></td>
            <td><?= ($studentDetails['student_price']) ?> Euro</td>
        </tr>
        <tr>
            <td><strong>Student Source</strong></td>
            <td><?= ($studentDetails['source']) ?></td>
        </tr>
        <tr>
            <td><strong>Instrument</strong></td>
            <td><?= ($studentDetails['instrument']) ?></td>
        </tr>
        <tr>
            <td><strong>Lesson Length</strong></td>
            <td><?= ($studentDetails['length']) ?></td>
        </tr>
        <tr>
            <td><strong>Student Regularity</strong></td>
            <td><?= ($studentDetails['regularity']) ?></td>
        </tr>

    </tbody>
</table>
</br>
<form class="pure-form pure-form-stacked">

    <button type="submit" formaction="/students/seeAllStudents/<?= ($studentDetails['id']) ?>/edit"
        class="pure-button">Edit</button>

    <button type="submit" formaction="/students/seeAllStudents" class="pure-button">See All</button>

    <button class="pure-button btn-delete"
        data-url="/students/seeAllStudents/<?= ($studentDetails['id']) ?>/details/delete">Delete</button>


    <button class="pure-button"
        formaction="/lessons/seeAllStudents/<?= ($studentDetails['id']) ?>/lessonForm">Select for a lesson</button>

</form>