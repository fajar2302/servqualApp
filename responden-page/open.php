<?php
include '../koneksi.php';

$id_user = $_POST['id'];

$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$id_user'");
$data = mysqli_fetch_assoc($query);
$jenkel = $data['jenis_kelamin'];


?>



<form id="form-data">
    <div class="my-3 row">
        <label for="inputName" class="col-sm-4 col-form-label">Nama Lengkap</label>
        <span class="col-sm-1 col-form-label">:</span>
        <div class="col-sm-7">
            <input type="text" readonly class="form-control-plaintext" id="inputName" value="<?= $data['nama'] ?>" name="nama">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputjenkel" class="col-sm-4 col-form-label">Jenis Kelamin</label>
        <span class="col-sm-1 col-form-label">:</span>
        <div class="col-sm-7">
            <input type="text" readonly class="form-control-plaintext text-capitalize" id="inputjenkel" value="<?= $data['jenis_kelamin'] ?>" name="jenis-kelamin">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputAge" class="col-sm-4 col-form-label">Umur</label>
        <span class="col-sm-1 col-form-label">:</span>
        <div class="col-sm-7">
            <input type="text" disabled class="form-control-plaintext" id="inputAge" value="<?= $data['umur'] ?>" name="umur">
            <input type="hidden" name="username" value="<?= $data['username'] ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputAddress" class="col-sm-4 col-form-label">Alamat</label>
        <span class="col-sm-1 col-form-label">:</span>
        <div class="col-sm-7">
            <input type="text" disabled class="form-control-plaintext" id="inputAddress" value="<?= $data['alamat'] ?>" name="alamat">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputJob" class="col-sm-4 col-form-label">Pekerjaan</label>
        <span class="col-sm-1 col-form-label">:</span>
        <div class="col-sm-7">
            <input type="text" disabled class="form-control-plaintext" id="inputJob" value="<?= $data['pekerjaan'] ?>" name="pekerjaan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPhoneNumber" class="col-sm-4 col-form-label">Nomor Telepon</label>
        <span class="col-sm-1 col-form-label">:</span>
        <div class="col-sm-7">
            <input type="number" disabled class="form-control-plaintext" id="inputPhoneNumber" value="<?= $data['no_hp'] ?>" name="no_telp">
        </div>
    </div>
</form>

<script>