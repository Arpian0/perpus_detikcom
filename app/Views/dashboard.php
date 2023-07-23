<!-- app/Views/dashboard.php -->

<?= $this->include('templates/header') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Selamat datang, <?= esc($username) ?>!</h1>
    <p>Ini adalah halaman dashboard Anda.</p>
</body>

</html>

<?= $this->include('templates/footer') ?>