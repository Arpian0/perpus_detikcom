<!-- app/Views/books/create.php -->
<?= $this->include('templates/header') ?>


<div class="container mt-4">
    <h2>Tambah Buku</h2>
    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger">
            <?php foreach (session('errors') as $error) : ?>
                <?= esc($error) ?><br>
            <?php endforeach ?>
        </div>
    <?php endif; ?>

    <form style="margin-bottom: 40px;" action="<?= site_url('books/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="title">Judul Buku</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= old('title') ?>" required>
        </div>
        <div class="form-group">
            <label for="category_id">Kategori Buku</label>
            <select class="form-control" name="category_id" id="category_id" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"><?= esc($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" name="description" id="description" rows="4" required><?= old('description') ?></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Jumlah</label>
            <input type="number" class="form-control" name="quantity" id="quantity" value="<?= old('quantity') ?>" required>
        </div>
        <div class="form-group">
            <label for="book_file">Upload File Buku (PDF)</label>
            <input type="file" class="form-control-file" name="book_file" id="book_file" accept=".pdf" required>
        </div>
        <div class="form-group">
            <label for="book_cover">Upload Cover Buku (jpeg/jpg/png)</label>
            <input type="file" class="form-control-file" name="book_cover" id="book_cover" accept=".jpeg,.jpg,.png" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>


<?= $this->include('templates/footer') ?>