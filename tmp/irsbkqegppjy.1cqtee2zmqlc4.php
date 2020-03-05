<?= (var_dump($lessonDetails))."
" ?>

<table class="pure-table pure-table-bordered" id="detailsTable">
    <tbody>
        <tr>
            <td><strong>Student</strong></td>
            <td><?= ($lessonDetails['name']) ?> <?= ($lessonDetails['surname']) ?></td>
        </tr>
        <tr>
            <td><strong>Date</strong></td>
            <td><?= ($lessonDetails['date']) ?></td>
        </tr>
        <tr>
            <td><strong>Time</strong></td>
            <td><?= ($lessonDetails['time']) ?></td>
        </tr>
        <tr>
            <td><strong>Earning</strong></td>
            <td><?= ($lessonDetails['earning']) ?> Euro</td>
        </tr>
        <tr>
            <td><strong>Instrument</strong></td>
            <td><?= ($lessonDetails['instrument']) ?></td>
        </tr>
        <tr>
            <td><strong>Place</strong></td>
            <td><?= ($lessonDetails['address']) ?></td>
        </tr>
        <tr>
            <td><strong>Lesson Length</strong></td>
            <td><?= ($lessonDetails['lesson_length']) ?></td>
        </tr>
        <tr>
            <td><strong>Notes</strong></td>
            <td><?= ($lessonDetails['notes']) ?></td>
        </tr>
    </tbody>
</table>
</br>
<form class="pure-form pure-form-stacked">

    <button type="submit" formaction="/lessons/lessonsList/<?= ($lessonDetails['id']) ?>/edit"
        class="pure-button">Edit</button>

    <button type="submit" formaction="<?= (Base::instance()->alias('seeLessons')) ?>" class="pure-button">See All</button>

    <button class="pure-button btn-delete"
        data-url="/students/seeAllStudents/<?= ($studentDetails['id']) ?>/details/delete">Delete</button>


    <button class="pure-button" formaction="/lessons/seeAllStudents/<?= ($lessonDetails['students_id']) ?>/lessonForm">Select
        for new lesson</button>

</form>
