<?php
include '../koneksi.php';


if (isset($_POST['hapus'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['hapus']);

    $user = mysqli_query($koneksi, "SELECT * FROM tb_user");
    $deleted = false;  // Tambahkan variabel untuk melacak apakah data sudah dihapus

    while ($data = mysqli_fetch_assoc($user)) {
        $id_user = $data['username'];
        $nama_tabel = detailUser($id_user)['nama_tabel'];

        $cek = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE judul_id = '$id'");
        $value_cek = mysqli_num_rows($cek);

        if ($value_cek > 0) {
            $delete = mysqli_query($koneksi, "DELETE FROM $nama_tabel WHERE judul_id = '$id' ");
            if ($delete) {
                $deleted = true;
                break;  // Hentikan loop jika data sudah dihapus
            }
        }
    }

    if ($deleted) {
        echo 'success|Data Berhasil Di Hapus';
    } else {
        echo 'error|Gagal menghapus data';
    }
}
