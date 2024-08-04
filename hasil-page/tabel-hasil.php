<?php
include '../koneksi.php';

$id_judul = $_POST['id'];
$judul = $_POST['judul'];
$cekKuis = cekKuis($id_judul);

$query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' ORDER BY jenisKuisioner_id ASC, item_pertanyaan ASC");
$jumlah_pertanyaan = mysqli_num_rows($query_pertanyaan);


?>
<div class="container">
    <div class="switch-page" id="page">
        <div id="table-data" class="card my-3">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabel Data Kuesioner
            </div>
            <div class="card-body">
                <div class="title">
                    <p class="text-center"><?= $judul; ?></p>
                </div>
                <table class="table table-bordered" id="datatablesSimple">
                    <thead class="bg-secondary text-white">
                        <tr class="text-center">
                            <th rowspan="2" class="text-center">
                                <p>No.</p>
                            </th>
                            <th rowspan="2" class="text-center">
                                <p>Pertanyaan</p>
                            </th>
                            <th rowspan="1" colspan="5">Presepsi</th>
                            <th rowspan="2" class="text-center">
                                <p>Rata-Rata</p>
                            </th>
                            <th rowspan="1" colspan="5">Harapan</th>
                            <th rowspan="2" class="text-center">
                                <p>Rata-Rata</p>
                            </th>
                        </tr>
                        <tr>
                            <th>STP</th>
                            <th>TP</th>
                            <th>CP</th>
                            <th>P</th>
                            <th>SP</th>
                            <th>STP</th>
                            <th>TP</th>
                            <th>CP</th>
                            <th>P</th>
                            <th>SP</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($cekKuis == 1) {

                            $no = 1;
                            while ($data = mysqli_fetch_assoc($query_pertanyaan)) {
                                $pertanyaan = $data['item_pertanyaan'];
                                $id_pertanyaan = $data['id_pertanyaan'];
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pertanyaan ?></td>
                            <td><?= $stp_p = hitung_STP($id_pertanyaan) ?></td>
                            <td><?= $tp_p = hitung_TP($id_pertanyaan) ?></td>
                            <td><?= $cp_p = hitung_CP($id_pertanyaan) ?></td>
                            <td><?= $p_p = hitung_P($id_pertanyaan) ?></td>
                            <td><?= $sp_p = hitung_SP($id_pertanyaan) ?></td>
                            <td><?= $rP = hitungRata($id_judul, $id_pertanyaan); ?></td>
                            <td><?= $stp_h = hitung_STP_h($id_pertanyaan) ?></td>
                            <td><?= $tp_h = hitung_TP_h($id_pertanyaan) ?></td>
                            <td><?= $cp_h = hitung_CP_h($id_pertanyaan) ?></td>
                            <td><?= $p_h = hitung_P_h($id_pertanyaan) ?></td>
                            <td><?= $sp_h = hitung_SP_h($id_pertanyaan) ?></td>
                            <td><?= $rH = hitungRata_h($id_judul,$id_pertanyaan); ?></td>
                        </tr>


                        <?php
                            }

                            ?>
                        <tr>
                            <td colspan="2" class="text-center">JUMLAH</td>
                            <td><?= hasilJumlahPrep($id_judul)['total_stp']; ?></td>
                            <td><?= hasilJumlahPrep($id_judul)['total_tp']; ?></td>
                            <td><?= hasilJumlahPrep($id_judul)['total_cp']; ?></td>
                            <td><?= hasilJumlahPrep($id_judul)['total_p']; ?></td>
                            <td><?= hasilJumlahPrep($id_judul)['total_sp']; ?></td>
                            <td><?= hasilJumlahPrep($id_judul)['total_rP']; ?></td>
                            <td><?= hitungJumlahHar($id_judul)['total_stp_h']; ?></td>
                            <td><?= hitungJumlahHar($id_judul)['total_tp_h']; ?></td>
                            <td><?= hitungJumlahHar($id_judul)['total_cp_h']; ?></td>
                            <td><?= hitungJumlahHar($id_judul)['total_p_h']; ?></td>
                            <td><?= hitungJumlahHar($id_judul)['total_sp_h']; ?></td>
                            <td><?= hitungJumlahHar($id_judul)['total_rH']; ?></td>
                        </tr>
                    </tbody>
                    <?php
                        } else { ?>
                    <td colspan="14" class="text-center fw-bold fs-4">DATA KOSONG</td>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>


</div>
<script>
$(document).ready(function() {


    // let id = $('#id').val();
    // $.post('tabelHasilHarapan.php', {
    //     id: id,
    // }, function(respon) {
    //     $('#tabel-harapan').html(respon);
    // })

    // // ketika validitas di klik
    // $('#validitas').on('click', function(e) {
    //     e.preventDefault();
    //     $.post('validitas.php', {
    //         id: id,
    //     }, function(respon) {
    //         $('#page').html(respon);
    //     })
    // })

    // // ketika reliabilitas di klik
    // $('#reliabilitas').on('click', function(e) {
    //     e.preventDefault();
    //     $.post('reliability-page.php', {
    //         id: id,
    //     }, function(respon) {
    //         $('#page').html(respon);
    //     })
    // })

    // $('#hasil-respon').on('click', function(e) {
    //     e.preventDefault();
    //     $.post('tabel-hasil.php', {
    //         id: id,
    //     }, function(respon) {
    //         $('#table-data').html(respon);
    //     })
    // })
    // // ketika Servqual Page di klik
    // $('#servqual').on('click', function(e) {
    //     e.preventDefault();
    //     $.post('pengolahan-data/servqual-page/servqual-page.php', {
    //         id: id,
    //     }, function(respon) {
    //         $('#page').html(respon);
    //     })
    // })

})
</script>