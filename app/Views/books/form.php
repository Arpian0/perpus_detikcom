<!-- app/Views/books/index.php -->
<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <h2>Form Buku</h2>
    <?php if (session('success')) : ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?= $book['id'] ?></td>
                    <td><?= esc($book['title']) ?></td>
                    <td><?= esc($book['category_id']) ?></td>
                    <td><?= esc($book['description']) ?></td>
                    <td><?= $book['quantity'] ?></td>
                    <td>
                        <a href="/books/edit/<?= $book['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="/books/delete/<?= $book['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus buku ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->include('templates/footer') ?>