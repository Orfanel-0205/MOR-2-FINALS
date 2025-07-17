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

    <!-- Voting Statistics (Optional) -->
    <div class="voting-stats">
        <div class="vote-count">Total Votes: <span id="totalVotes">0</span></div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: 0%"></div>
        </div>
        <p>Make your voice heard! Every vote counts.</p>
    </div>

    <div class="candidates-container">
        <?php if (!empty($candidates)): ?>
            <?php foreach ($candidates as $candidate): ?>
                <?php
                    // Image selection logic
                    $imgSrc = 'president.jpg'; // Default fallback
                    switch ($candidate['name']) {
                        case 'Kathryn Bernardog':
                            $imgSrc = 'president.jpg';
                            break;
                        case 'Jisun Titum':
                            $imgSrc = 'president2.jpg';
                            break;
                        case 'Carlos Yolo':
                            $imgSrc = 'president3.jpg';
                            break;
                        case 'Dionela Salvador Akumshumika':
                            $imgSrc = 'president4.jpg';
                            break;
                    }
                ?>
                <div class="candidate-card" data-candidate-id="<?= esc($candidate['id']) ?>">
                    <img src="<?= base_url('uploads/' . $imgSrc) ?>"
                         alt="<?= esc($candidate['name']) ?>"
                         onerror="this.src='<?= base_url('assets/images/default-avatar.png') ?>'">

                    <div class="candidate-info">
                        <h3><?= esc($candidate['name']) ?></h3>
                        <strong><?= esc($candidate['position']) ?></strong>

                        <?php
                        // Platform details based on candidate name
                        switch ($candidate['name']) {
                            case 'Kathryn Bernardog':
                                echo '<ul>
                                    <li>📘 Goshon Leadership Academy</li>
                                    <li>🔍 Monthly "Voice of the Team" sessions</li>
                                    <li>💬 Anonymous feedback portal</li>
                                </ul>';
                                break;
                            case 'Jisun Titum':
                                echo '<ul>
                                    <li>💻 Tech Passport Program</li>
                                    <li>🤖 AI chatbots for support</li>
                                    <li>📊 Weekly customer satisfaction dashboard</li>
                                </ul>';
                                break;
                            case 'Carlos Yolo':
                                echo '<ul>
                                    <li>🔧 Zero-Lag Initiative</li>
                                    <li>🚀 ERP optimization</li>
                                    <li>📦 Predictive inventory with ML</li>
                                </ul>';
                                break;
                            case 'Dionela Salvador Akumshumika':
                                echo '<ul>
                                    <li>🌿 Green Goshon Campaign</li>
                                    <li>🚌 Donate PCs to schools</li>
                                    <li>🏞️ Staff volunteer days</li>
                                </ul>';
                                break;
                        }
                        ?>

                        <form class="vote-form" method="post" action="<?= site_url('vote/' . $election_id) ?>">
                            <input type="hidden" name="candidate_id" value="<?= esc($candidate['id']) ?>">
                            <div class="vote-button-container">
                                <button type="submit" class="vote-btn" data-candidate="<?= esc($candidate['name']) ?>">
                                    Vote for <?= esc($candidate['name']) ?>
                                </button>
                                <div class="vote-success">
                                    <span>✓ Vote Submitted!</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-candidates">
                <p>No candidates available for this election.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
