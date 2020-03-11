<form class="pure-form pure-form-stacked">
    <p><button type="submit" formaction="<?= (Base::instance()->alias('insertGig')) ?>" class="pure-button">Add new</button></p>
</form>
<table class="pure-table pure-table-bordered list-align">
    <thead>
        <tr>
            <th>Nr</th>
            <th>Date</th>
            <th>Event Type</th>
            <th>Earning</th>
            <th>Details</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php $ctr=0; foreach (($gigs?:[]) as $row): $ctr++; ?>
            
            <tr>
                <td><?= ($ctr) ?></td>
                <td><?= ($row['date']) ?></td>
                <td><?= ($row['event_type']) ?></td>
                <td><?= ($row['earning']) ?> Euro</td>
                <td><a href="/gigs/<?= ($row['id']) ?>/details">Details</a></td>
                <td><a href="/gigs/<?= ($row['id']) ?>/edit">Edit</a></td>
                <td><button class="pure-button btn-delete"
                        data-url="/gigs/<?= ($row['id']) ?>/delete">Delete</button></td>
            </tr>

            
        <?php endforeach; ?>

    </tbody>
</table>