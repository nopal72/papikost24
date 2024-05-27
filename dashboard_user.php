<?php 
include 'functions.php';
$id = intval($_GET['id']);

$user = query("SELECT * FROM user WHERE id_user =$id");

$tagihan = query("SELECT tagihan.*, transaksi.kode_transaksi, transaksi.tanggal AS tanggal_transaksi
FROM tagihan
LEFT JOIN transaksi ON tagihan.kode_tagihan = transaksi.kode_tagihan
WHERE transaksi.id_user IS NOT NULL
");

$tagihan_kamar = query("SELECT tagihan_kamar.*, transaksi.kode_transaksi, transaksi.tanggal AS tanggal_transaksi
FROM tagihan_kamar
LEFT JOIN transaksi ON tagihan_kamar.kode_tagihan = transaksi.kode_tagihan
WHERE transaksi.id_user IS NOT NULL
");

$kamar = query("SELECT SUM(tagihan_kamar.tagihan) as totalTagihanKamar
    FROM tagihan_kamar
    LEFT JOIN transaksi ON tagihan_kamar.kode_tagihan = transaksi.kode_tagihan
    WHERE transaksi.id_user IS NULL AND tagihan_kamar.kode_kamar = '{$user[0]['id_kamar']}'");

$listrik = query("SELECT SUM(tagihan) as totalListrik
FROM tagihan
LEFT JOIN transaksi ON tagihan.kode_tagihan = transaksi.kode_tagihan
WHERE jenis_tagihan = 'listrik' AND transaksi.id_user IS NULL
");

$wifi = query("SELECT SUM(tagihan) as totalListrik
FROM tagihan
LEFT JOIN transaksi ON tagihan.kode_tagihan = transaksi.kode_tagihan
WHERE jenis_tagihan = 'wifi' AND transaksi.id_user IS NULL
");
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
                <p class="text-white ms-md-auto my-auto"><?= $user[0]['nama'] ?></p>
                <div class="nav-item dropdown no-caret dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/icon_user.png" style="max-height:50px;"></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="assets/icon_user.png">
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?= $user[0]['nama'] ?></div>
                                <div class="dropdown-user-details-email"><?= $user[0]['email'] ?></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="profile_user.php?id=<?= $id?>">
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
                        <a href="dashboard_user.php?id=<?= $id ?>" class="nav-link active" aria-current="page">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a href="check_bill.php?id=<?= $id ?>" class="nav-link link-dark">Pembayaran</a>
                    </li>
                </ul><hr>
            </div>            
            <div class="container col-md-9 ml-sm-auto col-lg-10 px-md-4" role="main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-white" id="hal-u">Halaman Utama</h1>
                </div>
                <div class="row g-3 my-2 ms-3">
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <div class="p-3 col-10 bg-white shadow-sm d-flex flex-column justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2 text-center">Rp <?= $listrik[0]['totalListrik'] ?></h3>
                                <p class="fs-5">Tagihan Listrik</p>
                            </div>
                            <input type="image" src="assets/icon_listrik.png"/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <div class="p-3 col-10 bg-white shadow-sm d-flex flex-column justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2 text-center">Rp <?= $wifi[0]['totalListrik']?></h3>
                                <p class="fs-5 text-center">Tagihan Wifi</p>
                            </div>
                            <input type="image" src="assets/icon_wifi.png"/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <div class="p-3 col-10 bg-white shadow-sm d-flex flex-column justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2 text-center">Rp <?= $kamar[0]['totalTagihanKamar'] ?></h3>
                                <p class="fs-5 text-center">Tagihan Kamar</p>
                            </div>
                            <input type="image" src="assets/icon_kost.png"/>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-white" id="tag">Daftar Tagihan</h1>
                </div>
                
                <div class="container-fluid px-4">
                    <!-- TABEL TAGIHAN IURAN WIFI DAN LISTRIK -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Tagihan Wifi & Listrik Lunas
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Transaksi</th>
                                            <th>Kode Tagihan</th>
                                            <th>Jenis Tagihan</th>
                                            <th>Biaya Tagihan</th>
                                            <th>Tanggal Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tagihan as $row): ?>
                                            <?php $no = 1; ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $row['kode_transaksi'] ?></td>
                                                    <td><?= $row['kode_tagihan'] ?></td>
                                                    <td><?= $row['jenis_tagihan'] ?></td>
                                                    <td><?= $row['tagihan'] ?></td>
                                                    <td><?= $row['tanggal_transaksi'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <!-- Tambahkan di bawah -->
                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                    </div>
                </div>
                <!-- TABEL TAGIHAN KAMAR KOS -->
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            Tagihan Kamar Kost Lunas
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Transaksi</th>
                                            <th>Kode Tagihan</th>
                                            <th>Biaya Tagihan</th>
                                            <th>Tanggal Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tagihan_kamar as $row): ?>
                                            <?php $no = 1; ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $row['kode_transaksi'] ?></td>
                                                    <td><?= $row['kode_tagihan'] ?></td>
                                                    <td><?= $row['tagihan'] ?></td>
                                                    <td><?= $row['tanggal_transaksi'] ?></td>
                                                </tr>
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