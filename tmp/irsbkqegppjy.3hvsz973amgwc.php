<form class="pure-form pure-form-stacked">
    <p><button type="submit" formaction="<?= (Base::instance()->alias('selectStudentForALesson')) ?>" class="pure-button">Add new
            lesson</button>
    </p>
    <h2>Previous Lessons</h2>
</form>
<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Student</th>
            <th>Details</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (($lessons?:[]) as $row): ?>

            <tr>
                <td><?= ($row['date']) ?></td>
                <td> <?= ($row['name']) ?> <?= ($row['surname']) ?></td>
                <td><a href="/lessons/<?= ($row['id']) ?>/details">Details</a></td>
                <td><a href="/lessons/<?= ($row['id']) ?>/edit">Edit</a></td>
                <td><button class="pure-button btn-delete"
                        data-url="/lessons/<?= ($row['id']) ?>/delete">Delete</button></td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>