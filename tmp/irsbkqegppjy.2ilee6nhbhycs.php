<?php echo $this->render('/Views/modules/alert.html',NULL,get_defined_vars(),0); ?>

<form action="" method="post" class="pure-form pure-form-stacked">
    <input type="hidden" name="event_types_id" value="1">
    <!-- the ternary operators below (if/else statements) are meant to receive the data in the form in case of unsuccessfull validation -->
    <!-- i named this field stud_id, to avoid collisions with the field students_id -->
    <input type="hidden" name="stud_id" value="<?= ((empty($values['id'])) ? ($values['stud_id']) : ($values['id'])) ?>">
    <table class="pure-table pure-table-bordered" id="detailsTable">
        <tbody>
            <tr>
                <!-- ACHTUNG! controlla cosa hai scritto qui, name mi sembra una cazzata, non ricordo ora il motivo per cui mi serve un hidden input....e perché si chiama name visto che c'è anche il surname -->
                <!-- i think i can remove these lines and leave the select box below for the student, and do the same for instrument and lesson length (to be copied exactly from the student form by the way), maybe the hidden field is substituted by the OR in the ternary operator below -->
<!--                 <input type="hidden" name="name" value="<?= ($values['name']) ?> <?= ($values['surname']) ?>">
                
                <?= ($values['name']) ?> <?= ($values['surname']) ?> -->
                 <td><strong>Student</strong></td>
<!-- again, the || in the ternary operator below is there because, in case of lesson edit, the id has the key name "students_id", in case of new lesson, the id key has the name "id" -->
                 <td>      
                    <select name="students_id">
                        <?php foreach (($student_list?:[]) as $student): ?>
                            <option value="<?= ($student['id']) ?>"
                                          <?= (($student['id'] == $values['students_id'] || $student['id'] == $values['id']) ? ('selected') : ('')) ?>>
                                          <?= ($student['name']) ?> <?= ($student['surname'])."
" ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                 </td>
            </tr>
            <tr>
                <input type="hidden" name="instrument" value="<?= ($values['instrument']) ?>">
                <td><strong>Instrument</strong></td>

                <td><input type="text" 
                        value="<?= ($values['instrument']) ?>" readonly></td>
                <!--All this if i want to change the instrument, for now i don't need it and i will automatically have the assigned instrument
                     <td>                
                    <select name="instrument"> -->
        <!-- since, after the validation, the value instruments_id was appearing with another key name (instrument) i made the OR statement, i could also have changed the name attribute of the select tag above, but the i would need to check in the SQL statements...-->
        <!-- ACHTUNG: if the instrument is empty, it will not be selected, but if i put the empty value as the first option, and there's no other selected values, this empty will be the shown one...it is a trick, and it is working also on studentForm, as well as here below in lesson length -->
<!--                 <option value="">---</option>
                      <?php foreach (($instruments?:[]) as $instrument): ?>
                         <option value="<?= ($instrument['id']) ?>"
                           <?= (($instrument['id'] == $values['instruments_id'] || $instrument['id'] == $values['instrument']) ? ('selected') : ('')) ?>>
                              <?= ($instrument['type'])."
" ?>
                         </option>
                      <?php endforeach; ?>
                      
                   </select>
                </td> -->
            </tr>



            <tr>
                <td><strong>Date</strong></td>
                <td>
                    <?php if ($errors['date']): ?>
                        <div class="field-error"><?= ($errors['date']) ?></div>
                    <?php endif; ?>
                    <!-- meaning of the ternary operators below, in case of a new lesson i will automatically receive the current date and time, in case of edit, this and other values below will be in the array $values, sometime with another name -->
                    <input type="date" name="date" id="date" value="<?= ((empty($currentDate)) ? ($values['date']) : ($currentDate)) ?>">
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
<!--                 <input type="hidden" name="length" value="<?= ((empty($values['length'])) ? ($values['lesson_length']) : ($values['length'])) ?>"> -->
                
                <td><strong>Lesson length</strong></td>
                <!-- ACHTUNG: nel caso in cui qualcosa per lesson length non funzioni col sleect box, cerca di capire perchè hai messo questo if empty! -->
                <!-- <td><?= ((empty($values['length'])) ? ($values['lesson_length']) : ($values['length'])) ?></td> -->
                <td>

                        <select name="lesson_length" id="lesson_length">
                    <!-- ACHTUNG: SE LO LESSON LENGTH è VUOTO, NON ME LO METTE COME SELECTED, RIVEDERE -->
                      <option value="">---</option>
                               <?php foreach (($lesson_length?:[]) as $length): ?>
                                   <option value="<?= ($length['id']) ?>" <?= (($length['id'] == $values['lesson_length_id'] || $length['id'] == $values['lesson_length']) ? ('selected') : ('')) ?>>
                                   <?= ($length['length'])."
" ?>
                                   </option>
                               <?php endforeach; ?>
                        </select> 
                </td>
            </tr>
            <tr>
                <td><strong>Earning</strong></td>
                <td>
                    <div class="input-row">
                        <?php if ($errors['earning']): ?>
                            <div class="field-error"><?= ($errors['earning']) ?></div>
                        <?php endif; ?>
                        <input type="text" name="earning" id="lessonEarning"
                            value="<?= ((empty($values['student_price'])) ? ($values['earning']) : ($values['student_price'])) ?>"><label
                            for="earning">Euro</label>
                    </div>
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
           <!--   <tr>
                               <td><strong>Files</strong></td>
                <td>
                    <input type="file" name="lessonFiles" id="lessonFiles">
                </td>
            </tr>
            <tr>
                <td><strong>Links</strong></td>
                <td>
                    <input type="url" name="lessonLinks" id="lessonLinks">
                </td>
            </tr> -->
        </tbody>
    </table>

    <!--     <label for="email">E-Mail</label>
    <input type="email" name="email" id="email" value="<?= ($values['email']) ?>">

    <label for="telephone">Phone</label>
    <input type="tel" name="telephone" id="telephone" value="<?= ($values['phone']) ?>"> -->


    <p><input type="submit" value="Save" class="pure-button"></p>

</form>