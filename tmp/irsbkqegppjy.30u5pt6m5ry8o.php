<form class="pure-form" method="post">
    <!-- display the time span -->
<h2>You Earned</h2>
    <!-- display the earning -->
<h3><input type="text"  class="display" id="display" value="<?= ($sum) ?> Euro" readonly></h3>

<h3>Filter Options</h3>
<table class="pure-table pure-table-bordered" >
        <tbody>
            
<tr>
<td><strong>Source</strong></td>
<td><select name="studentSourceId">
    <option value="">No Filters</option>
    <option value="1">Private</option>
    <option value="2">MusikMomente</option>
    <option value="3">LessonDo</option>
    <option value="4">MUK</option>
</select></td>
</tr>
<tr>
<td><strong>Date</strong></td>
<td><select name="studentSourceId">
    <option value="">No Filters</option>
    <option value="1">Private</option>
    <option value="2">MusikMomente</option>
    <option value="3">LessonDo</option>
    <option value="4">MUK</option>
</select></td>
</tr>
</tbody>
</table>


<p><button type="submit" class="pure-button">GO</button></p>

<!-- TODO: attivare il select box come nelle altre parti dell'applicazione, inserire select by date! -->


</form>





