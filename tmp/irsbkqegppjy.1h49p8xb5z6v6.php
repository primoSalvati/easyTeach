<nav class="settings-nav">

            <ul>
                <li>
                    <a href="<?= (Base::instance()->alias('students')) ?>">
                        <h3>Students</h3>
                    </a>
                </li>
                <li>
                    <a href="<?= (Base::instance()->alias('lessons')) ?>">
                        <h3>Lessons</h3>
                    </a>
                </li>
                <li>
                    <a href="<?= (Base::instance()->alias('calendar')) ?>">
                        <h3>Calendar</h3>
                    </a>
                </li>
                <li>
                    <a href="<?= (Base::instance()->alias('displayEarnings')) ?>">
                        <h3>Earnings</h3>
                    </a>
                </li>
                <li>
                    <a href="<?= (Base::instance()->alias('gigs')) ?>">
                        <h3>Gig</h3>
                    </a>
                </li>
                <li>
                    <a href="<?= (Base::instance()->alias('settings')) ?>">
                        <img src="/media/settings.png" alt="settings_image" class="settings-logo">
                    </a>
                </li>
            </ul>

            </h3>
        </nav>






<div id="instruments" class="city">
    <h3>Insert the instrument(s) you teach</h3>
    <div class="form-inline">
        <!-- i need to put the current url of the POST route in the action, a different value for every tab of the page: here action="/settings/instruments" -->
        <form action="" method="post" class="pure-form pure-form-stacked">
            <?php if ($errors['instrument']): ?>
                <div class="field-error"><?= ($errors['instrument']) ?></div>
            <?php endif; ?>
            <input type="text" name="instrument">

            <input type="submit" class="pure-button inline-button" value="Save">
        </form>
    </div>

<br>


    <table class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>Your instruments</th>
                <!-- <th>Edit</th> -->
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