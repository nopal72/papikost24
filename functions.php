<?php 
#connect to database
$conn = mysqli_connect("localhost","root","","papikost234");

function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function insertNewUser($data, $role){
    global $conn;
    $nama = strtolower(stripslashes($data["nama"]));
    $email = $data["email"];
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);

    $query_user = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    $query_admin = mysqli_query($conn, "SELECT * from tb_admin WHERE email = '$email'");

    if(mysqli_num_rows($query_user) > 0 or  mysqli_num_rows($query_admin) > 0 ){
        echo"<script>alert('Email sudah digunakan! Mohon gunakan email yang lain.');</script>";
    }else if ($password != $password2){
        echo"<script>alert('Password tidak sama! Mohon pastikan password yang dimasukkan match.');</script>";
    }else{
        $password = password_hash($password, PASSWORD_DEFAULT);
        if($role === "admin"){
            $query = "INSERT INTO tb_admin VALUES 
            ('','$nama','$email','$password')";
            if(!mysqli_query($conn, $query)){
                alertMessage("Proses Registrasi Gagal");
            }else{
                alertMessage('Admin Baru Behasil Ditambahkan');
            }
        }
        else if($role === "user"){
            $alamat = $data["alamat"];
            $tgl_lahir = $data["tgl_lahir"];
            $id_kamar = $data["kamar"];
            $kamar = query("SELECT * FROM kamar WHERE id_kamar = '$id_kamar'");
            $penghuni = intval($kamar[0]["penghuni"]);
            if($penghuni >= 2){
                alertMessage("Kamar Sudah Penuh!");
            }else{
                $penghuni += 1;
                
                $query = "INSERT INTO user VALUES
                ('','$nama','$alamat','$tgl_lahir','$email','$password','$id_kamar')";
                if(!mysqli_query($conn, $query)){
                    alertMessage("Proses Registrasi Gagal");
                }else{
                    mysqli_query($conn, "UPDATE kamar SET penghuni = $penghuni WHERE id_kamar = '$id_kamar'");
                    alertMessage("User Berhasil Ditambahkan");
                    header("Location:index.php");
            }
            }
        }
        }
    }


function login($data){
    global $conn;
    $email = $data["email"];
    $password = $data["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    if (mysqli_num_rows($result)< 1){
        # adalah admin
        $result = mysqli_query($conn,"SELECT * FROM tb_admin WHERE email = '$email'");
        $row = mysqli_fetch_assoc($result);
        $id = mysqli_escape_string($conn,$row["id_admin"]);
        if(password_verify($password, $row["password"])){
           header("Location:dashboard_admin.php?id=$id");
        }else{
            alertMessage("Pasword Salah");
        }
    }
    else if(mysqli_num_rows($result)> 0){
        $row = mysqli_fetch_assoc($result);
        var_dump($row);
        $id = mysqli_escape_string($conn,$row["id_user"]);
        if(password_verify($password, $row["password"])){
          header("Location:dashboard_user.php?id=$id");
        }else{
            alertMessage("Pasword Salah");
        }
    }else{
        alertMessage("Email Tidak Ditemukan");
    }

}

function insertNewTagihan($data){
    global $conn;
    $jenis_tagihan = $data["jenis_tagihan"];
    $tanggal = $data["tanggal"];
    
    $id_admin = $data["id_admin"];
    
    if($jenis_tagihan === "listrik"){
        $id_jenis = "ls";
    }else if($jenis_tagihan === "wifi"){
        $id_jenis = "wf";
    }else{
        $id_jenis = "ks";
    }
    if($id_jenis === "ks" ){
        $id_kamar = query("SELECT id_kamar FROM kamar WHERE penghuni != 0");
        foreach($id_kamar as $id){
            $id = $id["id_kamar"];
            $jumlah_penghuni = query("SELECT penghuni FROM kamar WHERE id_kamar = '$id' AND penghuni != 0");
            if(intval($jumlah_penghuni[0]["penghuni"]) != "0"){
                $harga_kamar = query("SELECT harga FROM kamar WHERE id_kamar = '$id' AND penghuni != 0");
                $tagihan = intval($harga_kamar[0]['harga'])/intval($jumlah_penghuni[0]['penghuni']);
                $kode_tagihan = $id_jenis.strtr($tanggal, ["-"=>""]).$id.$id_admin;

                // Periksa apakah kode transaksi sudah ada di tabel tagihan_kamar
                $existing_code_query = "SELECT kode_tagihan FROM tagihan_kamar WHERE kode_tagihan = '$kode_tagihan'";
                $existing_code_result = query($existing_code_query);
                if(empty($existing_code_result)){                    
                    $query = "INSERT INTO tagihan_kamar VALUES 
                    ('$kode_tagihan','$id','$id_admin','$tagihan','$tanggal')";
                    if(mysqli_query($conn, $query)){
                        $cek = True;
                    }else{
                        $cek = False;
                    }
                }                
            }
        }
        if(isset($cek)){
            alertMessage("Data Berhasil Ditambahkan");
        }else{
            alertMessage("Data Gagal Ditambahkan!");
        }
    }else{
        $tagihan = $data["jumlah"];
        $total_tagihan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user"))*$tagihan;
        $id_tagihan = $id_jenis.strtr($tanggal, ["-"=>""]).$id_admin;
        $query = "INSERT INTO tagihan VALUES 
        ('$id_tagihan','$tanggal','$jenis_tagihan','$tagihan','$total_tagihan','$id_admin')";
        if(mysqli_query($conn,$query)){
            alertMessage("Data Berhasil Ditambahkan!");
        }else{
            alertMessage("Data Gagal Ditambahkan!");
        }
    }
    
}

