<?php
// mencari nama tabel dan nama user
function hitungRespondenperJudul($id)
{
    global $koneksi;

    $query_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    $jumlah = 0;
    while ($data = mysqli_fetch_assoc($query_user)) {
        $id_user = $data['username'];
        $nama_tabel = detailUser($id_user)['nama_tabel'];
        $query_hasil = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE judul_id = '$id' GROUP BY judul_id");
        $baris = mysqli_num_rows($query_hasil);
        $jumlah = $jumlah +  $baris;
    }
    return $jumlah;
}


function detailUser($id_user)
{
    global $koneksi;

    $query_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$id_user'");
    $cek = mysqli_num_rows($query_user);
    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query_user);
        $hapus_spasi = str_replace(".", "", $data['nama']);
        $nama_tabel = str_replace(' ', '', $hapus_spasi) . '_' . $id_user;

        return ['nama' => $data['nama'], 'nama_tabel' => $nama_tabel];
    }
}


// menghitung total presepsi tiap pertanyaan
function hitungTotal($no_pertanyaan)
{
    global $koneksi;
    $jawaban = 0;
    $jawabanHar = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $jawaban + $hasil['presepsi'];
            $jawabanHar = $jawabanHar + $hasil['harapan'];
        }
    }
    return ['jawabanPrep' => $jawaban, 'jawabanHar' => $jawabanHar];
}


function totalxy($nilai_x, $nilai_y)
{
    $hasil = $nilai_x * $nilai_y;

    return $hasil;
}

// mencari nilai N
function findn($nama_tabel)
{
    global $koneksi;
    $jumlahBaris = '';
    $queryCheck = mysqli_query($koneksi, "SELECT * FROM $nama_tabel GROUP BY judul_id");
    $ambilBaris = mysqli_num_rows($queryCheck);
    if ($ambilBaris > 0) {
        $jumlahBaris = $ambilBaris;
    } else {
        $jumlahBaris = 0;
    }

    return $jumlahBaris;
}

// mencari nilai Y dan y kuadrat per tabel
function totalY($nama_tabel)
{
    global $koneksi;
    $jumlah_p = 0;
    $jumlah_h = 0;
    $ykuadrat_harapan = 0;
    $ykuadrat_presepsi = 0;
    $query = mysqli_query($koneksi, "SELECT * FROM $nama_tabel");
    while ($data = mysqli_fetch_assoc($query)) {
        $jumlah_p += $data['presepsi'];
        $jumlah_h += $data['harapan'];
    }
    $ykuadrat_harapan = $jumlah_h * $jumlah_h;
    $ykuadrat_presepsi = $jumlah_p * $jumlah_p;
    return ['nilaiy_presepsi' => $jumlah_p, 'nilaiy_harapan' => $jumlah_h, 'ykuadrat_harapan' => $ykuadrat_harapan, 'ykuadrat_presepsi' => $ykuadrat_presepsi];
}

// untuk mendapatkan nilai X dan X kuadrat per user
function presepsi_harapan($nama_tabel, $id_pertanyaan)
{
    global $koneksi;
    $kuadrat_presepsi = 0;
    $kuadrat_harapan = 0;
    $presepsi = 0;
    $harapan = 0;
    $query = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$id_pertanyaan' ");
    if (mysqli_num_rows($query) > 0) {

        while ($data = mysqli_fetch_assoc($query)) {
            $presepsi = $data['presepsi'];
            $harapan = $data['harapan'];
        }
        // kuadrat
        $kuadrat_presepsi = $presepsi * $presepsi;
        $kuadrat_harapan = $harapan * $harapan;
    }
    return ['presepsi' => $presepsi, 'harapan' => $harapan, 'presepsi_kuadrat' => $kuadrat_presepsi, 'harapan_kuadrat' => $kuadrat_harapan];
}





