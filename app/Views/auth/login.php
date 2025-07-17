<!DOCTYPE html>
<html>
<head>
    <title>Login - Voting System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        h2 {
            color: #333;
        }
        form {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            background: #f9f9f9;
            border-radius: 5px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

    <h2>Login</h2>
    <h3>Welcome to the Voting System</h3>
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
