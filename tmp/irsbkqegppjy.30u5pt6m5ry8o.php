<form class="pure-form" method="post">
<h2>You Earned</h2>
    <!-- display the earning -->
<h3><input type="text"  class="display" id="display" value="<?= (empty($sum) ? 0 : $sum) ?> Euro" readonly></h3>

<h3>Filter Options</h3>
<div>
<label for="studentSourceId">Source</label>
    <select name="studentSourceId">
        <option value="">All Sources</option>
        <?php foreach (($student_sources?:[]) as $student_source): ?>
            <!-- the ternary operat below is meant to keep the selected value after the filtering -->
            <option value="<?= ($student_source['id']) ?>"
                <?= (($student_source['id'] == $selected_source) ? ('selected') : ('')) ?>>
                <?= ($student_source['source'])."
" ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="date" name="startDate">
    <input type="date" name="endDate">

<p><button type="submit" class="pure-button">GO</button></p>

</div>




<!-- TODO: inserire select by date! -->


</form>






