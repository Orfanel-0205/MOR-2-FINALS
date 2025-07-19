<!DOCTYPE html>
<html>
<head>
    <title>Candidates</title>
</head>
<body>
    <h1>Candidates for Election ID: <?= esc($electionId) ?></h1>

    <?php if (!empty($candidates)): ?>
        <ul>
        <?php foreach ($candidates as $candidate): ?>
            <li>
                <h3><?= esc($candidate['name']) ?></h3>
                <p><?= esc($candidate['description']) ?></p>

                <?php
                    $imagePath = base_url('uploads/candidates/' . $candidate['image']); 
                ?>
                <img src="<?= $imagePath ?>" alt="<?= esc($candidate['name']) ?>" style="width:150px;"><br>

                <form action="<?= base_url('vote/' . $candidate['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit">Vote</button>
                </form>
            </li>
            <hr>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No candidates available.</p>
    <?php endif; ?>
</body>
</html>
