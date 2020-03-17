<div>
    <button class="pure-button" onclick="openCity('instruments')">Instruments</button>
    <button class="pure-button" onclick="openCity('event_types')">Gig Types</button>
    <button class="pure-button" onclick="openCity('student_sources')">Student Sources</button>
    <button class="pure-button" onclick="openCity('lesson_lenght')">Lesson Length</button>
    <button class="pure-button" onclick="openCity('student_regularity')">Student Regularity</button>
</div>

<div id="instruments" class="city">
    <h3>Insert the instrument(s) you teach</h3>
    <div class="form-inline">
        <form action="" method="post" class="pure-form pure-form-stacked">
            <?php if ($errors['instrument']): ?>
                <div class="field-error"><?= ($errors['instrument']) ?></div>
            <?php endif; ?>
            <input type="text" name="instrument">

            <input type="submit" class="pure-button inline-button" value="Save">
        </form>
    </div>




    <table class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>Your instruments</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($instruments?:[]) as $inst): ?>
                <tr>
 <!--                    <form method="POST"></form> -->
                        <td><?= ($inst['type']) ?></td>

<!--                         <td>
                            <input type="submit" class="pure-button" value="Edit"
                                formaction="/settings/<?= ($inst['id']) ?>/edit">
                        </td>
                    </form> -->
                    <td><button class="pure-button btn-delete"
                            data-url="/settings/<?= ($inst['id']) ?>/delete">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>








<div id="event_types" class="city" style="display:none">
    <h3>Insert the gig types you can have</h3>
    <div class="form-inline">
        <form action="" method="post" class="pure-form pure-form-stacked">
            <?php if ($errors['event_types']): ?>
                <div class="field-error"><?= ($errors['event_types']) ?></div>
            <?php endif; ?>
            <input type="text" name="event_types">

            <input type="submit" class="pure-button inline-button" value="Save">
        </form>
    </div>




    <table class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>Your gig types</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($event_types?:[]) as $event): ?>
                <tr>
                    <form method="POST">
                        <td><?= ($event['type']) ?></td>

                        <td><input type="submit" class="pure-button" value="Edit"
                                formaction="/settings/<?= ($event['id']) ?>/edit"></td>
                    </form>
                    <td><button class="pure-button btn-delete"
                            data-url="/settings/<?= ($event['id']) ?>/delete">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>

</div>



<div id="student_sources" class="city" style="display:none">
    <h3>Insert the sources of your students (private, different schools...)</h3>
    <div class="form-inline">
        <form action="" method="post" class="pure-form pure-form-stacked">
            <?php if ($errors['student_sources']): ?>
                <div class="field-error"><?= ($errors['student_sources']) ?></div>
            <?php endif; ?>
            <input type="text" name="student_sources">

            <input type="submit" class="pure-button inline-button" value="Save">
        </form>
    </div>




    <table class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>Your Student Sources</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($student_sources?:[]) as $source): ?>
                <tr>
                    <form method="POST">
                        <td><?= ($source['source']) ?></td>

                        <td><input type="submit" class="pure-button" value="Edit"
                                formaction="/settings/<?= ($source['id']) ?>/edit"></td>
                    </form>
                    <td><button class="pure-button btn-delete"
                            data-url="/settings/<?= ($source['id']) ?>/delete">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>

</div>