<?php 
include 'functions.php';
$id = $_GET['id'];
if(!isset($id)){
    header("Location:index.php");
}
$admin = query("SELECT * FROM tb_admin WHERE id_admin=$id");
$tagihan = query("SELECT * FROM tagihan");
$kamar = query("SELECT * FROM tagihan_kamar");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                <p class="text-white ms-md-auto my-auto"><?= $admin[0]['nama'] ?></p>
                <div class="nav-item dropdown no-caret dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/icon_user.png" style="max-height:50px;"></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="assets/icon_user.png">
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?= $admin[0]['nama'] ?></div>
                                <div class="dropdown-user-details-email"><?= $admin[0]['email'] ?></div>
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
        <div class="row flex-nowrap">
            <div class="d-flex flex-column p-3 bg-light col-sm-4 col-md-3 col-xl-2">
                <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4 mx-auto">Sidebar</span>
                </div><hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="dashboard_admin.php?id=<?= $id ?>" class="nav-link link-dark" aria-current="page">Halaman Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="insert_tagihan.php?id=<?= $id ?>" class="nav-link link-dark">Tambah Tagihan</a>
                    </li>
                    <li class="nav-item">
                        <a href="info_bill.php?id=<?= $id ?>" class="nav-link active">Info Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a href="info_room.php?id=<?= $id ?>" class="nav-link link-dark">Info Kamar</a>
                    </li>
                    <li class="nav-item">
                        <a href="register_admin.php?id=<?= $id ?>" class="nav-link link-dark">Tambah Admin</a>
                    </li>
                </ul><hr>
            </div>            
            <div class="container col-md-9 ml-sm-auto col-lg-10 px-md-4" role="main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-white" id="tag">Info Pembayaran</h1>
                </div>
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <p>Pembayaran Tagihan</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Tagihan</th>
                                            <th>Jenis Tagihan</th>
                                            <th>Biaya Tagihan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <?php $no = 1 ?>
                                    <?php foreach($tagihan as $row): ?>
                                        <tbody>
                                            <td><?= $no ?></td>
                                            <td><?= $row['kode_tagihan'] ?></td>
                                            <td><?= $row['jenis_tagihan'] ?></td>
                                            <td><?= $row['tagihan'] ?></td>
                                            <td class="text-center"><button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                            data-bs-target="#infoModal<?= $row['kode_tagihan'] ?>">Info</button></td>
                                        </tbody>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="infoModal<?= $row['kode_tagihan'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <?php 
                                                    $belum = query("SELECT * FROM user WHERE id_user NOT IN (SELECT id_user FROM transaksi)");
                                                    $lunas = query("SELECT * FROM user WHERE id_user IN (SELECT id_user FROM transaksi)");
                                                ?>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="infoModal<?= $row['kode_tagihan'] ?>">Info Tagihan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <p><strong>Kode Tagihan: </strong><?= $row['kode_tagihan'] ?></p>
                                                        <p><strong>Lunas: </strong></p>
                                                        <ul>
                                                            <?php foreach($lunas as $row): ?>
                                                                <li class="fw-bold"><?= $row['nama'] ?></li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                        <p><strong>Belum Lunas: </strong></p>
                                                        <ul>
                                                            <?php foreach($belum as $row): ?>
                                                                <li class="fw-bold"><?= $row['nama'] ?></li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $no ++ ?>  
                                    <?php endforeach ?>
                                        <!-- Tambahkan di bawah -->
                                    </tbody>
                                </table>
                            </div>
                        </div>          
                    </div>
                    <!-- TABEL INFO PEMBAYARAN KAMAR -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <p>Pembayaran Kamar</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Tagihan</th>
                                            <th>Kode Kamar</th>
                                            <th>Biaya Tagihan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <?php $no = 1 ?>
                                   
                                    <?php foreach($kamar as $row): ?>
                                        <tbody>
                                            <td><?= $no ?></td>
                                            <td><?= $row['kode_tagihan'] ?></td>
                                            <td><?= $row['kode_kamar'] ?></td>
                                            <td><?= $row['tagihan'] ?></td>
                                            <td class="text-center"><button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                            data-bs-target="#infoModal<?= $row['kode_tagihan'] ?>">Info</button></td>
                                        </tbody>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="infoModal<?= $row['kode_tagihan'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <?php $kode = $row['kode_kamar']; ?>
                                                <?php 
                                                    $belum = query("SELECT * FROM user WHERE id_kamar = '$kode' AND id_user NOT IN (SELECT id_user FROM transaksi WHERE jenis='kos') ");
                                                    $lunas = query("SELECT * FROM user WHERE id_kamar = '$kode' AND id_user IN (SELECT id_user FROM transaksi WHERE jenis='kos')");
                                                ?>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="infoModal<?= $row['kode_tagihan'] ?>">Info Tagihan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <p><strong>Kode Tagihan: </strong><?= $row['kode_tagihan'] ?></p>
                                                        <p><strong>Lunas: </strong></p>
                                                        <ul>
                                                            <?php foreach($lunas as $row): ?>
                                                                <li class="fw-bold"><?= $row['nama'] ?></li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                        <p><strong>Belum Lunas: </strong></p>
                                                        <ul>
                                                            <?php foreach($belum as $row): ?>
                                                                <li class="fw-bold"><?= $row['nama'] ?></li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $no ++ ?>  
                                    <?php endforeach ?>
                                        <!-- Tambahkan di bawah -->
                                    </tbody>
                                </table>
                            </div>
                        </div>          
                    </div>
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
