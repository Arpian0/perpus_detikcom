<!-- app/Views/categories/index.php -->
<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <h2>Data Kategori Buku</h2>
    <?php if (session('success')) : ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <a href="/categories/create" class="btn btn-primary mb-3">Tambah Kategori Buku</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= esc($category['name']) ?></td>
                    <td>
                        <a href="/categories/edit/<?= $category['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="/categories/delete/<?= $category['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus kategori buku ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->include('templates/footer') ?>