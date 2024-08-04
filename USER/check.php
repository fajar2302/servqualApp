<?php
include '../koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $id_judul = $_POST['id_judul'];

    $nama_tabel = detailUser($id_user)['nama_tabel'];

    $cek = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE judul_id = '$id_judul'");
    $isi = mysqli_num_rows($cek);
    if ($isi > 0) {
        echo 'success|' . $nama_tabel . '';
    } else {
        echo 'erorr|' . $nama_tabel . '';
    }
}
