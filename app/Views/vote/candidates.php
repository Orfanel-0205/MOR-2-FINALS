<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presidential Candidates: <?= esc($election['title'] ?? '') ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style.css'); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --tech-blue: #0066ff;
    --tech-purple: #8b5cf6;
    --tech-green: #10b981;
    --tech-orange: #f59e0b;
    --dark-bg: #0a0a0b;
    --card-bg: rgba(255, 255, 255, 0.05);
    --glass-border: rgba(255, 255, 255, 0.1);
    --neon-glow: 0 0 30px rgba(102, 126, 234, 0.4);
}

* {
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: var(--dark-bg);
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);
    min-height: 100vh;
    color: white;
    overflow-x: hidden;
}

.election-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px 20px;
    position: relative;
}

.election-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, 
        transparent 0%, 
        var(--tech-blue) 25%, 
        var(--tech-purple) 50%, 
        var(--tech-green) 75%, 
        transparent 100%);
    animation: pulse-line 3s ease-in-out infinite;
}

@keyframes pulse-line {
    0%, 100% { opacity: 0.3; transform: scaleX(0.8); }
    50% { opacity: 1; transform: scaleX(1.1); }
}

.election-header {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
}

.election-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradient-shift 4s ease-in-out infinite;
    margin-bottom: 20px;
    text-shadow: 0 0 50px rgba(102, 126, 234, 0.3);
}

@keyframes gradient-shift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.election-subtitle {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 300;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.candidates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.candidate-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    overflow: hidden;
    position: relative;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transform: translateY(0);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.candidate-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--tech-blue), var(--tech-purple), var(--tech-green));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.candidate-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 
        0 25px 60px rgba(0, 0, 0, 0.4),
        var(--neon-glow),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    border-color: rgba(102, 126, 234, 0.5);
}

.candidate-card:hover::before {
    opacity: 1;
    animation: rainbow-flow 2s linear infinite;
}

@keyframes rainbow-flow {
    0% { background-position: 0% 50%; }
    100% { background-position: 200% 50%; }
}

.candidate-card:nth-child(2n):hover {
    --neon-glow: 0 0 30px rgba(139, 92, 246, 0.4);
}

.candidate-card:nth-child(3n):hover {
    --neon-glow: 0 0 30px rgba(16, 185, 129, 0.4);
}

.candidate-image {
    width: 100%;
    height: 320px;
    object-fit: cover;
    transition: all 0.6s ease;
    position: relative;
    filter: grayscale(0.3) contrast(1.1);
}

.candidate-card:hover .candidate-image {
    transform: scale(1.1);
    filter: grayscale(0) contrast(1.2) brightness(1.1);
}

.card-body {
    padding: 30px;
    position: relative;
}

