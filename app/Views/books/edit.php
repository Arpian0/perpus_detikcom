<!-- app/Views/books/edit.php -->
<?= $this->include('templates/header') ?>

<body>
    <?php if (session('errors')) : ?>
        <div style="color: red;">
            <?php foreach (session('errors') as $error) : ?>
                <?= esc($error) ?><br>
            <?php endforeach ?>
        </div>
    <?php endif; ?>

    <form style="margin-bottom: 40px;" class="container mt-4" action="<?= site_url('books/update/' . $book['id']) ?>" method="post" enctype="multipart/form-data">
        <h1 style="text-align: center;">Edit Buku</h1>
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="title">Judul Buku</label>
            <input type="text" class="form-control" name="title" value="<?= $book['title'] ?>" required>
        </div>

        <div class="form-group">
            <label for="category_id">Kategori Buku</label>
            <select class="form-control" name="category_id" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>" <?= ($book['category_id'] == $category['id']) ? 'selected' : '' ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" name="description" rows="3" required><?= $book['description'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Jumlah</label>
            <input type="number" class="form-control" name="quantity" value="<?= $book['quantity'] ?>" required>
        </div>

        <div class="form-group">
            <label for="book_file">Upload File Buku (PDF)</label>
            <input type="file" class="form-control-file" name="book_file">
        </div>

        <div class="form-group">
            <label for="book_cover">Upload Cover Buku (jpeg/jpg/png)</label>
            <input type="file" class="form-control-file" name="book_cover">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</body>
<?= $this->include('templates/footer') ?>