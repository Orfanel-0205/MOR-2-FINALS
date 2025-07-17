<h2>Vote for President</h2>

<?php foreach ($candidates as $c): ?>
    <div style="margin-bottom:20px;border:1px solid #ccc;padding:10px;">
        <img src="<?= base_url('uploads/candidates/' . $c['photo']) ?>" width="150">
        <h3><?= esc($c['name']) ?></h3>
        <p><strong>Position:</strong> <?= esc($c['position']) ?></p>

        <form method="post" action="<?= site_url('vote/' . $c['id']) ?>">
            <button type="submit">Vote</button>
        </form>
    </div>
<?php endforeach; ?>
