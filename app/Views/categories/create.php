<!-- app/Views/categories/create.php -->
<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <h2>Tambah Kategori Buku</h2>
    <?php if (session('errors')) : ?>
        <div class="alert alert-danger">
            <?php foreach (session('errors') as $error) : ?>
                <?= esc($error) ?><br>
            <?php endforeach ?>
        </div>
    <?php endif; ?>

    <form action="/categories/store" method="post">
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= old('name') ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>

<?= $this->include('templates/footer') ?>