<?php 
include 'functions.php';
$kode_tagihan = $_GET['id_tagihan'];
$id_admin = $_GET['id_admin'];

$data = query("SELECT * FROM tagihan WHERE kode_tagihan = '$kode_tagihan'");
if(isset($_POST['submit'])){
    updateTagihan($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update tagihan</title>
</head>
<body>
    <h2 class="text-center">Update Tagihan</h2>
    <form action="" method="post">
        <label for="jenis_tagihan">Jenis Tagihan</label>
        <select name="jenis_tagihan" value="<?= $data['jenis_tagihan'] ?>" id="" required>
            <option value="listrik">Listrik</option>
            <option value="wifi">Wifi</option>
            <option value="kos">kos</option>
        </select><br>
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" id="" value="<?= $data[0]['tanggal'] ?>" required> <br>
        <label for="jumlah">Tagihan/orang</label>
        <input type="number" name="jumlah" value="<?= $data[0]['tagihan'] ?>" id="" required> <br>
        <input type="hidden" name="id_admin" value=<?= $id_admin ?>>
        <input type="hidden" name="kode_tagihan" value=<?= $kode_tagihan ?>>
        <button type="submit" name="submit">submit</button>
    </form>
</body>
</html>