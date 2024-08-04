<?php
include '../koneksi.php';

if (isset($_POST['ubah'])) {
    $nama = $_POST['nama'];
    $jenkel = $_POST['jenis_kelamin'];
    $umur = $_POST['umur'];
    $pekerjaan = $_POST['pekerjaan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_telp'];
    $username = $_POST['username'];
    $katkun = $_POST['password'];

    $query = mysqli_query($koneksi, "UPDATE `tb_user` SET `nama`='$nama',`jenis_kelamin`='$jenkel',`umur`='$umur', `no_hp`='$no_hp', `pekerjaan`='$pekerjaan',`alamat`='$alamat', `kata_kunci`='$katkun' WHERE username = '$username'");
    if ($query) {
        echo 'success|Data Berhasil Diubah';
    } else {
        echo 'error|Data gagal Diubah';
    }
}

if (isset($_POST['hapus'])) {
    $id = $_POST['hapus'];
    $nama_tabel = detailUser($id)['nama_tabel'];
    $delete = mysqli_query($koneksi, "DELETE FROM tb_user WHERE username = '$id' ");
    $delete_tabel = mysqli_query($koneksi, "DROP TABLE " . $nama_tabel);
    if ($delete) {
        echo 'success|Data Berhasil Di Hapus';
        if ($delete_tabel) {
            echo 'success|tabel Berhasil Di Hapus';
        } else {
            echo 'error|Data Gagal dihapus';
        }
    } else {
        echo 'errorr|so sampe disini sup';
    }
}
