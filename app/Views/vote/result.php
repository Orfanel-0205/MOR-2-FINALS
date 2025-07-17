<h2>Presidential Election Results</h2>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Votes</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($candidates as $c): ?>
        <tr>
            <td><?= esc($c['name']) ?></td>
            <td><?= esc($c['position']) ?></td>
            <td><?= esc($c['vote_count']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
