<?php

function hitung_servqual($id_judul, $no_pertanyaan)
{

    $rataPresepsi = hitungRata($id_judul, $no_pertanyaan);
    $rataHarapan = hitungRata_h($id_judul, $no_pertanyaan);

    $hasil = $rataPresepsi - $rataHarapan;

    $servqual = number_format($hasil, 2);

    return $servqual;
}


// ====== periksa Jenis yang ada pada tb pertanyaan sama dengan Jenis yang ada pada tb_jenis Kuisioner

function tingkatKepuasan($gap)
{
    $gabung = 1 + ((($gap - (-4)) / (4 - (-4))) * (5 - 1));
    $gabung = number_format($gabung, 2);

    return $gabung;
}

// ======== hitung Rata-Rata Xbar Ybar dan Tingkat Kesesuaian
function hitungXbarYbar($xbar, $ybar, $tingkes)
{
    $xbar;
}


function status($id_judul, $no_pertanyaan)
{
    $hasil_hitung = hitung_servqual($id_judul, $no_pertanyaan);

    if ($hasil_hitung >= 0) {
        $status =  "puas";
    } else {
        $status = "tidak puas";
    }
    return $status;
}
