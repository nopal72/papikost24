<?php 
include 'functions.php';
if(isset($_POST['login'])){
    login($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5" style="background-color:#FFFECB;">
                    <div class="card-body p-8 p-sm-4 d-flex flex-row justify-content-center h-100">
                        <div class="my-auto mx-auto col-md-6 p-3">
                            <img class="img-fluid" src="assets/logo_papikost.jpg" style="max-height:100%;">
                        </div>
                        <div class="ms-3 col-md-6 my-auto">
                            <h1 class="card-title text-center mb-5 fw-bold fs-25">Login</h1>
                            <form method="post" action="">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" id="floatingInput" name="email" required>
                                    <label for="floatingInput">Email</label><br>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="password" class="form-control" id="floatingInput" name="password" required>
                                    <label for="floatingInput">Password</label><br>
                                </div>
                                <div class="form-floating mb-2">
                                    <a class="fw-light fs-5 ms-3 me-5" href="register.php">Penghuni baru?</a>
                                    <button class="btn btn-primary ms-5" type="submit" name="login">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
