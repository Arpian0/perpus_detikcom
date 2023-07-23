<!-- app/Views/templates/header.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Perpustakaan</title>
    <!-- Tambahkan link CSS Bootstrap di sini -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/">Sistem Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
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
                </ul>
            </div>
        </nav>
    </header>
    <main>