<?php
session_start();
$id_user = $_SESSION['id'];
include '../koneksi.php';


if (isset($_POST['simpan-idul'])) {
  $id_judul = $_POST['id-judul'];
  $nama_db = detailUser($id_user)['nama_tabel'];
  // $id_jenis_calon = $_POST['id-jenis'];
  // $id_jenis = $id_jenis_calon[0] . ' ' . $id_jenis_calon[1] . '' . $id_jenis_calon[2];
  // for ($i = 0; $i < count($id_jenis_calon); $i++) {
  // }
  $tanya = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id_judul' ");
  while ($data = mysqli_fetch_assoc($tanya)) {
    $id_jenis = $data['id_jenisKuisioner'];
    $id_pertanyaan = $data['id_pertanyaan'];
    $harapan = $_POST["$id_pertanyaan-harapan"];
    $calon_persepsi = $_POST["$id_pertanyaan-persepsi"];
    $pecah = explode('|', $calon_persepsi);
    $persepsi = $pecah[0];

    // Variabel untuk melacak apakah semua iterasi telah selesai
    $semuaIterasiSelesai = true;

    $cek = mysqli_query($koneksi, "SELECT * FROM $nama_db WHERE username_id='$id_user' AND pertanyaan_id='$id_pertanyaan' ");
    if (mysqli_num_rows($cek) > 0) {
      $result = mysqli_query($koneksi, "UPDATE $nama_db SET `presepsi`='$persepsi',`harapan`='$harapan' WHERE username_id='$id_user' AND pertanyaan_id='$id_pertanyaan'");
    } else {
      sleep(1);
      $id_respon = time();
      $result = mysqli_query($koneksi, "INSERT INTO $nama_db(`id_respon`, `username_id`, `judul_id`, `jenisKuisioner_id`, `pertanyaan_id`, `presepsi`, `harapan`) VALUES ('$id_respon','$id_user','$id_judul','$id_jenis','$id_pertanyaan','$persepsi','$harapan')");
      sleep(1);
    }

    // Jika iterasi saat ini tidak berhasil, set variabel menjadi false
    if (!$result) {
      $semuaIterasiSelesai = false;
      break; // Keluar dari loop pada kesalahan pertama
    }
  }
  if ($semuaIterasiSelesai) {
    echo "success|Data Berhasil Disimpan";
  } else {
    echo error_log($result);
  }
}
