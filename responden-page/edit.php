<?php
include '../koneksi.php';

$id_user = $_POST['id'];

$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$id_user'");
$data = mysqli_fetch_assoc($query);
$jenkel = $data['jenis_kelamin'];


?>


<div class="card-header">
    <i class="fas fa-table me-1"></i>
    Tabel Responden
</div>
<div class="card-body">
    <form id="form-data">
        <div class="mb-3 row">
            <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" value="<?= $data['nama'] ?>" name="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputjenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option class="text text-capitalized" value="laki-laki"
                        <?php echo $jenkel === 'laki-laki' ? 'selected' : ''; ?>>
                        Laki-laki
                    </option>
                    <option class="text text-capitalized" value="perempuan"
                        <?php echo $jenkel === 'perempuan' ? 'selected' : ''; ?>>
                        Perempuan
                    </option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputAge" class="col-sm-2 col-form-label">Umur</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputAge" value="<?= $data['umur'] ?>" name="umur">
                <input type="hidden" name="username" value="<?= $data['username'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputAddress" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputAddress" value="<?= $data['alamat'] ?>" name="alamat">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputJob" class="col-sm-2 col-form-label">Pekerjaan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputJob" value="<?= $data['pekerjaan'] ?>"
                    name="pekerjaan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPhoneNumber" class="col-sm-2 col-form-label">Nomor Telepon</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="inputPhoneNumber" value="<?= $data['no_hp'] ?>"
                    name="no_telp">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" disabled class="form-control" id="inputUsername" value="<?= $data['username']; ?>"
                    name="username">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" value="<?= $data['kata_kunci'] ?>"
                    name="password">
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="submit" name="ubah">Simpan</button>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#form-data').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();
        $.post('responden-page/proses.php', 'ubah=true&' + data, function(respon) {
            var pecah = respon.split('|');
            Swal.fire({
                position: 'center',
                icon: pecah[0],
                title: pecah[1],
                showConfirmButton: false,
                timer: 1500
            });
            $(window).attr('location', 'index-admin.php');
        })
    })
})
</script>