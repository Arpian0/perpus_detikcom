<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        input {
            width: 94%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <?php if (session('errors')) : ?>
            <div class="error">
                <?php foreach (session('errors') as $error) : ?>
                    <?= esc($error) ?><br>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
        <form action="/register" method="post">
            <input type="text" name="username" placeholder="Username" value="<?= old('username') ?>" required><br>
            <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <button type="submit">Register</button>
        </form>
        <div style="text-align: right;">
            Sudah Punya Akun? Klik <a href="/login">Login</a>
        </div>
    </div>
</body>

</html>