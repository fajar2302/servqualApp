<?php
include '../../koneksi.php';

$id_pertanyaan = $_POST['id'];
$id_judul = $_POST['judul'];
$query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE id_pertanyaan = $id_pertanyaan");
$ambil = mysqli_fetch_assoc($query_pertanyaan);
$query_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
// $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id_judul' GROUP BY tb_pertanyaan.jenisKuisioner_id");
// $rows = mysqli_num_rows($query);


?>

<div class="row mx-3 my-3">
    <div class="col-md-12 fw-bold fs-3 text-center text-uppercase">Tabel Data Butir Pertanyaan</div>
    <div class="d-flex justify-content-center">
        <p class="text-capitalize me-0"> <?= $ambil['item_pertanyaan']; ?></p>

    </div>
</div>
<div class="mt-4 pb-4">
    <hr class="dropdown-divider" />
</div>
<div class="card mx-3">
    <table class="table table-striped table-hover table-bordered">
        <thead class="border border-black">
            <tr class="bg-secondary text-light">
                <th>Responden</th>
                <th>X</th>
                <th>Y</th>
                <th>XY</th>
                <th>X<sup>2</sup></th>
                <th>Y<sup>2</sup></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_presepsi = 0;
            $total_nilaiY_presepsi = 0;
            $total_nilaiXY = 0;
            $total_presepsi_kuadrat = 0;
            $total_nilaiY_kuadrat_p = 0;
            $total_nilaiY_kuadrat_h = 0;

            while ($fetch = mysqli_fetch_assoc($query_user)) {
                $id = $fetch['username'];
                $detail_function = detailUser($id);
                $nama_tabel = $detail_function['nama_tabel'];
                $nama = $detail_function['nama'];

                // mendapatkan nilai Y
                $detail_from_Y = totalY($nama_tabel);
                $nilaiY_p = $detail_from_Y['nilaiy_presepsi'];
                $nilaiY_h = $detail_from_Y['nilaiy_harapan'];
                $ykuadrat_p = $detail_from_Y['ykuadrat_presepsi'];
                $ykuadrat_h = $detail_from_Y['ykuadrat_harapan'];

                // mendapatkan nilai X
                $detail_from_X = presepsi_harapan($nama_tabel, $id_pertanyaan);
                $presepsi = $detail_from_X['presepsi'];
                $harapan = $detail_from_X['harapan'];
                $presepsi_kuadrat = $detail_from_X['presepsi_kuadrat'];
                $harapan_kuadrat = $detail_from_X['harapan_kuadrat'];

                // mendapatkan nilai XY
                $nilaiXY = totalXY($presepsi, $nilaiY_p);

                // Menambahkan nilai ke total
                $total_presepsi += $presepsi;
                $total_nilaiY_presepsi += $nilaiY_p;
                $total_nilaiXY += $nilaiXY;
                $total_presepsi_kuadrat += $presepsi_kuadrat;
                $total_nilaiY_kuadrat_p += $ykuadrat_p;
                $total_nilaiY_kuadrat_h += $ykuadrat_h;


            ?>
            <tr>
                <td><?= $nama; ?></td>
                <td><?= $presepsi; ?></td>
                <td><?= $nilaiY_p; ?></td>
                <td><?= $nilaiXY; ?></td>
                <td><?= $presepsi_kuadrat; ?></td>
                <td><?= $ykuadrat_p; ?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <td>TOTAL</td>
                <td><?= $total_presepsi; ?></td>
                <td><?= $total_nilaiY_presepsi; ?></td>
                <td><?= $total_nilaiXY; ?></td>
                <td><?= $total_presepsi_kuadrat; ?></td>
                <td><?= $total_nilaiY_kuadrat_p; ?></td>
            </tr>
        </tbody>
    </table>
</div>


<script>
$(document).ready(function() {
    $('.open').on('click', function(e) {
        e.preventDefault();
        let data = $(this).attr('open-id');
        alert(data);
        $.post('pengujian-page/detail-rhitung.php', {
            id: data,
        }, function(respon) {
            $('#table-data').html(respon);
        })
    })
})
</script>