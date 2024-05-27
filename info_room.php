<?php 
include 'functions.php';
$id = $_GET['id'];
if(!isset($id)){
    header("Location:index.php");
}

$admin = query("SELECT * FROM tb_admin WHERE id_admin = $id");
$kamar = query("SELECT * FROM kamar");

if(isset($_POST['submit'])){
    updateKamar($_POST);
}
else if(isset($_POST["tambah_kamar"])){
    tambahKamar($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
    <header class="navbar navbar-dark navbar-expand-lg bg-dark flex-column flex-md-row my-auto align-items-center">
        <nav class="container-xxl flex-wrap flex-md-nowrap">
            <img class="navbar-brand p-0 img-fluid px-3" src="assets/logo_papikost.jpg" style="max-height:50px;border-radius:100%;">
            <div class="collapse navbar-collapse">
                <p class="h2 text-white fw-bold fs-20 pt-2" style="font-family:'Courier New', Courier, monospace;">Papikost</p>
                <p class="text-white ms-md-auto my-auto"><?= $admin[0]["nama"] ?></p>
                <div class="nav-item dropdown no-caret dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/icon_user.png" style="max-height:50px;"></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="assets/icon_user.png">
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?= $admin[0]["nama"] ?></div>
                                <div class="dropdown-user-details-email"><?= $admin[0]["email"] ?></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="profile_admin.php?id=<?= $id ?>">
                            <div class="dropdown-item-icon"></div>
                            Akun
                        </a>
                        <a class="dropdown-item text-danger" href="index.php">
                            <div class="dropdown-item-icon"></div>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid">
        <div class="row flex-nowrap" id="sideBar">
            <div class="d-flex flex-column p-3 bg-light col-sm-4 col-md-3 col-xl-2">
                <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4 mx-auto">Sidebar</span>
                </div><hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="dashboard_admin.php?id=<?= $id ?>" class="nav-link link-dark" aria-current="page">Halaman Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="insert_tagihan.phpid=<?= $id ?>" class="nav-link link-dark">Tambah Tagihan</a>
                    </li>
                    <li class="nav-item">
                        <a href="info_bill.php?id=<?= $id ?>" class="nav-link link-dark">Info Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a href="info_room.php?id=<?= $id ?>" class="nav-link active">Info Kamar</a>
                    </li>
                    <li class="nav-item">
                        <a href="register_admin.php?id=<?= $id ?>" class="nav-link link-dark">Tambah Admin</a>
                    </li>
                </ul><hr>
            </div>            
            <div class="container col-md-9 ml-sm-auto col-lg-10 px-md-4" role="main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-white" id="hal-u">Info Kamar</h1>
                </div>
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            Info Kamar
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Kamar</th>
                                            <th>Harga Kamar</th>
                                            <th>Jumlah Penghuni</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $no = 1 ?>
                                    <?php foreach($kamar as $row): ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['id_kamar'] ?></td>
                                            <td><?= $row['harga'] ?></td>
                                            <td><?= $row['penghuni'] ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal<?=$row['id_kamar']?>">Update</button>
                                                |
                                                <a class="btn btn-danger" href="delete.php?id_tagihan=<?= $row['id_kamar'] ?>&jenis=kamar&id_admin=<?= $id ?>">delete</a>
                                            </td>
                                        </tr>
                                        <?php $no++ ?>
                                        <!-- FORM UPDATE TAGIHAN -->
                                    <div class="modal fade modal-lg" id="updateModal<?=$row['id_kamar']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="updateModal<?=$row['id_kamar']?>">Update Kamar: <?= $row["nama_kamar"] ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <label for="nama">Nama Kamar</label>
                                                    <input type="text" name="nama" value="<?= $row['nama_kamar'] ?>" id="" required> <br>
                                                    <label for="harga">Harga Kamar</label>
                                                    <input type="number" name="harga" value=<?= $row['harga'] ?> id="" required> <br>
                                                    <input type="hidden" name="id_admin" value=<?= $id ?>>
                                                    <input type="hidden" name="id_kamar" value=<?= $row["id_kamar"] ?>>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahKamar">Tambah Kamar</button>          
                </div>
            </div>
        </div>
    </main>
    <footer class="container-fluid">
        <div class="row">
            <div class="card bg-dark text-white text-center" style="border-radius: 0;">
                <p class="my-3">&copy; Kelompok 4 - Pemrograman Web 2023</p>
            </div>
        </div>
    </footer>
</body>
</html>
<div class="modal fade" id="tambahKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="nama" required>
                    <label for="floatingInput">Nama Kamar</label><br>
                </div>
                <input type="hidden" name="id_admin" value="<?= $id ?>">
                <div class="form-floating">
                    <input type="number" class="form-control" id="floatingInput" name="harga" required>
                    <label for="floatingInput">Harga Kamar</label><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah_kamar" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> 