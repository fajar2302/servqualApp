<?php
session_start();
include '../../koneksi.php';


$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '$id'");
$data_query = mysqli_fetch_assoc($query);
$judul = $data_query['judul'];
$cekKuis = cekKuis($id);
$query_jenis = mysqli_query($koneksi, "SELECT * FROM tb_jenisKuisioner JOIN tb_pertanyaan ON tb_jenisKuisioner.id_jenisKuisioner = tb_pertanyaan.jenisKuisioner_id WHERE tb_pertanyaan.judul_id = '$id' GROUP BY tb_pertanyaan.jenisKuisioner_id");



header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan-excel.xls");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Service Quality</title>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> -->
    <!-- link icon bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="https://cdnjs.com/libraries/Chart.js"></script> -->
    <style>
    th,
    td {
        border: 1px solid black;
        border-style: double;

    }
    </style>

</head>

<body>
    <div class="container mt-4" id="content">
        <div class="title my-4 text-center">
            <h5><?= $judul; ?></h5>
        </div>
        <!-- <button type="button" id="downloadBtn" onclick="preparePrint()"
            class="btn btn-outline-primary">Download</button> -->
        <div class="gap-table mb-3">
            <h5>1. Perhitungan GAP</h5>
            <table class="table" id="datatablesSimple" style="width:100%">
                <thead class="bg-secondary text-white">
                    <tr class="text-center">
                        <th>Attribut</th>
                        <th>GAP</th>
                        <th>Tingkat Kepuasan</th>
                        <th>Target Kepuasan</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($cekKuis > 0) {
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($query_jenis)) {
                            $id_jenis = $data['jenisKuisioner_id'];
                            $jenis = $data['jenis_kuisioner'];
                            $gap = hitungRataDimensi($id_jenis, $id)['rataGap'];
                            $tingkatKepuasan = tingkatKepuasan($gap);


                    ?>
                    <tr>
                        <td><?= $jenis ?></td>
                        <td><?= $gap ?></td>
                        <td>
                            <?= $tingkatKepuasan ?>
                        </td>
                        <td>5</td>
                    </tr>
                    <?php
                        }
                    } else { ?>
                    <td colspan="5" class="text-center fw-bold fs-4"> DATA KOSONG</td>
                    <?php  }
                    ?>
                </tbody>
            </table>
        </div>


        <!-- Interpolasi Gap  -->
        <?php
        $queryPertanyaanXbar = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id' ORDER BY jenisKuisioner_id ASC, item_pertanyaan ASC");
        $jumlah_pertanyaan = mysqli_num_rows($queryPertanyaanXbar);


        ?>
        <div class="interpolate-table mt-4">
            <h5>2. Interpolasi GAP</h5>
            <table class="table table-bordered border-dark" style="width:100%" id="datatablesSimple">
                <thead class="bg-secondary text-white">
                    <tr class="text-center">
                        <th rowspan="2" style="width: 50px;">
                            <p>No.</p>
                        </th>
                        <th rowspan="2">
                            <p>Pertanyaan</p>
                        </th>
                        <th colspan="2" rowspan="1">Penilaian</th>
                        <th rowspan="2">
                            <p>X bar</p>
                        </th>
                        <th rowspan="2">
                            <p>Y bar</p>
                        </th>
                        <th rowspan="2">
                            <p>Tingkat Kesesuaian</p>
                        </th>
                        <th rowspan="2">
                            <p>Kuadran</p>
                        </th>
                    </tr>
                    <tr>
                        <th>Persepsi</th>
                        <th>Harapan</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($cekKuis > 0) {
                        $no = 1;
                        $totalXbar = 0;
                        $totalYbar = 0;
                        $dataPoints = array();
                        $rataTingkatKesesuaian = 0;

                        while ($data_kartesius = mysqli_fetch_assoc($queryPertanyaanXbar)) {
                            $pertanyaan = $data_kartesius['item_pertanyaan'];
                            $id_pertanyaan = $data_kartesius['id_pertanyaan'];
                            $xbar = hitungTotal($id_pertanyaan)['jawabanPrep'] / hitungRespondenperJudul($id);
                            $xbar = number_format($xbar, 2);
                            $ybar = hitungTotal($id_pertanyaan)['jawabanHar'] / hitungRespondenperJudul($id);
                            $ybar = number_format($ybar, 2);

                            $totalXbar = $totalXbar + $xbar;
                            $totalYbar = $totalYbar + $ybar;
                            $tingkatKesesuaian = (hitungTotal($id_pertanyaan)['jawabanPrep'] / hitungTotal($id_pertanyaan)['jawabanHar']) * 100;
                            $tingkatKesesuaian = number_format($tingkatKesesuaian, 2);
                            $rataTingkatKesesuaian += $tingkatKesesuaian;


                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $pertanyaan ?></td>
                        <td><?= hitungTotal($id_pertanyaan)['jawabanPrep']; ?></td>
                        <td><?= hitungTotal($id_pertanyaan)['jawabanHar']; ?></td>
                        <td><?= $xbar; ?></td>
                        <td><?= $ybar; ?></td>
                        <td><?= $tingkatKesesuaian; ?> %</td>
                        <td><?= cek_kuadran($id, $xbar, $ybar) ?></td>
                    </tr>
                    <?php
                            $dataPoints[] = array(
                                "x" => $xbar,
                                "y" => $ybar,
                            );
                        }

                        $jsonData = json_encode($dataPoints, JSON_NUMERIC_CHECK);

                        $totalXbar = $totalXbar / $jumlah_pertanyaan;
                        $totalXbar = number_format($totalXbar, 2);
                        $totalYbar = $totalYbar / $jumlah_pertanyaan;
                        $totalYbar = number_format($totalYbar, 2);
                        $rataTingkatKesesuaian /= $jumlah_pertanyaan;
                        $rataTingkatKesesuaian = number_format($rataTingkatKesesuaian, 2);


                        $batas = [$totalXbar, $totalYbar];

                        ?>
                    <tr>
                        <td colspan="4" class="text-center">RATA-RATA</td>
                        <td> <?= $totalXbar;  ?></td>
                        <td> <?= $totalYbar; ?></td>
                        <td> <?= $rataTingkatKesesuaian; ?> %</td>


                    </tr>
                    <?php } else { ?>
                    <td class="text-center fw-bold fs-4" colspan="8">DATA KOSONG</td>
                    <?php   } ?>
                </tbody>
            </table>
        </div>

        <!-- tabel simpulan -->
        <div class="kuadran-table mt-5">
            <h5>3. Tabel Simpulan Kuadran</h5>
            <table border="1" class="table" style="width:100%" id="datatablesSimple">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>
                            No.
                        </th>
                        <th>Kuadran</th>
                        <th>Keterangan</th>
                        <th>Pertanyaan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 1; $i < 5; $i++) {
                        $kuadran = "Kuadran $i";
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td rowspan="1"><?= $kuadran; ?></td>
                        <td rowspan="1"><?= cek_pernyataan($kuadran); ?></td>
                        <td>
                            <?php
                                $kuadran = kuadran($id, $kuadran);
                                if (count($kuadran) > 0) {
                                    foreach ($kuadran as $data_kuadran) { ?>
                            <p><?= $data_kuadran; ?></p>

                            <?php   }
                                } else {
                                    echo "-";
                                }
                                ?>

                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!--   <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="../../js/generate.js"></script>


</body>

</html>