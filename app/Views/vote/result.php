<!DOCTYPE html>
<html>
<head>
    <title>Election Results</title>
    <link rel="stylesheet" href="<?= base_url('asset/candidate.css') ?>">
</head>
<body>
    <h1>Election Results</h1>

    <ul>
        <?php foreach ($candidates as $candidate): ?>
            <li>
                <strong><?= esc($candidate['name']) ?></strong><br>
                <?= esc($candidate['description']) ?><br>
                <img src="<?= base_url('uploads/' . $candidate['image']) ?>" width="150"><br>
                <strong>Votes: <?= esc($candidate['votes']) ?></strong>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>

    <a href="<?= base_url('vote/candidates/' . $election_id) ?>">Back to Voting</a>
</body>
</html>