function deleteTagihan($id_tagihan, $id_admin, $jenis){
    global $conn;
    if($jenis === "kos"){
        $query = "DELETE FROM tagihan_kamar WHERE kode_tagihan = '$id_tagihan'";
    }else if($jenis === "kamar"){
        $query = "DELETE FROM kamar WHERE id_kamar = '$id_tagihan'";
    }else{
        $query = "DELETE FROM tagihan WHERE kode_tagihan = '$id_tagihan'";
    }
    $result = mysqli_query($conn, $query);
    if($result){
        alertMessage("Data Berhasil Dihapus");
        return true;
    }else{
        alertMessage("Data Gagal Dihapus");
        return false;
    }
}

function updateTagihan($data){
    global $conn;
    $kode_tagihan = $data['kode_tagihan'];
    $jenis_tagihan = $data['jenis_tagihan'];
    $tanggal = $data['tanggal'];
    $jumlah = intval($data['jumlah']);
    $id_admin = $data['id_admin'];
    if($jenis_tagihan === "kos"){
        $query = "UPDATE tagihan_kamar SET
        tagihan = '$jumlah',
        tenggat = '$tanggal'
        WHERE kode_tagihan = '$kode_tagihan'
        ";
    }else{
        $total_tagihan = mysqli_num_rows(mysqli_query($conn,'SELECT * FROM user'))*$jumlah;
        $query = "UPDATE  tagihan SET
        tanggal = '$tanggal', 
        jenis_tagihan = '$jenis_tagihan',
        tagihan = '$jumlah',
        total_tagihan = '$total_tagihan',
        id_admin = '$id_admin'
        WHERE kode_tagihan = '$kode_tagihan'
        ";
    }
    if(mysqli_query($conn, $query)){
        alertMessage("Data Berhasil Diupdate!");
        header("Location: dashboard_admin.php?id=$id_admin");
    }else{
        alertMessage("Data Gagal Diupdate!");
    }
}

function alertMessage($msg){
    echo"<script>alert('$msg')</script>";
}

function bayarTagihan($data){
    global $conn;
    $id_user = $data['user'];
    $kode_tagihan = $data['kode_tagihan'];
    $jenis = $data['jenis'];
    $tanggal = $data['tanggal_transaksi'];
    $kode_transaksi = $id_user.$kode_tagihan.$jenis.str_replace("-", "", $tanggal);
    $query = "INSERT INTO transaksi VALUES
        ('$kode_transaksi','$kode_tagihan','$id_user','$tanggal','$jenis')
    ";
    if(mysqli_query($conn, $query)){
        alertMessage("Berhasil Melakukan Transaksi");
        header("location:check_bill.php?id=$id_user");
    }else{
        alertMessage("Gagal Melakukan Transaksi");
    }
}

function updateKamar($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $harga = $data['harga'];
    $id_admin = $data['id_admin'];
    $id_kamar = $data['id_kamar'];

    $query = "UPDATE kamar SET
    nama_kamar = '$nama',
    harga = $harga
    WHERE id_kamar = '$id_kamar'";
    if(mysqli_query($conn, $query)){
        alertMessage("Data Berhasil Diupdate");
        header("Location:info_room.php?id=$id_admin");
    }else{
        alertMessage("Data Gagal Dupdate");
    }
}

function tambahKamar($data){
    global $conn;
    $nama = $data["nama"];
    $harga = $data["harga"];
    $id_admin = $data["id_admin"];
    $row = query("SELECT LPAD(COUNT(*), 2, '0') as room_count FROM kamar");
    $id = "KM".str_pad(intval($row[0]["room_count"]) + 1, 2, '0', STR_PAD_LEFT);
    $query = "INSERT INTO kamar VALUES 
        ('$id','$nama','$harga','0')
    ";
    if(mysqli_query($conn, $query)){
        alertMessage("Data Berhasil Ditambahkan");
        header("Location:info_room.php?id=$id_admin");
    }else{
        alertMessage("Data Gagal Ditambahkan");
    }
}
?>