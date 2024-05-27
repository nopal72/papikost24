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
                <p class="text-white ms-md-auto my-auto">Test_User</p>
                <div class="nav-item dropdown no-caret dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/icon_user.png" style="max-height:50px;"></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="assets/icon_user.png">
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name">Nama Pengguna</div>
                                <div class="dropdown-user-details-email">nama_pengguna@test.com</div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#masukkan halaman akun di sini">
                            <div class="dropdown-item-icon"></div>
                            Akun
                        </a>
                        <a class="dropdown-item text-danger" href="#masukkan halaman login di sini">
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
                        <a href="/dashboard_client.html" class="nav-link link-dark" aria-current="page">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Pembayaran</a>
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
                            <select name="tagihan" id="tagihan"><option value="wifi">Wifi</option><option value="listrik">Listrik</option></select>
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
                                            <th>Tenggat Tagihan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>wifi001</td>
                                            <td>Wifi</td>
                                            <td>Rp.30.000,00</td>
                                            <td>01/01/2001</td>
                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Info</button></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>listrik001</td>
                                            <td>Listrik</td>
                                            <td>Rp.40.000,00</td>
                                            <td>01/01/2002</td>
                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Info</button></td>
                                        </tr>
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
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Bayar Tagihan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p><strong>Kode Tagihan: </strong>KM001</p>
            <p><strong>Jenis Tagihan: </strong>Wifi</p>
            <p><strong>Jumlah Tagihan: </strong>Rp.30.000,00</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success">Bayar</button>
            </div>
        </div>
    </div>
</div>