<!-- app/Views/books/index.php -->
<?= $this->include('templates/header') ?>

<div style="padding-right: 40px;padding-left:40px;" class="mt-4">
    <h2 style="text-align: center;">Daftar Buku</h2>
    <?php if (session('success')) : ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <a href="/books/create" class="btn btn-primary mb-3">Tambah Buku</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>File Buku</th>
                <th>Cover Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?= $book['id'] ?></td>
                    <td><?= esc($book['title']) ?></td>
                    <td><?= esc($book['name']) ?></td>
                    <td><?= esc($book['description']) ?></td>
                    <td><?= $book['quantity'] ?></td>
                    <td><?= $book['book_file'] ?></td>
                    <td><?= $book['book_cover'] ?></td>
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