<?php

function cekKuis($id_judul)
{
    global $koneksi;
    $cekuser = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles='responden'");
    if (mysqli_num_rows($cekuser) > 0) {
        for ($i = 0; $i < mysqli_num_rows($cekuser); $i++) {
            $cek_data = mysqli_fetch_assoc($cekuser);
            $id_user = $cek_data['username'];
            $nama_tabel = detailUser($id_user)['nama_tabel'];
            $cek = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE judul_id = '$id_judul' ");
            $valueCek = mysqli_num_rows($cek);
            if ($valueCek > 0) {
                $status = 1;
            } else {
                $status = 0;
            }
        }
    }
    return $status;
}


function ambildata($nama_tabel, $id_pertanyaan)
{
    global $koneksi;
    $ambil = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$id_pertanyaan'");
    if (mysqli_num_rows($ambil) > 0) {
        $data = mysqli_fetch_assoc($ambil);
        $presepsi = $data['presepsi'];
        $harapan = $data['harapan'];

        return ['presepsi' => $presepsi, 'harapan' => $harapan];
    } else {
        return ['presepsi' => '', 'harapan' => ''];
    }
}

function cek_kuadran($id_judul, $x, $y)
{
    $titikTengah = ['x' => totXbarYbar($id_judul)['totalXbar'], 'y' => totXbarYbar($id_judul)['totalYbar']];
    $batasX = $titikTengah['x'];
    $batasY = $titikTengah['y'];

    if ($x < $batasX && $y > $batasY) {
        return 'Kuadran 1';
    } else if ($x > $batasX && $y > $batasY) {
        return 'Kuadran 2';
    } else if ($x < $batasX && $y < $batasY) {
        return 'Kuadran 3';
    } else if ($x > $batasX && $y < $batasY) {
        return 'Kuadran 4';
    } else {
        return 'Kesalahan';
    }
}

function kuadran($id_judul, $kuadran)
{
    global $koneksi;

    $pertanyaan_sesuai = array(); // Inisialisasi array untuk menyimpan pertanyaan sesuai dengan kuadran

    $queryPertanyaanXbar = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' ORDER BY jenisKuisioner_id ASC, item_pertanyaan ASC");

    while ($data_kartesius = mysqli_fetch_assoc($queryPertanyaanXbar)) {
        $pertanyaan = $data_kartesius['item_pertanyaan'];
        $id_pertanyaan = $data_kartesius['id_pertanyaan'];

        $xbar = hitungTotal($id_pertanyaan)['jawabanPrep'] / hitungRespondenperJudul($id_judul);
        $ybar = hitungTotal($id_pertanyaan)['jawabanHar'] / hitungRespondenperJudul($id_judul);

        $cek_kuadran = cek_kuadran($id_judul, $xbar, $ybar);

        if ($cek_kuadran == $kuadran) {
            $pertanyaan_sesuai[] = $pertanyaan; // Menambahkan pertanyaan ke array jika sesuai dengan kuadran
        }
    }

    return $pertanyaan_sesuai; // Mengembalikan array pertanyaan sesuai dengan kuadran
}

function cek_pernyataan($kuadran)
{
    if ($kuadran == "Kuadran 1") {
        $pernyataan = "Tingkat kepentingan tinggi, Tingkat kepuasan kinerja rendah";
    } else if ($kuadran == "Kuadran 2") {
        $pernyataan = "Tingkat Kepentingan tinggi, Tingkat kepuasan kinerja tinggi";
    } else if ($kuadran == "Kuadran 3") {
        $pernyataan = "Tingkat kepentingan rendah, Tingkat kepuasan kinerja rendah";
    } elseif ($kuadran == "Kuadran 4") {
        $pernyataan = "Tingkat kepentingan rendah, Tingkat kepuasan tinggi";
    }
    return $pernyataan;
}





// mencari total xbar dan ybar
function totXbarYbar($id_judul)
{
    global $koneksi;
    $totalXbar = 0;
    $totalYbar = 0;
    $rataTingkatKesesuaian = 0;
    $queryPertanyaanXbar = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' ORDER BY jenisKuisioner_id ASC, item_pertanyaan ASC");
    $jumlah_pertanyaan = mysqli_num_rows($queryPertanyaanXbar);
    if ($queryPertanyaanXbar) {
        while ($data = mysqli_fetch_assoc($queryPertanyaanXbar)) {
            $id_pertanyaan = $data['id_pertanyaan'];

            $xbar = hitungTotal($id_pertanyaan)['jawabanPrep'] / hitungRespondenperJudul($id_judul);
            $ybar = hitungTotal($id_pertanyaan)['jawabanHar'] / hitungRespondenperJudul($id_judul);

            $totalXbar = $totalXbar + $xbar;
            $totalYbar = $totalYbar + $ybar;
            $tingkatKesesuaian = (hitungTotal($id_pertanyaan)['jawabanPrep'] / hitungTotal($id_pertanyaan)['jawabanHar']) * 100;
            $tingkatKesesuaian = number_format($tingkatKesesuaian, 2);
            $rataTingkatKesesuaian += $tingkatKesesuaian;
        }
        $totalXbar = $totalXbar / $jumlah_pertanyaan;
        $totalXbar = number_format($totalXbar, 2);
        $totalYbar = $totalYbar / $jumlah_pertanyaan;
        $totalYbar = number_format($totalYbar, 2);
        $rataTingkatKesesuaian /= $jumlah_pertanyaan;
        $rataTingkatKesesuaian = number_format($rataTingkatKesesuaian, 2);
    }

    return ['totalXbar' => $totalXbar, 'totalYbar' => $totalYbar];
}
