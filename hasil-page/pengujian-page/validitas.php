<?php
include '../../koneksi.php';

$id_judul = $_POST['id'];

$query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id_judul' GROUP BY tb_pertanyaan.jenisKuisioner_id");
$rows = mysqli_num_rows($query);
$cekKuis = cekKuis($id_judul);

?>
<div class="mt-4 pb-4">
    <hr class="dropdown-divider" />
</div>
<div class="card mx-3 p-3">
    <table class="table table-striped table-hover table-bordered">
        <thead class="border border-black">
            <tr class="bg-secondary text-light">
                <th style="width: 30px;">No.</th>
                <th>Attribut</th>
                <th>R<sub>hitung</sub></th>
                <th>R<sub>tabel</sub></th>
                <th>Status Valid</th>
                <th>Status Reliabel</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($cekKuis > 0) {
                $no = 1;
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $data = mysqli_fetch_assoc($query);
                        $jenis = $data['jenis_kuisioner'];
                        $id_jenis = $data['id_jenisKuisioner'];
                        $newQuery = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' AND jeniskuisioner_id = '$id_jenis' ORDER BY item_pertanyaan ASC");
            ?>
            <tr>
                <th colspan="7"><?= $jenis ?></td>
            </tr>
            <?php
                        // perulangan untuk bagian pertanyaan
                        while ($pertanyaan = mysqli_fetch_assoc($newQuery)) {
                            $id_pertanyaan = $pertanyaan['id_pertanyaan'];
                        ?>
            <tr>
                <td style="width: 30px;"><?= $no++; ?></td>
                <td><?= $pertanyaan['item_pertanyaan']; ?></td>
                <?php
                                $fetch_data_from_korelasi = korelasi($id_pertanyaan);
                                $rhitung = $fetch_data_from_korelasi['korelasi_p'];
                                $rhitung_h = $fetch_data_from_korelasi['korelasi_h'];
                                $get_rtabel = rtabel($rhitung);
                                $get_rtabel_h = rtabel($rhitung_h);
                                $rtabel = $get_rtabel['rtabel'];
                                $status = $get_rtabel['status'];

                                // reliabilitas
                                $reliabilitas = reliabel($id_judul)['hasil'];
                                $status_reliabel = reliabel($id_judul)['status'];
                                if ($status_reliabel == 'reliabel') {
                                    $warna_relia = 'text-success';
                                } else {
                                    $warna_relia = 'text-danger';
                                }

                                if ($status == 'Valid') {
                                    $warna = 'text-success';
                                } else {
                                    $warna = 'text-danger';
                                }

                                ?>
                <td><?= $rhitung; ?></td>
                <td><?= $rtabel; ?></td>
                <td class="<?= $warna; ?>"><?= $status; ?></td>
                <td class="<?= $warna_relia; ?>"><?= $status_reliabel; ?></td>
                <td class="text-center">
                    <a href="#" class="open btn btn-success btn-sm" open-id="<?= $id_pertanyaan; ?>"
                        judul-id="<?= $id_judul; ?>">

                        <i class="bi bi-arrow-up-right-square"></i> Detail
                    </a>
                </td>
            </tr>
            <?php
                        }
                    }
                }
            } else { ?>
            <td colspan="7" class="text-center fq-bold fs-4"> DATA KOSONG</td>

            <?php        }
            ?>

        </tbody>
    </table>
</div>



<script>
$(document).ready(function() {
    $('.open').on('click', function(e) {
        e.preventDefault();
        let data = $(this).attr('open-id');
        let judul = $(this).attr('judul-id');
        // alert(data);
        $.post('pengujian-page/detail-rhitung.php', {
            id: data,
            judul: judul,
        }, function(respon) {
            $('#table-data').html(respon);
        })
    })
})
</script>