
<table class="pure-table pure-table-striped" id="detailsTable">
    <tbody>
        <tr>
            <td><strong>Event Type</strong></td>
            <td><?= ($gigDetails['event_type']) ?></td>
        </tr>
        <tr>
            <td><strong>Date</strong></td>
            <td><?= ($gigDetails['format_date']) ?></td>
        </tr>
        <tr>
            <td><strong>Time</strong></td>
            <td><?= ($gigDetails['time']) ?></td>
        </tr>
        <tr>
            <td><strong>Earning</strong></td>
            <td><?= ($gigDetails['earning']) ?> Euro</td>
        </tr>
        <tr>
            <td><strong>Address</strong></td>
            <td><?= ($gigDetails['address']) ?></td>
        </tr>
        <tr>
            <td><strong>Notes</strong></td>
            <td><?= ($gigDetails['notes']) ?></td>
        </tr>
    </tbody>
</table>
</br>
<form class="pure-form pure-form-stacked">

    <button type="submit" formaction="/gigs/<?= ($gigDetails['id']) ?>/edit"
        class="pure-button">Edit</button>

    <button type="submit" formaction="<?= (Base::instance()->alias('gigs')) ?>" class="pure-button">See All</button>

</form>


