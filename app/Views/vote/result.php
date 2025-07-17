<!DOCTYPE html>
<html>
<head>
    <title>Election Results</title>
</head>
<body>
    <h1>Election Results for Election ID: <?= esc($election_id) ?></h1>

    <?php if (!empty($candidates)): ?>
        <ul>
        <?php foreach ($candidates as $candidate): ?>
            <li>
                <h3><?= esc($candidate['name']) ?></h3>
                <p>Votes: <?= esc($candidate['votes']) ?></p>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No candidates found for this election.</p>
    <?php endif; ?>

    <p><a href="<?= base_url('/') ?>">Back to Elections</a></p>
</body>
</html>
