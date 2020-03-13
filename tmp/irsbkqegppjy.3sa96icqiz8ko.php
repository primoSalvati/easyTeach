<!-- in case i want to show an alert success with php -->
<?php echo $this->render('/Views/modules/alert.html',NULL,get_defined_vars(),0); ?>

<h2>Customize easyTeach</h2>

<form action="/settings" method="post" class="pure-form pure-form-stacked">

    <table class="pure-table pure-table-bordered list-align">
        <thead>
            <tr>
                <th></th>
                <th>Insert a Value</th>
                <th></th>
                <th>Your Entries</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td><strong>
                        <p>Which instrument(s)</p> can you teach?
                    </strong>
                </td>

                <td>
                    <?php if ($errors['addInstrument']): ?>
                        <div class="field-error"><?= ($errors['addInstrument']) ?></div>
                    <?php endif; ?>
                    <input type="text" name="addInstrument">
                </td>
                <td><input type="submit" class="pure-button" value="Insert"></td>
                <td>
                    <!--                  <select name="settings-instruments" id="">
                     <option value="">Sassofono Test</option>
                 </select> -->

                    <select name="instruments" id="instrument">
                        <!-- <option value="">---</option> -->
                        <!-- since, after the validation, the value instruments_id was appearing with another key name (instrument) i made the OR statement, i could also have changed the name attribute of the select tag above, but the i would need to check in the SQL statements...-->

                        <?php foreach (($instruments?:[]) as $instrument): ?>
                            <option value="<?= ($instrument['id']) ?>">
                                <?= ($instrument['type'])."
" ?>
                            </option>
                        <?php endforeach; ?>
                    </select>









                </td>
                <td><input type="submit" class="pure-button" value="Delete"></td>
            </tr>







            <tr>
                <td><strong>
                        <p>Type your student sources</p> (private, schools...)
                    </strong></td>
                <td><input type="text" name="set-instrument"></td>
                <td><input type="submit" class="pure-button" value="Insert"></td>
                <td>
                    <select name="" id="">
                        <option value="">School 1</option>
                    </select>
                </td>
                <td><input type="submit" class="pure-button" value="Delete"></td>
            </tr>
            <tr>
                <td><strong>
                        <p>Insert other kind of jobs</p>(concerts, workshops...)
                    </strong></td>
                <td><input type="text" name="set-instrument"></td>
                <td><input type="submit" class="pure-button" value="Insert"></td>
                <td>
                    <select name="" id="">
                        <option value="">Concert</option>
                    </select>
                </td>
                <td><input type="submit" class="pure-button" value="Delete"></td>
            </tr>
            <tr>
                <td><strong>
                        <p>Set up how often </p>your students can come
                    </strong></td>
                <td><input type="text" name="testmammota"></td>
                <td><input type="submit" class="pure-button" value="Insert"></td>
                <td>
                    <select name="" id="">
                        <option value="">Once a week</option>
                    </select>
                </td>
                <td><input type="submit" class="pure-button" value="Delete"></td>
            </tr>
            <tr>
                <td><strong>
                        <p>Insert how many different </p> lesson lengths can you offer
                    </strong></td>
                <td><input type="text" name="set-instrument"></td>
                <td><input type="submit" class="pure-button" value="Insert"></td>
                <td>
                    <select name="" id="">
                        <option value="">Sassofono Test</option>
                    </select>
                </td>
                <td><input type="submit" class="pure-button" value="Delete"></td>
            </tr>

            <!-- next, provare le funzionalità su questo select bix, se funziona andare avanti -->

        </tbody>

    </table>










</form>