// penggabungan variabel 
function mix($id_pertanyaan)
{
    global $koneksi;
    // deklarasi user
    $total_presepsi = 0;
    $total_harapan = 0;
    $total_nilaiY_h = 0;
    $total_nilaiY_p = 0;
    $total_nilaiXY_presepsi = 0;
    $total_nilaiXY_harapan = 0;
    $total_presepsi_kuadrat = 0;
    $total_harapan_kuadrat = 0;
    $total_nilaiY_kuadrat_p = 0;
    $total_nilaiY_kuadrat_h = 0;
    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($fetch = mysqli_fetch_assoc($query)) {
        $id = $fetch['username'];
        $fetch_data_from_user = detailUser($id);
        $nama_tabel = $fetch_data_from_user['nama_tabel'];

        // mencari nilai X
        $fetch_data_from_x = presepsi_harapan($nama_tabel, $id_pertanyaan);
        $presepsi = $fetch_data_from_x['presepsi'];
        $harapan = $fetch_data_from_x['harapan'];
        $presepsi_kuadrat = $fetch_data_from_x['presepsi_kuadrat'];
        $harapan_kuadrat = $fetch_data_from_x['harapan_kuadrat'];

        // mencari nilai Y 
        $fetch_data_from_y = totalY($nama_tabel);
        $y_presepsi = $fetch_data_from_y['nilaiy_presepsi'];
        $y_harapan = $fetch_data_from_y['nilaiy_harapan'];
        $ykuadrat_h = $fetch_data_from_y['ykuadrat_harapan'];
        $ykuadrat_p = $fetch_data_from_y['ykuadrat_presepsi'];

        // mencari nilai XY 
        $hasilxy_presepsi = totalxy($presepsi, $y_presepsi);
        $hasilxy_harapan = totalxy($harapan, $y_harapan);

        // menghitung nilai N 
        $num_rows = mysqli_num_rows($query);
        // $queryCheck = mysqli_query($koneksi, "SELECT * FROM $nama_tabel GROUP BY judul_id");
        // $ambilBaris = mysqli_num_rows($queryCheck);
        // if ($ambilBaris > 0) {
        //     $num_rows = $ambilBaris;
        // } else {
        //     $num_rows = 0;
        // }


        // menghitung total nilai X, Y, XY, X kuadrat, Y kuadrat
        $total_presepsi += $presepsi; //nilai X untuk poin presepsi
        $total_harapan += $harapan; //nilai X untuk poin harapan
        $total_nilaiY_p += $y_presepsi;
        $total_nilaiY_h += $y_harapan;
        $total_nilaiXY_presepsi += $hasilxy_presepsi;
        $total_nilaiXY_harapan += $hasilxy_harapan;
        $total_presepsi_kuadrat += $presepsi_kuadrat;
        $total_harapan_kuadrat += $harapan_kuadrat;
        $total_nilaiY_kuadrat_h += $ykuadrat_h;
        $total_nilaiY_kuadrat_p += $ykuadrat_p;
    }

    return ['nilai_n' => $num_rows, 'totalx_p' => $total_presepsi, 'totalx_h' => $total_harapan, 'totaly_p' => $total_nilaiY_p, 'totaly_h' => $total_nilaiY_h, 'totalxy_p' => $total_nilaiXY_presepsi, 'totalxy_h' => $total_nilaiXY_harapan, 'total_presepsi_kuadrat' => $total_presepsi_kuadrat, 'total_harapan_kuadrat' => $total_harapan_kuadrat, 'totaly_kuadrat_h' => $total_nilaiY_kuadrat_h, 'totaly_kuadrat_p' => $total_nilaiY_kuadrat_p];
}

// rumus korelasi

// n kali sigma xy fungsi
function pembilang($id_pertanyaan)
{
    $mix = mix($id_pertanyaan);
    $n = $mix['nilai_n'];
    $totalxy_p = $mix['totalxy_p'];
    $totalxy_h = $mix['totalxy_h'];
    $totalx_p = $mix['totalx_p'];
    $totalx_h = $mix['totalx_h'];
    $totaly_p = $mix['totaly_p'];
    $totaly_h = $mix['totaly_h'];

    // operasi 1 perkalian untuk xy presepsi
    $operasi_presepsi = $n * $totalxy_p;

    // operasi 2 perkalian untuk xy harapan
    $operasi_harapan = $n * $totalxy_h;

    // operasi 1 kanan atas, perkalian sigma x dengan sigma y untuk presepsi 
    $operasi_totx_toty_presepsi = $totalx_p * $totaly_p;

    // operasi 1 kanan atas, perkalian sigma x dengan sigma y untuk harapan 
    $operasi_totx_toty_harapan = $totalx_h * $totaly_h;

    // pengurangan operasi 1 dan operasi 1 kanan atas (presepsi)
    $pembilang_p = $operasi_presepsi - $operasi_totx_toty_presepsi;

    // pengurangan operasi 1 dan operasi 1 kanan atas (harapan)
    $pembilang_h = $operasi_harapan - $operasi_totx_toty_harapan;

    return ['pembilang_p' => $pembilang_p, 'pembilang_h' => $pembilang_h];
}



