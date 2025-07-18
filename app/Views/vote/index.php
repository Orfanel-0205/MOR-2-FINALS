<h2>Current Elections</h2>

<?php if (!empty($elections)): ?>
    <?php foreach ($elections as $election): ?>
        <div style="margin-bottom:20px;border:1px solid #ccc;padding:10px;">
            <h3><?= esc($election['title']) ?></h3>
            <p><?= esc($election['description']) ?></p>
            <p>
                <strong>Status:</strong> <?= esc($election['status']) ?><br>
                <strong>Dates:</strong> <?= date('M j, Y', strtotime($election['start_date'])) ?> to <?= date('M j, Y', strtotime($election['end_date'])) ?>
            </p>
            <a href="<?= site_url('vote/candidates/' . $election['id']) ?>" class="btn btn-primary">
                View Candidates
            </a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No active elections at this time.</p>
<?php endif; ?>
