<?php echo $this->render('/Views/modules/alert.html',NULL,get_defined_vars(),0); ?>

<form action="" method="post" class="pure-form pure-form-stacked">

    <table class="pure-table pure-table-bordered" id="detailsTable">
        <tbody>
            <tr>
                <td><strong>Event Type</strong></td>
                <td>
                    <select name="event_types_id">
<!-- the ternary operator below is meant to mantain, after a failed validation, the selected option as selected, since, on the array $_POST, the value is called differently (event_types_id)
    TODO: check if this solution makes sense:  i want to have a selected field Concert, because it will be the most selected in this section, does it make sense or there is abetter solution?
<?= (($event['type'] == 'Concert') ? ('selected') : ('')) ?>-->
                        <?php foreach (($event_types?:[]) as $event): ?>
                            <option value="<?= ($event['id']) ?>" <?= (($event['id'] == $values['event_types_id']) ? ('selected') : ('')) ?> <?= (($event['type'] == 'Concert') ? ('selected') : ('')) ?>>
                                <?= ($event['type'])."
" ?>
                            </option>
                        <?php endforeach; ?>
                    </select>


                </td>
            </tr>
            <tr>

                <!-- DA COMPLETARE e/o CORREGGERE -->
                <td><strong>Earning</strong></td>
                <td>
                    <div class="input-row">
                        <?php if ($errors['earning']): ?>
                            <div class="field-error"><?= ($errors['earning']) ?></div>
                        <?php endif; ?>
                        <input type="text" name="earning" id="lessonEarning"
                            value="<?= ((empty($values['student_price'])) ? ($values['earning']) : ($values['student_price'])) ?>">
                        <label for="earning">Euro</label>
                    </div>
                </td>
            </tr>

            <tr>
                <td><strong>Date</strong></td>
                <td>
                    <?php if ($errors['date']): ?>
                        <div class="field-error"><?= ($errors['date']) ?></div>
                    <?php endif; ?>
                    <!-- meaning of the ternary operators below, in case of a new lesson i will automatically receive the current date and time, in case of edit, this and other values below will be in the array $values, sometime with another name -->
                    <input type="date" name="date" id="date"
                        value="<?= ((empty($currentDate)) ? ($values['date']) : ($currentDate)) ?>">
                </td>
            </tr>

            <tr>
                <td><strong>Time</strong></td>
                <td>
                    <?php if ($errors['time']): ?>
                        <div class="field-error"><?= ($errors['time']) ?></div>
                    <?php endif; ?>
                    <input type="time" name="time" id="lessonTime"
                        value="<?= ((empty($currentTime)) ? ($values['time']) : ($currentTime)) ?>">
                </td>
            </tr>


            <tr>
                <td><strong>Place</strong></td>
                <?php if ($errors['address']): ?>
                    <div class="field-error"><?= ($errors['address']) ?></div>
                <?php endif; ?>
                <td><input type="text" name="address" id="lessonAddress"
                        value="<?= ((empty($values['source'])) ? ($values['address']) : ($values['source'])) ?>"></td>
            </tr>
            <tr>
                <td><strong>Notes</strong></td>
                <td>
                    <?php if ($errors['notes']): ?>
                        <div class="field-error"><?= ($errors['notes']) ?></div>
                    <?php endif; ?>
                    <textarea name="notes" id="lessonNotes" cols="30" rows="5"><?= ($values['notes']) ?></textarea>
                </td>
            </tr>

        </tbody>
    </table>



    <p><input type="submit" value="Save" class="pure-button"></p>

</form>