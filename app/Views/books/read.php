<!-- app/Views/books/read.php -->
<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <h2>Detail Buku</h2>
    <hr>
    <div class="card">
        <img src="<?= base_url('uploads/' . $book['book_cover']) ?>" class="card-img-top" alt="Cover Buku">
        <div class="card-body">
            <h5 class="card-title"><?= $book['title'] ?></h5>
            <p class="card-text"><?= $book['description'] ?></p>
            <p class="card-text">Jumlah: <?= $book['quantity'] ?></p>
            <a href="<?= site_url('books') ?>" class="btn btn-secondary">Kembali ke Daftar Buku</a>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>