function penyebut($id_pertanyaan)
{
    $mix = mix($id_pertanyaan);
    $n = $mix['nilai_n'];
    $totalx_p = $mix['totalx_p'];
    $totalx_h = $mix['totalx_h'];
    $totalxp_kuadrat = $mix['total_presepsi_kuadrat'];
    $totalxh_kuadrat = $mix['total_harapan_kuadrat'];
    $totaly_p = $mix['totaly_p'];
    $totaly_h = $mix['totaly_h'];
    $totaly_kuadrat_h = $mix['totaly_kuadrat_h'];
    $totaly_kuadrat_p = $mix['totaly_kuadrat_p'];

    // operasi 1 perkalian n dan xkuadrat (presepsi)
    $operasi_presepsi_x = $n * $totalxp_kuadrat;

    // operasi 2 perkalian n dan xkuadrat (harapan)
    $operasi_harapan_x = $n * $totalxh_kuadrat;

    // operasi 1 total x dipangkat 2 (presepsi)
    $pangkat_x_presepsi = $totalx_p * $totalx_p;

    // operasi 2 total x dipangkat 2 (harapan)
    $pangkat_x_harapan = $totalx_h * $totalx_h;


    // menyelesaikan x untuk operasi 1 dan operasi 1 presepsi
    $penyebutp_1 = $operasi_presepsi_x - $pangkat_x_presepsi;

    // menyelesaikan x untuk operasi 2 dan operasi 2 harapan
    $penyebuth_1 = $operasi_harapan_x - $pangkat_x_harapan;


    // operasi 1 perkalian n dan ykuadrat (presepsi)
    $operasi_presepsi_y = $n * $totaly_kuadrat_p;

    // operasi 2 perkalian n dan ykuadrat (harapan)
    $operasi_harapan_y = $n * $totaly_kuadrat_h;

    // operasi 1 total y dipangkat 2 (presepsi)
    $pangkat_y_presepsi = $totaly_p * $totaly_p;

    // operasi 2 total y dipangkat 2 (harapan)
    $pangkat_y_harapan = $totaly_h * $totaly_h;


    // menyelesaikan y untuk operasi 1 dan operasi 1 presepsi
    $penyebutp_2 = $operasi_presepsi_y - $pangkat_y_presepsi;

    // menyelesaikan y untuk operasi 2 dan operasi 2 harapan
    $penyebuth_2 = $operasi_harapan_y - $pangkat_y_harapan;


    // mengalikan penyebut 1 dan 2

    $penyebut_p = sqrt($penyebutp_1 * $penyebutp_2);
    $penyebut_h = sqrt($penyebuth_1 * $penyebuth_2);

    return ['penyebut_p' => $penyebut_p, 'penyebut_h' => $penyebut_h];
}


// rumus Akhir
function korelasi($id_pertanyaan)
{
    $ambil_pembilang = pembilang($id_pertanyaan);
    $pembilang_p = $ambil_pembilang['pembilang_p'];
    $pembilang_h = $ambil_pembilang['pembilang_h'];

    $ambil_penyebut = penyebut($id_pertanyaan);
    $penyebut_p = $ambil_penyebut['penyebut_p'];
    $penyebut_h = $ambil_penyebut['penyebut_h'];
    if ($penyebut_p != 0) {
        $angka_p = $pembilang_p / $penyebut_p;
        $korelasi_p = number_format($angka_p, 4);
    } else {
        $korelasi_p = '∞';
    }

    if ($penyebut_h != 0) {
        $angka_h = $pembilang_h / $penyebut_h;
        $korelasi_h = number_format($angka_h, 4);
    } else {
        $korelasi_h = '∞';
    }

    return ['korelasi_p' => $korelasi_p, 'korelasi_h' => $korelasi_h];
}

function rtabel($rhitung)
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    $rtabel20 = 0;
    $status = '';
    while ($get = mysqli_fetch_assoc($query)) {
        $id = $get['username'];
        $get_table_name = detailUser($id);
        $table_name = $get_table_name['nama_tabel'];
        $findN = findn($table_name);
        if ($findN > 0) {
            $rtabel20 = 0.3598; //rtabel dari total responden 20 orang, dengan signifikansi 10%
            if ($rtabel20 < $rhitung) {
                $status = 'Valid';
            } else {
                $status = 'Tidak Valid';
            }
        }
    }

    return ['status' => $status, 'rtabel' => $rtabel20];
}


// penentuan Rtabel 