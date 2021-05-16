<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Praktikum</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <center>
        <div class="container">
            <div class="card mt-5">
                <div class=" card-header">
                    <h2>Data Praktikum</h2>
                    <a href="index.php?page=praktikum&aksi=create" class="btn btn-success float-right">Tambah Praktikum</a>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $row) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= date('Y', strtotime($row['tahun'])); ?></td>
                                    <td><?= $row['status'] == 0 ? '<span class="badge badge-danger">Tidak Aktif</span>' : '<span class="badge badge-success">Aktif</span>' ?></td>
                                    <td>
                                        <a href="index.php?page=praktikum&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                                        <?php if ($row['status'] == 0) : ?>
                                            <a href="index.php?page=praktikum&aksi=aktifkan&id=<?= $row['id'] ?>" class="btn btn-success">Aktifkan</a>
                                        <?php elseif ($row['status'] == 1) : ?>
                                            <a href="index.php?page=praktikum&aksi=nonAktifkan&id=<?= $row['id'] ?>" class="btn btn-danger">Non-Aktifkan</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </center>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.css"></script>
</body>

</html>