<!-- app/Views/templates/header.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Perpustakaan</title>
    <!-- Tambahkan link CSS Bootstrap di sini -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Untuk ekspor ke Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

    <!-- Untuk ekspor ke PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/dashboard">Sistem Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul style="padding-left: 810px;" class="navbar-nav">
                    <?php if (session()->has('user_id')) : ?>
                        <?php $userRoleModel = new \App\Models\UserRoleModel(); ?>
                        <?php $userRole = $userRoleModel->getRoleByUserId(session('user_id')); ?>
                        <?php if ($userRole) : ?>
                            <?php if ($userRole['role'] === 'user') : ?>
                                <li style="padding-left: 200px;" class="nav-item">
                                    <a class="nav-link" href="/books">Daftar Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/books/form">Form Data Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/categories">Data Kategori Buku</a>
                                </li>
                            <?php elseif ($userRole['role'] === 'admin') : ?>
                                <li style="padding-left: 100px;" class="nav-item">
                                    <a class="nav-link" href="/books/form">Form Data Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/books">Daftar Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/books/create">Tambah Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/categories">Data Kategori Buku</a>
                                </li>
                                <!-- Tampilkan seluruh menu untuk admin -->
                                <!-- Tambahkan menu lain untuk admin di sini -->
                            <?php endif; ?>
                        <?php endif; ?>
                        <!-- Tambahkan menu lain di sini (misalnya, Logout) -->
                        <li style="padding-left: 200px;" class="nav-item">
                            <a class="nav-link btn btn-danger" href="/logout">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <main>