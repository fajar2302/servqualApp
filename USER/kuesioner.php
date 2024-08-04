<?php
session_start();
require '../koneksi.php';


$id = $_SESSION['id']; // id akun
$id_judul = $_POST['id_judul'];
$tabel = $_POST['tabel'];


// $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan JOIN tb_judul ON tb_pertanyaan.judul_id = tb_judul.id_judul JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisjudul_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id'");
$query2 = mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '$id_judul'");
$join = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id_judul' GROUP BY tb_pertanyaan.jenisKuisioner_id");
if (mysqli_num_rows($query2) > 0) {
    $ambil = mysqli_fetch_assoc($query2);
    $no = 1;
}
?>
<section id="kuesioner" class="my-4 py-4">
    <div class="container my-5">
        <div class="section-title kuesioner-title">
            <h4 class="text-center text-uppercase"><?= $ambil['judul']; ?></h4>
            <p class="text-center text-uppercase"><?= $ambil['lokasi']; ?>, <?= $ambil['tahun']; ?></p>
        </div>
        <hr>
        <div class="card card-kuesioner">
            <div class="card-body">
                <form id="form-data">

                    <table class="table table-bordered">

                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" scope="col" rowspan="2">
                                    <p>NO.</p>
                                </th>
                                <th class="text-center" scope="col" rowspan="2">
                                    <p>Pertanyaan</p>
                                </th>
                                <th class="text-center" scope="col" rowspan="1" colspan="5">Presepsi</th>
                                <th class="text-center" scope="col" rowspan="1" colspan="5">Harapan</th>

                            </tr>
                            <tr class="">
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $input = 0;
                            $class = 1;
                            $rows = mysqli_num_rows($join);
                            if ($rows > 0) {
                                for ($i = 0; $i < $rows; $i++) {
                                    $data = mysqli_fetch_assoc($join);
                                    $jenis = $data['jenis_kuisioner'];
                                    $id_jenis = $data['id_jenisKuisioner'];
                                    $id_judul = $data['judul_id'];
                                    $newQuery = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' AND jeniskuisioner_id = '$id_jenis' ORDER BY item_pertanyaan ASC");
                                    $totRows = mysqli_num_rows($newQuery);
                                    $no++;

                            ?>

                            <tr>
                                <td colspan="11"> <?= $jenis; ?></td>
                                <input type="text" name="id-jenis[<?= $i ?>]" value="<?= $id_jenis; ?>"
                                    style="display: none;">
                                <!-- <input type="hidden" name="id-judul[]" value="<?= $id_judul; ?>"> -->
                                <?php $no--; ?>
                            </tr>

                            <?php
                                    while ($newRows = mysqli_fetch_assoc($newQuery)) {
                                        $cek_presepsi = ambildata($tabel, $newRows['id_pertanyaan'])['presepsi'];
                                        $cek_harapan = ambildata($tabel, $newRows['id_pertanyaan'])['harapan'];
                                    ?>
                            <tr class="radio-button">
                                <td class="text-center"><?= $no; ?></td>
                                <td class="kuis"><?= $newRows['item_pertanyaan'] ?></td>
                                <td class="text-center">
                                    <input class="form-check-input presepsi border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-persepsi' ?>" id="pilihan" value="1"
                                        <?php if ($cek_presepsi == 1) echo 'checked'; ?> required>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input presepsi border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-persepsi' ?>" id="pilihan" value="2"
                                        <?php if ($cek_presepsi == 2) echo 'checked'; ?> required>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input presepsi border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-persepsi' ?>" id="pilihan" value="3"
                                        <?php if ($cek_presepsi == 3) echo 'checked'; ?> required>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input presepsi border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-persepsi' ?>" id="pilihan" value="4"
                                        <?php if ($cek_presepsi == 4) echo 'checked'; ?> required>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input presepsi border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-persepsi' ?>" id="pilihan" value="5"
                                        <?php if ($cek_presepsi == 5) echo 'checked'; ?> required>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-harapan' ?>" id="pilihan" value="1"
                                        <?php if ($cek_harapan == 1) echo 'checked'; ?> required>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-harapan' ?>" id="pilihan" value="2"
                                        <?php if ($cek_harapan == 2) echo 'checked'; ?> required>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-harapan' ?>" id="pilihan" value="3"
                                        <?php if ($cek_harapan == 3) echo 'checked'; ?> required>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-harapan' ?>" id="pilihan" value="4"
                                        <?php if ($cek_harapan == 4) echo 'checked'; ?> required>
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input border border-secondary" type="radio"
                                        name="<?= $newRows['id_pertanyaan'] . '-harapan' ?>" id="pilihan" value="5"
                                        <?php if ($cek_harapan == 5) echo 'checked'; ?> required>
                                </td>

                            </tr>

                            <?php
                                        $class++;
                                        $input++;
                                        $no++;
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button style="padding: 12px 0;" class="btn bg-custom text-white" id="simpan" type="submit"
                            id-judul="<?= $id_judul ?>" id-jenis="<?= $id_jenis ?>">SUBMIT</button>
                        <button class="btn bg-custom text-white" hidden id="loading" disabled>
                            <div class="spinner-border text-info" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>SUBMIT
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</section>


<script>
$(document).ready(function() {


    $('#form-data').submit(function(e) {
        e.preventDefault();

        let data = $(this).serialize();
        let id_jenis = $('#simpan').attr('id-jenis');
        let id_judul = $('#simpan').attr('id-judul');
        let loading = $('#loading').attr('id');
        console.log(loading);

        $('#loading').removeAttr('hidden');
        $('#simpan').attr("hidden", "hidden");


        // alert(data);

        $.post('proses-tes2.php', 'simpan-idul=true&id-judul=' + id_judul +
            '&data=' + data,
            function(resp) {
                let pisah = resp.split('|');
                $('#tabel').load('tabel.php');
                $('#simpan').removeAttr('hidden');
                $('#loading').attr("hidden", "hidden");
                Swal.fire({
                    position: 'center',
                    icon: pisah[0],
                    text: pisah[1],
                    showConfirmButton: false,
                    timer: 2500
                })
                $(window).attr('location', 'index.php');
            })
    });

})
</script>