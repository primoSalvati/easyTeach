<form class="pure-form pure-form-stacked">
    <p><button type="submit" formaction="<?= (Base::instance()->alias('addNewStudent')) ?>" class="pure-button">Add new</button></p>
</form>
<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Nr.</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Details</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Lesson</th>
        </tr>
    </thead>
    <tbody>

        <?php $ctr=0; foreach (($students?:[]) as $row): $ctr++; ?>
            <tr>
                <td class="list-align"><?= ($ctr) ?></td>
                <td><?= ($row['name']) ?></td>
                <td><?= ($row['surname']) ?></td>
                <td><a href="/students/<?= ($row['id']) ?>/details">Details</a></td>
                <td><a href="/students/<?= ($row['id']) ?>/edit">Edit</a></td>
                <td><button class="pure-button btn-delete"
                        data-url="/students/<?= ($row['id']) ?>/delete">Delete</button></td>
                <td>
                    <form>
                        <button type="submit" class="pure-button"
                            formaction="/lessons/seeAllStudents/<?= ($row['id']) ?>/lessonForm">
                            Select for a lesson
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>