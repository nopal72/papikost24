<?php 
include 'functions.php';
$id_tagihan = $_GET["id_tagihan"];
$id_admin = $_GET["id_admin"];
$kos = $_GET['jenis'];

if(deleteTagihan($id_tagihan, $id_admin, $kos)){
    header("Location:dashboard_admin.php?id=$id_admin");
}else{
    header("Location:dahsboard_admin.php?id=$id_admin");
}
exit;
?>