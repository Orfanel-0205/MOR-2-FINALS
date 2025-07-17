<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Election Results</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>"> <!-- Optional: External CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .results-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .candidate {
            margin: 15px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fafafa;
        }
        .candidate strong {
            display: block;
            font-size: 18px;
            color: #222;
        }
        .votes {
            color: #555;
        }
    </style>
</head>
<body>

<div class="results-container">
    <h2>Election Results</h2>

    <?php if (!empty($candidates)) : ?>
        <?php foreach ($candidates as $candidate) : ?>
            <div class="candidate">
                <strong><?= esc($candidate['name']) ?></strong>
                <span class="votes">Votes: <?= esc($candidate['votes']) ?></span>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No candidates found for this election.</p>
    <?php endif; ?>
</div>

</body>
</html>
