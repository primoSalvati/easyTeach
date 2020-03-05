<form class="pure-form pure-form-stacked">
    <p><button type="submit" formaction="<?= (Base::instance()->alias('addNewStudent')) ?>" class="pure-button">Add new</button></p>

    <p><button type="submit" formaction="<?= (Base::instance()->alias('seeAllStudents')) ?>" class="pure-button">See All</button></p>
</form>