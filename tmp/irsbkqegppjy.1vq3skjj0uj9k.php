<!-- in case i want to show an alert success with php -->
<?php echo $this->render('/Views/modules/alert.html',NULL,get_defined_vars(),0); ?>
<div>
    <button class="pure-button" onclick="openCity('London')">Instruments</button>
    <button class="pure-button" onclick="openCity('Paris')">Gig Types</button>
    <button class="pure-button" onclick="openCity('Tokyo')">Student Source</button>
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






    
</div>

<div id="Paris" class="city" style="display:none">
    <h2>Paris</h2>
    <p>Paris is the capital of France.</p>
</div>

<div id="Tokyo" class="city" style="display:none">
    <h2>Tokyo</h2>
    <p>Tokyo is the capital of Japan.</p>
</div>

