<form class="pure-form pure-form-stacked">
    <p><button type="submit" formaction="<?= (Base::instance()->alias('selectStudentForALesson')) ?>" class="pure-button">New
            Lesson</button></p>

    <p><button type="submit" formaction="<?= (Base::instance()->alias('seeLessons')) ?>" class="pure-button">Previous Lessons</button></p>

<!--     
    
    TODO: insert the possibility to have multiple lessons
    <p><button type="submit" formaction="<?= (Base::instance()->alias('seeAllStudents')) ?>" class="pure-button">Multiple Lesson</button></p> -->
</form>