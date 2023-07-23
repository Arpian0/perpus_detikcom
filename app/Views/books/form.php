<!-- app/Views/books/index.php -->
<?= $this->include('templates/header') ?>

<!-- For Excel export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

<!-- For PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<div style="margin-left: 20px;margin-right:20px;" class=" mt-4">
    <h2 style="text-align: center;">Form Buku</h2>
    <?php if (session('success')) : ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('user_id')) : ?>
        <?php $userRoleModel = new \App\Models\UserRoleModel(); ?>
        <?php $userRole = $userRoleModel->getRoleByUserId(session('user_id')); ?>
        <?php if ($userRole) : ?>
            <?php if ($userRole['role'] === 'user') : ?>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Nama File Buku</th>
                            <th>Nama File Cover Buku</th>
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
                                <td><?= $book['book_file'] ?></td>
                                <td><?= $book['book_cover'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <div class="mt-4">
                        <button onclick="exportToExcel()" class="btn btn-success">Export to Excel</button>
                        <button onclick="exportToPDF()" class="btn btn-primary">Export to PDF</button>
                    </div>
                </table>

            <?php elseif ($userRole['role'] === 'admin') : ?>

                <!-- Tampilkan seluruh menu untuk admin -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Nama File Buku</th>
                            <th>Nama File Cover Buku</th>
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
                                <td><?= $book['book_file'] ?></td>
                                <td><?= $book['book_cover'] ?></td>
                                <td>
                                    <a href="/books/edit/<?= $book['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="/books/delete/<?= $book['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus buku ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <div class="mt-4">
                        <button onclick="exportToExcel()" class="btn btn-success">Export to Excel</button>
                        <button onclick="exportToPDF()" class="btn btn-primary">Export to PDF</button>
                    </div>
                </table>
                <!-- Tambahkan menu lain untuk admin di sini -->

            <?php endif; ?>
        <?php endif; ?>
        <!-- Tambahkan menu lain di sini (misalnya, Logout) -->
    <?php endif; ?>
</div>

<?= $this->include('templates/footer') ?>

<script>
    function exportToExcel() {
        const table = document.querySelector('table');
        const wb = XLSX.utils.table_to_book(table);
        const wbout = XLSX.write(wb, {
            bookType: 'xlsx',
            type: 'array'
        });
        saveAsExcelFile(wbout, 'books.xlsx');
    }

    function saveAsExcelFile(buffer, filename) {
        const blob = new Blob([buffer], {
            type: 'application/octet-stream'
        });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        a.click();
        URL.revokeObjectURL(url);
    }

    function exportToPDF() {
        // Get the table element by its class or ID (replace 'tableClassName' with your table's class or ID)
        const table = document.querySelector('.table');

        // Options for the PDF export
        const options = {
            margin: 10,
            filename: 'books.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'mm',
                format: 'a3',
                orientation: 'landscape'
            }
        };

        // Generate the PDF
        html2pdf()
            .from(table)
            .set(options)
            .save();
    }
</script>