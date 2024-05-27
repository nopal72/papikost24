<?php 
include 'functions.php';
$id = $_GET['id'];
if(!isset($id)){
    header("Location:login.php");
}
$user = query("SELECT * FROM user WHERE id_user = $id");
$data = query("SELECT tagihan.*
    FROM tagihan
    LEFT JOIN transaksi ON tagihan.kode_tagihan = transaksi.kode_tagihan
    WHERE transaksi.id_user IS NULL");

$kamar = $user[0]['id_kamar'];

$kamar = query("SELECT tagihan_kamar.*
    FROM tagihan_kamar
    LEFT JOIN transaksi ON tagihan_kamar.kode_tagihan = transaksi.kode_tagihan
    WHERE transaksi.id_user IS NULL AND tagihan_kamar.kode_kamar = '$kamar'");

$tgl_transaksi = date('Y-m-d'); 

if(isset($_POST['submit'])){
    bayarTagihan($_POST);
}

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
                        <a class="dropdown-item" href="profile_user.php?id=<?= $id ?>">
                            <div class="dropdown-item-icon"></div>
                            Akun
                        </a>
                        <a class="dropdown-item text-danger" href="login.php">
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
                        <a href="dashboard_user.php?id=<?= $id ?>" class="nav-link link-dark" aria-current="page">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a href="check_bill.php?id=<?= $id ?>" class="nav-link active">Pembayaran</a>
                    </li>
                </ul><hr>
            </div>            
            <div class="container col-md-9 ml-sm-auto col-lg-10 px-md-4" role="main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-white" id="tag">Tagihan</h1>
                </div>
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <p>Tagihan Wifi & Listrik</p>
                        </div>
                        <!-- MULAI DARI SINI -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- TABEL TAGIHAN KAMAR -->
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Tagihan</th>
                                            <th>Jenis Tagihan</th>
                                            <th>Biaya Tagihan</th>
                                            <th>Tenggat Tagihan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <?php $no = 1 ?>
                                    <?php foreach($data as $row): ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['kode_tagihan'] ?></td>
                                            <td><?= $row['jenis_tagihan'] ?></td>
                                            <td><?= $row['tagihan'] ?></td>
                                            <td><?= $row['tanggal'] ?></td>
                                            <td class="text-center"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal<?= $row['kode_tagihan'] ?>">
                                                Info</button></td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="infoModal<?= $row['kode_tagihan'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Bayar Tagihan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Kode Tagihan: </strong><?= $row['kode_tagihan'] ?></p>
                                                    <p><strong>Jenis Tagihan: </strong><?= $row['jenis_tagihan'] ?></p>
                                                    <p><strong>Jumlah Tagihan: </strong><?= $row['tagihan'] ?></p>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="user" value="<?= $user[0]['id_user'] ?>">
                                                            <input type="hidden" name="kode_tagihan" value="<?= $row['kode_tagihan'] ?>">
                                                            <input type="hidden" name="jenis" value="<?= $row['jenis_tagihan'] ?>">
                                                            <input type="hidden" name="tanggal_transaksi" value="<?= $tgl_transaksi ?>">
                                                            <button type="submit" name="submit" class="btn btn-success">Bayar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $no++ ?>
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>                
                    </div>
                </div>
                <!-- <div class="container-fluid px-4"> -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <p>Tagihan Kamar</p>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- TABEL TAGIHAN KAMAR -->
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>     #infoModal??
                                            <th>No.</th>
                                            <th>Kode Tagihan</th>
                                            <th>Biaya Tagihan</th>
                                            <th>Tenggat Tagihan</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <?php $no = 1 ?>
                                    <?php foreach($kamar as $row): ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['kode_tagihan'] ?></td>
                                            <td><?= $row['tagihan'] ?></td>
                                            <td><?= $row['tenggat'] ?></td>
                                            <td class="text-center"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal<?= $row['kode_tagihan'] ?>">
                                                Info</button></td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="infoModal<?= $row['kode_tagihan'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Bayar Tagihan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Kode Tagihan: </strong><?= $row['kode_tagihan'] ?></p>
                                                    <p><strong>Jumlah Tagihan: </strong><?= $row['tagihan'] ?></p>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="user" value="<?= $user[0]['id_user'] ?>">
                                                            <input type="hidden" name="kode_tagihan" value="<?= $row['kode_tagihan'] ?>">
                                                            <input type="hidden" name="jenis" value="kos">
                                                            <input type="hidden" name="tanggal_transaksi" value="<?= $tgl_transaksi ?>">
                                                            <button type="submit" name="submit" class="btn btn-success">Bayar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $no++ ?>
                                    <?php endforeach ?>
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
