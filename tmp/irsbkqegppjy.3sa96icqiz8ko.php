<!-- in case i want to show an alert success with php -->
<?php echo $this->render('/Views/modules/alert.html',NULL,get_defined_vars(),0); ?>
<div>
    <button class="pure-button" onclick="openCity('instruments')">Instruments</button>
    <button class="pure-button" onclick="openCity('event_types')">Gig Types</button>
    <button class="pure-button" onclick="openCity('student_source')">Student Source</button>
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
                    <!-- <form method="POST"> -->
                        <td><?= ($inst['type']) ?></td>

                        <td>
                            <!-- <input type="submit" class="pure-button" value="Edit"
                                formaction="/settings/<?= ($inst['id']) ?>/edit"> -->
                        </td>
                    <!-- </form> -->
                    <td><button class="pure-button btn-delete"
                            data-url="/settingsInst/<?= ($inst['id']) ?>/delete">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= (var_dump($instruments))."
" ?>
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
                                formaction="/settings/<?= ($event_types['id']) ?>/edit"></td>
                    </form>
                    <td><button class="pure-button btn-delete"
                            data-url="/settings/<?= ($event_types['id']) ?>/delete">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>

</div>

<!-- <div id="student_source" class="city" style="display:none">
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
                <?php foreach (($instruments?:[]) as $instrument): ?>
                    <tr>
                        <form method="POST">
                            <td><?= ($instrument['type']) ?></td>

                            <td><input type="submit" class="pure-button" value="Edit"
                                    formaction="/settings/<?= ($instrument['id']) ?>/edit"></td>
                        </form>
                        <td><button class="pure-button btn-delete"
                                data-url="/settings/<?= ($instrument['id']) ?>/delete">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>

</div> -->