<?php
include '../../koneksi.php';

$id_judul = $_POST['id'];
$judul = $_POST['judul'];
$cekKuis = cekKuis($id_judul);
$query_jenis = mysqli_query($koneksi, "SELECT * FROM tb_jenisKuisioner JOIN tb_pertanyaan ON tb_jenisKuisioner.id_jenisKuisioner = tb_pertanyaan.jenisKuisioner_id WHERE tb_pertanyaan.judul_id = '$id_judul' GROUP BY tb_pertanyaan.jenisKuisioner_id");
// $query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$judul'");



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
                            <th>Attribut</th>
                            <th>GAP</th>
                            <th>Tingkat Kepuasan</th>
                            <th>Target Kepuasan</th>
                            <th>OPSI</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($cekKuis > 0) {
                            $no = 1;
                            while ($data = mysqli_fetch_assoc($query_jenis)) {
                                $id_jenis = $data['jenisKuisioner_id'];
                                $jenis = $data['jenis_kuisioner'];
                                $gap = hitungRataDimensi($id_jenis, $id_judul)['rataGap'];
                                $tingkatKepuasan = tingkatKepuasan($gap);


                        ?>
                                <tr>
                                    <td><?= $jenis ?></td>
                                    <td><?= $gap ?></td>
                                    <td>
                                        <?= $tingkatKepuasan ?>
                                    </td>
                                    <td>5</td>
                                    <td><a href="#" class="open btn btn-success btn-sm" open-id="<?= $id_judul . "|" . $id_jenis . "|" . $judul; ?>">
                                            <i class="bi bi-arrow-up-right-square"></i> Detail
                                        </a></td>

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
        </div>
    </div>

    <!-- Diagram xbar  -->
    <?php
    $queryPertanyaanXbar = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' ORDER BY jenisKuisioner_id ASC, item_pertanyaan ASC");
    $jumlah_pertanyaan = mysqli_num_rows($queryPertanyaanXbar);


    ?>

    <div class="switch-page" id="page">
        <div id="table-data" class="card my-3">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Interpolasi Gap
            </div>
            <div class="card-body">
                <div class="title">
                    <p class="text-center"><?= $judul; ?></p>
                </div>
                <table class="table table-bordered" id="datatablesSimple">
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
                                $xbar = hitungTotal($id_pertanyaan)['jawabanPrep'] / hitungRespondenperJudul($id_judul);
                                $xbar = number_format($xbar, 2);
                                $ybar = hitungTotal($id_pertanyaan)['jawabanHar'] / hitungRespondenperJudul($id_judul);
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
                                    <td><?= cek_kuadran($id_judul, $xbar, $ybar) ?></td>
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
        </div>
    </div>


    <!--Chart Diagram Kartesius  -->


    <div class="switch-page" id="page">
        <div id="table-data" class="card my-3">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Diagram Kartesius
            </div>
            <div class="card-body">
                <div class="title">
                    <p class="text-center"><?= $judul; ?></p>
                </div>

                <!-- chart -->
                <div class="chart-js text-center">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- load tabel simpulan -->
    <input class="id" type="hidden" value="<?php $id_judul ?>">
    <div class="switch-page">
        <div id="table-data" class="card my-3">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabel Kuadran
            </div>
            <div class="card-body" id="simpulan">
                <table class="table table-bordered" id="datatablesSimple">
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
                                    $kuadran = kuadran($id_judul, $kuadran);
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
    </div>

</div>
<script>
    $(document).ready(function() {

        $('.open').on('click', function(e) {
            e.preventDefault();
            let data_id = $(this).attr('open-id');
            let pisah = data_id.split('|');
            $.post('servqual-page/servqualGap.php', {
                id: pisah[0],
                id_jenis: pisah[1],
                judul: pisah[2]
            }, function(respon) {
                $('#table-data').html(respon);
                $('#datatablesSimple').DataTable();
            })
        })
    })

    var dataFromPHP = <?php echo $jsonData; ?>;
    var batasx = <?= json_encode($batas); ?>;
    console.log(batasx[0]);

    // QUADRANT CHART
    // Inisialisasi array untuk menyimpan dataset
    var datasets = [];

    // Iterasi melalui dataFromPHP untuk membuat dataset
    for (var i = 0; i < dataFromPHP.length; i++) {
        var dataset = {
            label: 'Pertanyaan ' + (i + 1),
            data: [dataFromPHP[i]], // Ambil nilai "y" dari data
            borderColor: getRandomColor(), // Fungsi untuk mendapatkan warna acak
            backgroundColor: getRandomColor(),
        };

        datasets.push(dataset); // Tambahkan dataset ke array datasets
    }

    // Buat objek dataChart dengan array datasets
    const dataChart = {
        datasets: datasets
    };

    // Fungsi untuk mendapatkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var j = 0; j < 6; j++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    const quadrants = {
        id: 'quadrants',
        beforeDraw(chart, args, options) {
            const {
                ctx,
                chartArea: {
                    left,
                    top,
                    right,
                    bottom
                },
                scales: {
                    x,
                    y
                }
            } = chart;
            const midX = x.getPixelForValue(0);
            const midY = y.getPixelForValue(0);
            ctx.save();
            ctx.fillStyle = options.topLeft;
            ctx.fillRect(left, top, midX - left, midY - top);
            ctx.fillStyle = options.topRight;
            ctx.fillRect(midX, top, right - midX, midY - top);
            ctx.fillStyle = options.bottomRight;
            ctx.fillRect(midX, midY, right - midX, bottom - midY);
            ctx.fillStyle = options.bottomLeft;
            ctx.fillRect(left, midY, midX - left, bottom - midY);
            ctx.restore();
        }
    };

    const scatterArbitraryLine = {
        id: 'scatterArbitraryLine',
        beforeDraw(chart, args, pluginOptions) {
            const {
                ctx,
                chartArea: {
                    top,
                    bottom,
                    left,
                    right,
                    width,
                    height
                },
                scales: {
                    x,
                    y
                }
            } = chart;
            var xScale = chart.scales['x'];
            var yScale = chart.scales['y'];

            ctx.save();

            // Garis horizontal pada y
            const horizontalYValue = batasx[1];
            const horizontalYPosition = yScale.getPixelForValue(horizontalYValue);
            ctx.beginPath();
            ctx.strokeStyle = 'rgba(255,26,104,1)';
            ctx.lineWidth = 3;
            ctx.moveTo(xScale.left, horizontalYPosition);
            ctx.lineTo(xScale.right, horizontalYPosition);
            ctx.stroke();
            ctx.closePath();

            // Garis vertikal pada x
            const verticalXValue = batasx[0];
            const verticalXPosition = xScale.getPixelForValue(verticalXValue);
            ctx.beginPath();
            ctx.strokeStyle = 'rgba(255,26,104,1)';
            ctx.lineWidth = 3;
            ctx.moveTo(verticalXPosition, yScale.top);
            ctx.lineTo(verticalXPosition, yScale.bottom);
            ctx.stroke();
            ctx.closePath();

            ctx.restore();
        }
    };


    const config = {
        type: 'scatter',
        data: dataChart,
        options: {
            plugins: {
                quadrants: {
                    topLeft: 'white',
                    topRight: 'white',
                    bottomRight: 'white',
                    bottomLeft: 'white',
                }
            },
            // scales: {
            //     y: {
            //         min: 0,
            //         max: 5,
            //     },
            //     x: {
            //         min: 0,
            //         max: 5,
            //     }
            // },

        },
        plugins: [quadrants, scatterArbitraryLine],
    };
    const ctx = document.getElementById('myChart');
    new Chart(ctx, config);
</script>