.candidate-name {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 8px;
    background: linear-gradient(135deg, #ffffff, #e2e8f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.candidate-title {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.95rem;
    font-weight: 500;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.platform-details {
    margin: 20px 0;
    padding: 0;
    list-style: none;
}

.platform-details li {
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    line-height: 1.5;
    transition: all 0.3s ease;
    position: relative;
    padding-left: 20px;
}

.platform-details li::before {
    content: '→';
    position: absolute;
    left: 0;
    color: var(--tech-blue);
    font-weight: bold;
    transition: all 0.3s ease;
}

.platform-details li:hover {
    color: white;
    padding-left: 25px;
}

.platform-details li:hover::before {
    color: var(--tech-green);
    transform: translateX(3px);
}

.platform-details li:last-child {
    border-bottom: none;
}

.vote-btn {
    background: linear-gradient(135deg, var(--tech-blue), var(--tech-purple));
    color: white;
    border: none;
    padding: 16px 24px;
    border-radius: 50px;
    cursor: pointer;
    width: 100%;
    font-weight: 600;
    font-size: 1rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.vote-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.vote-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
    background: linear-gradient(135deg, var(--tech-purple), var(--tech-green));
}

.vote-btn:hover::before {
    left: 100%;
}

.vote-btn:active {
    transform: translateY(0);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.alert {
    padding: 20px;
    margin-bottom: 30px;
    border-radius: 16px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
    overflow: hidden;
}

.alert::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    animation: alert-pulse 2s ease-in-out infinite;
}

.alert-danger {
    background: rgba(248, 113, 113, 0.1);
    color: #fca5a5;
    border-left-color: #ef4444;
}

.alert-danger::before {
    background: #ef4444;
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    color: #6ee7b7;
    border-left-color: var(--tech-green);
}

.alert-success::before {
    background: var(--tech-green);
}

@keyframes alert-pulse {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

.no-candidates {
    text-align: center;
    padding: 80px 20px;
    color: rgba(255, 255, 255, 0.5);
    font-size: 1.2rem;
    font-weight: 300;
}

.no-candidates::before {
    content: '🚀';
    display: block;
    font-size: 4rem;
    margin-bottom: 20px;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}


.election-container::after {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, rgba(255, 255, 255, 0.1), transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(102, 126, 234, 0.2), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(139, 92, 246, 0.1), transparent),
        radial-gradient(1px 1px at 130px 80px, rgba(16, 185, 129, 0.1), transparent);
    background-repeat: repeat;
    background-size: 150px 150px;
    animation: particle-move 20s linear infinite;
    pointer-events: none;
    z-index: -1;
}

@keyframes particle-move {
    0% { transform: translate(0, 0); }
    100% { transform: translate(-150px, -150px); }
}


@media (max-width: 768px) {
    .candidates-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .candidate-card {
        margin: 0 10px;
    }
    
    .election-container {
        padding: 20px 10px;
    }
    
    .card-body {
        padding: 20px;
    }
}


.candidate-card.loading {
    animation: card-loading 1.5s ease-in-out infinite;
}

@keyframes card-loading {
    0%, 100% { opacity: 0.7; transform: scale(0.95); }
    50% { opacity: 1; transform: scale(1); }
}


.vote-success {
    animation: vote-celebration 0.6s ease-out;
}

@keyframes vote-celebration {
    0% { transform: scale(1); }
    25% { transform: scale(1.05); }
    50% { transform: scale(0.95); }
    100% { transform: scale(1); }
}
    </style>
</head>
<body>
    <div class="election-container">
        <h2>Goshon Technologies Incorporation: <?= esc($election['title'] ?? '') ?></h2>

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
                            'Dionela Salvador Akumshumika' => 'president5.jpg.jpg' 
                        ];
                        $imgSrc = $imgMap[$candidate['name']] ?? 'default.jpg';
                    ?>
                    <div class="candidate-card">
                        <img src="<?= base_url('Public/uploads/' . $imgSrc) ?>" 
                             alt="<?= esc($candidate['name']) ?>"
                             class="candidate-image"
                             onerror="this.onerror=null;this.src='<?= base_url('Public/uploads/default.jpg') ?>'">
                        <div class="card-body">
                            <h3><?= esc($candidate['name']) ?></h3>
                            <p class="position"><?= esc($candidate['position']) ?></p>
                            
                            <div class="platform-details">
                                <?php switch ($candidate['name']):
                                    case 'Kathryn Bernardog': ?>
                                        <ul class="platform-details">
                                            <li>📘 Goshon Leadership Academy</li>
                                            <li>🔍 Monthly "Voice of the Team" sessions</li>
                                            <li>💬 Anonymous feedback portal</li>
                                        </ul>
                                        <?php break; ?>
                                    <?php case 'Jisun Titum': ?>
                                        <ul class="platform-details">
                                            <li>💻 Tech Passport Program</li>
                                            <li>🤖 AI chatbots for support</li>
                                            <li>📊 Weekly customer satisfaction dashboard</li>
                                        </ul>
                                        <?php break; ?>
                                    <?php case 'Carlos Yolo': ?>
                                        <ul class="platform-details">
                                            <li>🔧 Zero-Lag Initiative</li>
                                            <li>🚀 ERP optimization</li>
                                            <li>📦 Predictive inventory with ML</li>
                                        </ul>
                                        <?php break; ?>
                                    <?php case 'Dionela Salvador Akumshumika': ?>
                                        <ul class="platform-details">
                                            <li>🌿 Green Goshon Campaign</li>
                                            <li>🚌 Donate PCs to schools</li>
                                            <li>🏞️ Staff volunteer days</li>
                                        </ul>
                                        <?php break; ?>
                                <?php endswitch; ?>
                            </div>

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
