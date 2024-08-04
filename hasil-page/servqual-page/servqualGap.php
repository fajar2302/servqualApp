<?php
include '../../koneksi.php';

$id_judul = $_POST['id'];
$judul = $_POST['judul'];
$id_jenis = $_POST['id_jenis'];
$query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' AND jenisKuisioner_id = '$id_jenis' ORDER BY jenisKuisioner_id ASC, item_pertanyaan ASC");
$jumlah_pertanyaan = mysqli_num_rows($query_pertanyaan);

?>
<div class="container">
    <div class="switch-page" id="page">
        <div id="table-data" class="card my-3">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Servqual
            </div>
            <div class="card-body">
                <div class="title">
                    <p class="text-center"><?= $judul; ?></p>
                </div>
                <table class="table table-bordered" id="datatablesSimple">
                    <thead class="bg-secondary text-white">
                        <tr class="text-center">
                            <th style="width: 50px;">No.</th>
                            <th>Pertanyaan</th>
                            <th>Presepsi</th>
                            <th>Harapan</th>
                            <th>GAP</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($query_pertanyaan)) {
                            $pertanyaan = $data['item_pertanyaan'];
                            $id_pertanyaan = $data['id_pertanyaan'];

                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pertanyaan ?></td>
                            <td><?= hitungRata($id_judul, $id_pertanyaan) ?></td>
                            <td><?= hitungRata_h($id_judul, $id_pertanyaan) ?></td>
                            <td><?= hitung_servqual($id_judul,$id_pertanyaan) ?></td>
                        </tr>
                        <?php
                        }

                        ?>
                        <tr>
                            <td colspan="2" class="text-center">RATA-RATA</td>
                            <td> <?= hitungRataDimensi($id_jenis, $id_judul)['rataPrep']; ?></td>
                            <td> <?= hitungRataDimensi($id_jenis, $id_judul)['rataHar']; ?></td>
                            <td> <?= hitungRataDimensi($id_jenis, $id_judul)['rataGap']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<script>
$(document).ready(function() {


    let id = $('#id').val();
    $.post('tabelHasilHarapan.php', {
        id: id,
    }, function(respon) {
        $('#tabel-harapan').html(respon);
    })


})
</script>