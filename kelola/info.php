<?php
include '../koneksi.php';
$id = $_POST['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '$id'"));
$query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id'");
$ambilBaris = '';
$jumlahBaris = mysqli_num_rows($query);
if ($jumlahBaris > 0) {
    $ambilBaris = $jumlahBaris;
} else {
    $ambilBaris = 0;
}

?>
<div class="my-3 row">
    <label for="exampleInputText2" class="col-sm-4 col-form-label ">Judul</label>
    <span class="col-sm-1 col-form-label">:</span>
    <div class="col-sm-7" style="word-wrap: break-word;">
        <?= $data['judul'] ?>
    </div>
</div>
<div class="mb-3 row">
    <label for="exampleInputText2" class="col-sm-4 col-form-label ">Lokasi</label>
    <span class="col-sm-1 col-form-label">:</span>
    <div class="col-sm-7 mt-2">
        <?= $data['lokasi'] ?>
    </div>
</div>
<div class="mb-3 row">
    <label for="exampleInputText2" class="col-sm-4 col-form-label ">Tahun</label>
    <span class="col-sm-1 col-form-label">:</span>
    <div class="col-sm-7 mt-2">
        <?= $data['tahun'] ?>
    </div>
</div>
<div class="mb-3 row">
    <label for="exampleInputText2" class="col-sm-4 col-form-label ">Jumlah Pertanyaan</label>
    <span class="col-sm-1 col-form-label">:</span>
    <div class="col-sm-7 mt-2">
        <?= $ambilBaris ?>
    </div>
</div>

<script>

</script>