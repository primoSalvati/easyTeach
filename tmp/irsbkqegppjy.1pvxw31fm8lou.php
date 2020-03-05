<table class="pure-table pure-table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Details</th>
            <th>Select</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach (($students?:[]) as $row): ?>
            <!-- how to insert an ordered list, so that i can check the number of the students? 
maybe this is useful using javascript
https://www.webdeveloper.com/d/225252-how-to-use-numbered-lists-inside-html-tables/8-->
            <tr>
                <td><?= ($row['name']) ?></td>
                <td><?= ($row['surname']) ?></td>

                <!-- TODO: nel cliccare i dettagli qui, invece di andare alla pagina classica coi dettagli, è meglio che faccio una funzione popup javascript che mi fa vedere velocemente i dettagli, senza dover editare ecc,  alert? -->
                <td><a href="/students/seeAllStudents/<?= ($row['id']) ?>/details">Details</a></td>

                <!-- the link here should send data from the selected student in the lesson table, or i can do it with js, or directly with an sql command...?-->
                <td><a href="/lessons/seeAllStudents/<?= ($row['id']) ?>/lessonForm">Select</a></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>

<form class="pure-form pure-form-stacked">
    <p><button type="submit" formaction="<?= (Base::instance()->alias('addNewStudent')) ?>" class="pure-button">Add new student</button></p>
</form>