<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presidential Candidates: <?= esc($election['title'] ?? '') ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="election-container">
        <h2>Presidential Candidates: <?= esc($election['title'] ?? '') ?></h2>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger"><?= esc(session('error')) ?></div>
        <?php endif; ?>

        <?php if (session()->has('success')): ?>
            <div class="alert alert-success"><?= esc(session('success')) ?></div>
        <?php endif; ?>

        <div class="candidates-grid">
            <?php if (!empty($candidates)): ?>
                <?php foreach ($candidates as $candidate): ?>
                    <?php
                        $imgMap = [
                            'Kathryn Bernardog' => 'president.jpg',
                            'Jisun Titum' => 'president2.jpg',
                            'Carlos Yolo' => 'president3.jpg',
                            'Dionela Salvador Akumshumika' => 'president5.jpg' 
                        ];
                        $imgSrc = $imgMap[$candidate['name']] ?? 'default.jpg';
                    ?>
                    <div class="candidate-card">
                        <!-- Correct image path - remove 'public/' from the path -->
                        <img src="<?= base_url('uploads/' . $imgSrc) ?>" 
                             alt="<?= esc($candidate['name']) ?>"
                             class="candidate-image"
                             onerror="this.onerror=null;this.src='<?= base_url('uploads/default.jpg') ?>'">
                        <div class="card-body">
                            <h3><?= esc($candidate['name']) ?></h3>
                            <p class="position"><?= esc($candidate['position']) ?></p>
                            <form method="post" action="<?= site_url('vote/cast/' . $election['id']) ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="candidate_id" value="<?= esc($candidate['id']) ?>">
                                <button type="submit" class="vote-btn">
                                    Vote for <?= esc($candidate['name']) ?>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-candidates">No candidates found for this election.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
