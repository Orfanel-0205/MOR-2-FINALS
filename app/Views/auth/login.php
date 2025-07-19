<!DOCTYPE html>
<html>
<head>
    <title>Login - Voting System</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --tech-blue: #0066ff;
    --tech-purple: #8b5cf6;
    --tech-green: #10b981;
    --dark-bg: #0a0a0b;
    --card-bg: rgba(255, 255, 255, 0.05);
    --glass-border: rgba(255, 255, 255, 0.1);
    --input-bg: rgba(255, 255, 255, 0.08);
    --error-gradient: linear-gradient(135deg, #ff6b6b, #ee5a24);
    --success-gradient: linear-gradient(135deg, #00d2ff, #3a7bd5);
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: var(--dark-bg);
    background-image: 
        radial-gradient(circle at 25% 25%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 119, 198, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    overflow: hidden;
    position: relative;
}

/* Animated background particles */
body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, rgba(255, 255, 255, 0.1), transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(102, 126, 234, 0.2), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(139, 92, 246, 0.1), transparent);
    background-repeat: repeat;
    background-size: 200px 200px;
    animation: particle-drift 25s linear infinite;
    pointer-events: none;
    opacity: 0.6;
}

@keyframes particle-drift {
    0% { transform: translate(0, 0); }
    100% { transform: translate(-200px, -200px); }
}

.login-container {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 480px;
    padding: 30px;
}

.login-header {
    text-align: center;
    margin-bottom: 40px;
}

.company-logo {
    width: 60px;
    height: 60px;
    background: var(--primary-gradient);
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: 800;
    color: white;
    box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
    animation: logo-pulse 3s ease-in-out infinite;
}

@keyframes logo-pulse {
    0%, 100% { transform: scale(1); box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3); }
    50% { transform: scale(1.05); box-shadow: 0 12px 40px rgba(102, 126, 234, 0.5); }
}

h2 {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(135deg, #ffffff, #e2e8f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 8px;
    letter-spacing: -0.5px;
}

.login-subtitle {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.95rem;
    font-weight: 400;
    margin-bottom: 30px;
}

form {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 40px;
    position: relative;
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    animation: form-slide-up 0.8s ease-out;
}

@keyframes form-slide-up {
    0% { 
        opacity: 0; 
        transform: translateY(30px); 
    }
    100% { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

form::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, 
        transparent 0%, 
        var(--tech-blue) 25%, 
        var(--tech-purple) 50%, 
        var(--tech-green) 75%, 
        transparent 100%);
    animation: border-shimmer 3s ease-in-out infinite;
}

@keyframes border-shimmer {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 1; }
}

.input-group {
    position: relative;
    margin-bottom: 24px;
}

.input-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 8px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

input {
    width: 100%;
    padding: 16px 20px;
    background: var(--input-bg);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    color: white;
    font-size: 1rem;
    font-weight: 400;
    transition: all 0.3s ease;
    outline: none;
    position: relative;
}

input::placeholder {
    color: rgba(255, 255, 255, 0.4);
    font-weight: 300;
}

input:focus {
    background: rgba(255, 255, 255, 0.12);
    border-color: var(--tech-blue);
    box-shadow: 
        0 0 0 3px rgba(102, 126, 234, 0.2),
        0 4px 20px rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
}

input:focus + .input-focus-line {
    transform: scaleX(1);
}

.input-focus-line {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--primary-gradient);
    transform: scaleX(0);
    transition: transform 0.3s ease;
    border-radius: 1px;
}

button {
    width: 100%;
    padding: 18px 24px;
    background: var(--primary-gradient);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
    margin-top: 8px;
}

button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.5);
    background: linear-gradient(135deg, #7c3aed, #2563eb);
}

button:hover::before {
    left: 100%;
}

button:active {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.error {
    background: rgba(239, 68, 68, 0.1);
    color: #fca5a5;
    padding: 12px 16px;
    border-radius: 10px;
    border: 1px solid rgba(239, 68, 68, 0.2);
    margin-top: 16px;
    font-size: 0.875rem;
    font-weight: 500;
    position: relative;
    animation: error-shake 0.5s ease-out;
}

@keyframes error-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.error::before {
    content: '⚠️';
    margin-right: 8px;
    font-size: 1rem;
}

.success {
    background: rgba(16, 185, 129, 0.1);
    color: #6ee7b7;
    padding: 12px 16px;
    border-radius: 10px;
    border: 1px solid rgba(16, 185, 129, 0.2);
    margin-top: 16px;
    font-size: 0.875rem;
    font-weight: 500;
    animation: success-slide 0.5s ease-out;
}

@keyframes success-slide {
    0% { opacity: 0; transform: translateY(-10px); }
    100% { opacity: 1; transform: translateY(0); }
}

.success::before {
    content: '✅';
    margin-right: 8px;
    font-size: 1rem;
}

.forgot-password {
    text-align: center;
    margin-top: 24px;
}

.forgot-password a {
    color: rgba(255, 255, 255, 0.6);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
}

.forgot-password a:hover {
    color: var(--tech-blue);
}

.forgot-password a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1px;
    background: var(--tech-blue);
    transition: width 0.3s ease;
}

.forgot-password a:hover::after {
    width: 100%;
}

.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.8s ease-in-out infinite;
    margin-right: 8px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}


@media (max-width: 768px) {
    .login-container {
        padding: 20px;
        max-width: 100%;
    }
    
    form {
        padding: 30px 20px;
        border-radius: 16px;
    }
    
    h2 {
        font-size: 1.75rem;
    }
    
    input, button {
        padding: 14px 16px;
    }
}


@media (prefers-color-scheme: dark) {
    input:focus {
        box-shadow: 
            0 0 0 3px rgba(139, 92, 246, 0.2),
            0 4px 20px rgba(139, 92, 246, 0.15);
    }
}


@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
    </style>
</head>
<body>

   
    
    <p>Please enter your username and password.<br>
       Example accounts:<br>
       <b>Username:</b> Keith A Moto, <b>Password:</b> Motovlogger</p>

    <?php if (session()->getFlashdata('error')): ?>
        <p class="error"><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/attemptLogin') ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
    </form>

</body>
</html>
