<?php 
include 'functions.php';
if(isset($_POST["login"])){
    insertNewUser($_POST,"user");
}
$kamar = query("SELECT * FROM kamar WHERE penghuni < 2");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5 p-5" style="background-color:#FFFECB;">
                    <h1 class="card-title text-center mb-3 fw-bold fs-25">Daftar</h1>
                    <form method="post" action="">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="floatingInput" name="nama" required>
                            <label for="floatingInput">Nama</label><br>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="floatingInput" name="email" required>
                            <label for="floatingInput">Email</label><br>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="form-floating mb-2 me-3">
                                <input type="password" class="form-control" id="floatingInput" name="password" required>
                                <label for="floatingInput">Password Baru</label><br>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control" id="floatingInput" name="password2" required>
                                <label for="floatingInput">Konfirmasi Password</label><br>
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="floatingInput" name="alamat" required>
                            <label for="floatingInput">Alamat</label><br>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="form-floating mb-2 me-3">
                                <input type="date" class="form-control" id="floatingInput" name="tgl_lahir" required>
                                <label for="floatingInput">Tanggal Lahir</label><br>
                            </div>
                            <div class="form-floating mb-2" style="width:200px;">
                                <select class="form-control" id="floatingInput" name="kamar" required>
                                <?php $no=1; ?>
                                    <?php foreach($kamar as $row): ?>
                                            <option value="<?= $row['id_kamar'] ?>"><?= $row['nama_kamar'] ?></option>
                                    <?php $no++ ?>   
                                    <?php endforeach ?>
                                </select>
                                <label for="floatingInput">Kamar</label><br>
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <a class="fw-light fs-5 ms-3 me-5" href="index.php">Sudah punya akun?</a>
                            <button class="btn btn-primary ms-5" type="submit" name="login">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>