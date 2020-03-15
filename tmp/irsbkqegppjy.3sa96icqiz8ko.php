<!-- in case i want to show an alert success with php -->
<?php echo $this->render('/Views/modules/alert.html',NULL,get_defined_vars(),0); ?>
<h2>Customize easyTeach</h2>
        <div class="w3-bar w3-black">
            <button class="pure-button" onclick="openCity('London')">Instruments</button>
            <button class="pure-button" onclick="openCity('Paris')">Gig Types</button>
            <button class="pure-button" onclick="openCity('Tokyo')">Student Sources</button>
        </div>
<div id="London" class="city">
    <h3>Insert the instrument(s) you teach</h3>
    <form action="" method="post" class="pure-form pure-form-stacked">
        <?php if ($errors['instrument']): ?>
            <div class="field-error"><?= ($errors['instrument']) ?></div>
        <?php endif; ?>
        <input type="text" name="instrument">

        <input type="submit" class="pure-button" value="Insert">
    </form>

    <table class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>Instrument</th>
                <th>Edit</th>
                <th>Delete</th>
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
                    <td><button class="pure-button btn-delete" data-url="/students/<?= ($row['id']) ?>/delete">Delete</button>
                    </td>
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
<!--     <form action="" method="post" class="pure-form pure-form-stacked">
        <select name="instruments" id="instrument">
            <?php foreach (($instruments?:[]) as $instrument): ?>
                <option value="<?= ($instrument['id']) ?>">
                    <?= ($instrument['type'])."
" ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button class="pure-button btn-delete" data-url="/settings/<?= ($instrument['id']) ?>/delete">Delete</button>
    </form>
</div> -->










<div id="Paris" class="city" style="display:none">
    <h3>Insert the gig types you have (concerts, workshops, compositions)</h3>
    <form action="" method="post" class="pure-form pure-form-stacked">
        <?php if ($errors['addInstrument']): ?>
            <div class="field-error"><?= ($errors['addInstrument']) ?></div>
        <?php endif; ?>
        <input type="text" name="addInstrument">

        <input type="submit" class="pure-button" value="Insert">


        <select name="instruments" id="instrument">


            <?php foreach (($instruments?:[]) as $instrument): ?>
                <option value="<?= ($instrument['id']) ?>">
                    <?= ($instrument['type'])."
" ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" class="pure-button" value="Delete">
    </form>
</div>

<div id="Tokyo" class="city" style="display:none">
    <h3>Insert the sources of your students (private, various schools...)</h3>
    <form action="" method="post" class="pure-form pure-form-stacked">
        <?php if ($errors['addInstrument']): ?>
            <div class="field-error"><?= ($errors['addInstrument']) ?></div>
        <?php endif; ?>
        <input type="text" name="addInstrument">

        <input type="submit" class="pure-button" value="Insert">


        <select name="instruments" id="instrument">


            <?php foreach (($instruments?:[]) as $instrument): ?>
                <option value="<?= ($instrument['id']) ?>">
                    <?= ($instrument['type'])."
" ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" class="pure-button" value="Delete">
    </form>
</div>