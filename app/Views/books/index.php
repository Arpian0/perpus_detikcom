<!-- app/Views/books/index.php -->
<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <h2>Daftar Buku</h2>

    <!-- Filter dropdown to select book category -->
    <form action="<?= site_url('books') ?>" method="get">
        <div class="form-group">
            <label for="category_id">Filter berdasarkan Kategori</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Semua Kategori</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>" <?= ($selected_category && $selected_category['id'] == $category['id']) ? 'selected' : '' ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <hr>

    <!-- Display the filtered books -->
    <?php if (empty($books)) : ?>
        <p>Tidak ada buku yang sesuai dengan kategori tersebut.</p>
    <?php else : ?>
        <div class="row">
            <?php foreach ($books as $book) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= base_url('uploads/' . $book['book_cover']) ?>" class="card-img-top" alt="Cover Buku">
                        <div class="card-body">
                            <h5 class="card-title"><?= $book['title'] ?></h5>
                            <p class="card-text"><?= $book['description'] ?></p>

                            <?php if (session()->has('user_id')) : ?>
                                <?php $userRoleModel = new \App\Models\UserRoleModel(); ?>
                                <?php $userRole = $userRoleModel->getRoleByUserId(session('user_id')); ?>
                                <?php if ($userRole) : ?>
                                    <?php if ($userRole['role'] === 'user') : ?>
                                        <div style="text-align: center;">
                                            <a href="<?= site_url('books/read/' . $book['id']) ?>" class="btn btn-info">Read</a>
                                        </div>
                                    <?php elseif ($userRole['role'] === 'admin') : ?>
                                        <table class="table mt-3">
                                            <tr>
                                                <td>
                                                    <a href="<?= site_url('books/edit/' . $book['id']) ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('books/read/' . $book['id']) ?>" class="btn btn-info">Read</a>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('books/delete/' . $book['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Delete</a>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- Tampilkan seluruh menu untuk admin -->
                                        <!-- Tambahkan menu lain untuk admin di sini -->
                                    <?php endif; ?>
                                <?php endif; ?>
                                <!-- Tambahkan menu lain di sini (misalnya, Logout) -->
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->include('templates/footer') ?>