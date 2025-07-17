<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presidential Candidates: <?= esc($election_id) ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/candidate.css') ?>">
</head>
<body>
    <h2>Presidential Candidates: <?= esc($election_id) ?></h2>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session('error')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('success')): ?>
        <div class="alert alert-success">
            <?= esc(session('success')) ?>
        </div>
    <?php endif; ?>

    <div class="candidates-container">
        <?php if (!empty($candidates)): ?>
            <?php foreach ($candidates as $candidate): ?>
                <?php
                    $imgSrc = 'president.jpg';
                    switch ($candidate['name']) {
                        case 'Kathryn Bernardog': $imgSrc = 'president.jpg'; break;
                        case 'Jisun Titum': $imgSrc = 'president2.jpg'; break;
                        case 'Carlos Yolo': $imgSrc = 'president3.jpg'; break;
                        case 'Dionela Salvador Akumshumika': $imgSrc = 'president4.jpg'; break;
                    }
                ?>
                <div class="candidate-card">
                    <img src="<?= base_url('uploads/' . $imgSrc) ?>" alt="<?= esc($candidate['name']) ?>">
                    <div class="candidate-info">
                        <h3><?= esc($candidate['name']) ?></h3>
                        <strong><?= esc($candidate['position']) ?></strong>
                        <form method="post" action="<?= site_url('vote/cast/' . $election_id) ?>">
                            <input type="hidden" name="candidate_id" value="<?= esc($candidate['id']) ?>">
                            <?= csrf_field() ?>
                            <button type="submit">Vote for <?= esc($candidate['name']) ?></button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No candidates found for this election.</p>
        <?php endif; ?>
    </div>
</body>

</html>


