<?php 
include 'functions.php';
$id = $_GET["id"];
if(!isset($id)){
    header("Location:http://localhost/SETELAH_UAS/papikost234/index.php");
}
$admin = query("SELECT * FROM tb_admin WHERE id_admin=$id");
if(isset($_POST["submit"])){
    insertNewTagihan($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tagihan</title>
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
                        <a href="insert_tagihan.php?id=<?= $id ?>" class="nav-link active">Tambah Tagihan</a>
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
                    <h1 class="h2 text-white" id="hal-u">Tambah Tagihan</h1>
                </div>
                <div class="col-sm-13 col-md-11 col-lg-9 mx-auto">
                    <div class="card border-0 shadow rounded-3 my-5 p-5" style="background-color:#FFFECB;">
                        <h1 class="card-title text-center mb-3 fw-bold fs-25">Tambah Tagihan</h1>
                        <form method="post" action="">
                            <div class="m-2">
                                <select name="jenis_tagihan" id="tagihan">
                                    <option value="wifi">Wifi</option>
                                    <option value="listrik">Listrik</option>
                                    <option value="kost">Kamar</option>
                                </select>
                            </div>
                            <div class="form-floating">
                                <input type="number" id="jumlahInput" class="form-control" id="floatingInput" name="jumlah" required>
                                <label for="floatingInput">Jumlah</label><br>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" id="floatingInput" name="tanggal" required>
                                <label for="floatingInput">Tenggat</label><br>
                            </div>
                            <input type="hidden" name="id_admin" value="<?= $id ?>">
                            <div class="form-floating mb-2">
                                <button class="btn btn-primary ms-5" type="submit" name="submit">Tambah</button>
                            </div>
                        </form>
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
<script>
    document.getElementById('tagihan').addEventListener('change', function() {
        var jumlahInput = document.getElementById('jumlahInput');

        // Jika jenis_tagihan yang dipilih adalah "kost", nonaktifkan input jumlah
        if (this.value === 'kost') {
            jumlahInput.disabled = true;
        } else {
            jumlahInput.disabled = false;
        }
    });
</script>
