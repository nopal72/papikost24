<?php 
include 'functions.php';
$id = mysqli_escape_string($conn,$_GET['id']);
if(isset($id)){
    $data = query("SELECT * FROM tb_admin WHERE id_admin = '$id'");
}else{
    header("Location:index.php");
}
$tagihan = query("SELECT * FROM tagihan");
$kamar = query("SELECT * FROM tagihan_kamar");

if(isset($_POST['submit'])){
    updateTagihan($_POST);
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
                <p class="text-white ms-md-auto my-auto"><?= $data[0]['nama'] ?></p>
                <div class="nav-item dropdown no-caret dropdown-user ">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/icon_user.png" style="max-height:50px;"></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="assets/icon_user.png">
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?= $data[0]["nama"] ?></div>
                                <div class="dropdown-user-details-email"><?= $data[0]["email"] ?></div>
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
                        <a href="dashboard_admin.php?id=<?= $id ?>" class="nav-link active" aria-current="page">Halaman Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="insert_tagihan.php?id=<?= $id ?>" class="nav-link link-dark">Tambah Tagihan</a>
                    </li>
                    <li class="nav-item">
                        <a href="info_bill.php?id=<?= $id ?>" class="nav-link link-dark">Info Pembayaran</a>
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
                    <h1 class="h2 text-white">Halaman Admin</h1>
                </div>
                <div class="row g-3 my-2 ms-3">
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <div class="p-3 col-10 bg-white shadow-sm d-flex flex-column justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 fw-bold">Tagihan Wifi</p>
                            </div>
                            <input type="image" src="assets/icon_listrik.png"/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <div class="p-3 col-10 bg-white shadow-sm d-flex flex-column justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 fw-bold">Tagihan Listrik</p>
                            </div>
                            <input type="image" src="assets/icon_wifi.png"/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <div class="p-3 col-10 bg-white shadow-sm d-flex flex-column justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 fw-bold">Tagihan Kost</p>
                            </div>
                            <input type="image" src="assets/icon_kost.png"/>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-white">Daftar Tagihan</h1>
                </div>
                <!-- TABEL INFO IURAN LISTRIK DAN WIFI -->
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1 d-block">
                                Tagihan Wifi & Listrik
                            </i>
                        </div>
                        <table class="table">
                            <thead>
                                <th class="text-center">no</th>
                                <th class="text-center">kode tagihan</th>
                                <th class="text-center">tenggat</th>
                                <th class="text-center">biaya tagihan</th>
                                <th class="text-center">aksi</th>
                            </thead>
                            <?php $no = 0 ?>
                            <?php foreach($tagihan as $row): ?>
                                <tr>
                                    <td class="text-center "><?= $no+1 ?></td>
                                    <td class="text-center"><?= $row["kode_tagihan"] ?></td>
                                    <td class="text-center"><?= $row["tanggal"] ?></td>
                                    <td class="text-center"><?= $row["total_tagihan"] ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal<?=$no?>">
                                            Update
                                        </button> 
                                            | 
                                        <a class="btn btn-danger" href="delete.php?id_tagihan=<?= $row["kode_tagihan"] ?>&id_admin=<?= $id ?>">Hapus</a>
                                    </td>
                                </tr>
                                <!-- FORM UPDATE TAGIHAN -->
                                <div class="modal fade modal-lg" id="updateModal<?=$no?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="updateModal<?=$no?>">Update Tagihan: <?= $row["kode_tagihan"] ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <label for="jenis_tagihan">Jenis Tagihan</label>
                                                <select name="jenis_tagihan" value="<?= $row['jenis_tagihan'] ?>" id="" required>
                                                    <option value="listrik">Listrik</option>
                                                    <option value="wifi">Wifi</option>
                                                    <option value="kos">kos</option>
                                                </select><br>
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" name="tanggal" id="" value="<?= $row['tanggal'] ?>" required> <br>
                                                <label for="jumlah">Tagihan/orang</label>
                                                <input type="number" name="jumlah" value=<?= $row['tagihan'] ?> id="" required> <br>
                                                <input type="hidden" name="id_admin" value=<?= $id ?>>
                                                <input type="hidden" name="kode_tagihan" value=<?= $row["kode_tagihan"] ?>>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-success">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <?php $no++ ?>
                            <?php endforeach ?>
                        </table>
                        <div class="card-body">
                            <!-- Tabel PHP masuk sini -->
                        </div>
                    </div>
                </div>
                <!-- TABEL TAGIHAN KAMAR KOST -->
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1 d-block">
                                Tagihan Kamar Kost
                            </i>
                        </div>
                        <table class="table">
                            <thead>
                                <th class="text-center">no</th>
                                <th class="text-center">kode tagihan</th>
                                <th class="text-center">kamar</th>
                                <th class="text-center">tenggat</th>
                                <th class="text-center">biaya tagihan</th>
                                <th class="text-center">aksi</th>
                            </thead>
                            <?php $no = 0 ?>
                            <?php foreach($kamar as $row): ?>
                                <tr>
                                    <td class="text-center "><?= $no+1 ?></td>
                                    <td class="text-center"><?= $row["kode_tagihan"] ?></td>
                                    <td class="text-center"><?= $row["kode_kamar"] ?></td>
                                    <td class="text-center"><?= $row["tenggat"] ?></td>
                                    <td class="text-center"><?= $row["tagihan"] ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModalTagihan<?=$no?>">
                                            Update
                                        </button> 
                                            | 
                                        <a class="btn btn-danger" href="delete.php?id_tagihan=<?= $row["kode_tagihan"] ?>&id_admin=<?= $id ?>&jenis=kos">Hapus</a>
                                    </td>
                                </tr>
                                <!-- FORM UPDATE TAGIHAN -->
                                <div class="modal fade modal-lg" id="updateModalTagihan<?=$no?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="updateModalTagihan<?=$no?>">Update Tagihan: <?= $row["kode_tagihan"] ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <label for="tanggal">Tenggat</label>
                                                <input type="date" name="tanggal" id="" value="<?= $row['tenggat'] ?>" required> <br>
                                                <label for="tagihan">Tagihan</label>
                                                <input type="number" name="jumlah" id="" value="<?= $row['tagihan'] ?>" required> <br>
                                                <input type="hidden" name="id_admin" value=<?= $id ?>>
                                                <input type="hidden" name="kode_tagihan" value=<?= $row["kode_tagihan"] ?>>
                                                <input type="hidden" name="jenis_tagihan" value="kos">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-success">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <?php $no++ ?>
                            <?php endforeach ?>
                        </table>
                        <div class="card-body">
                            <!-- Tabel PHP masuk sini -->
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
    <!-- Button trigger modal -->


</body>
</html>