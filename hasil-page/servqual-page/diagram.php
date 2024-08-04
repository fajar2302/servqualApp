<?php
include '../../koneksi.php';

$id_judul = $_POST['id'];
$pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$judul_id'");
