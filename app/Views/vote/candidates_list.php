<h2>Candidates for Election <?= esc($electionId) ?></h2>

<ul>
<?php foreach ($candidates as $candidate): ?>
    <li>
        <img src="/uploads/<?= esc($candidate['photo']) ?>" alt="<?= esc($candidate['name']) ?>" width="100">
        <?= esc($candidate['name']) ?>
        <form action="/vote/<?= esc($candidate['id']) ?>" method="post">
            <button type="submit">Vote</button>
        </form>
    </li>
<?php endforeach; ?>
</ul>
