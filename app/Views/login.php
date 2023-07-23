<!-- app/Views/login.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input {
            display: block;
            width: 94%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"] {
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error-message {
            color: red;
            padding-left: 39%;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Login</h1>
    <?php if (session('error')) : ?>
        <div class="error-message">
            <?= esc(session('error')) ?><br>
        </div>
    <?php endif; ?>
    <form action="/login" method="post">
        <p>Username :</p>
        <input type="text" name="username" placeholder="Username" value="<?= old('username') ?>" required>
        <p style="padding-top: 10px;">Password :</p>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <div style="padding-top: 20px;text-align:right;">
            Belum Punya Akun? Klik <a href="/register">Register</a>
        </div>
    </form>
</body>

</html>