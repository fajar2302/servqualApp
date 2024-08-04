<?php
function hitung_STP($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['presepsi'];
            if ($jawaban == 1) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }
    return $stp;
}


// menghitung Tidak Puas
function hitung_TP($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['presepsi'];
            if ($jawaban == 2) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }
    return $stp;
}
// menghitung Cukup Puas
function hitung_CP($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['presepsi'];
            if ($jawaban == 3) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }

    return $stp;
}
// menghitung Puas
function hitung_P($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['presepsi'];
            if ($jawaban == 4) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }
    return $stp;
}
// menghitung Sangat Puas
function hitung_SP($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['presepsi'];
            if ($jawaban == 5) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }
    return $stp;
}



// =============================== HARAPAN ==========================================

// menghitung sangat Tidak Puas
function hitung_STP_h($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['harapan'];
            if ($jawaban == 1) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }
    return $stp;
}
// menghitung TidaK Puas
function hitung_TP_h($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['harapan'];
            if ($jawaban == 2) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }
    return $stp;
}
// menghitung Cukup Puas
function hitung_CP_h($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['harapan'];
            if ($jawaban == 3) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }
    return $stp;
}
// menghitung Puas
function hitung_P_h($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['harapan'];
            if ($jawaban == 4) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }
    return $stp;
}
// menghitung Sangat Puas
function hitung_SP_h($no_pertanyaan)
{
    global $koneksi;
    $stp = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $hasil['harapan'];
            if ($jawaban == 5) {
                $stp = $stp + $jawaban;
            }
        } else {
            return $stp;
        }
    }
    return $stp;
}



// ============== RATA - RATA Per Pertanyaan ======================== 

// rata-rata presepsi
function hitungRata($id_judul, $no_pertanyaan)
{
    global $koneksi;
    $jawaban = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    $responden = hitungRespondenperJudul($id_judul);
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $jawaban + $hasil['presepsi'];
        }
        // else {
        //     $jawaban;
        // }
    }
    $jawaban = $jawaban / $responden;
    $rata = number_format($jawaban, 2);
    return $rata;
}


// rata-rata harapan
function hitungRata_h($id_judul, $no_pertanyaan)
{
    global $koneksi;
    $jawaban = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    $responden = hitungRespondenperJudul($id_judul);
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);
            $jawaban = $jawaban + $hasil['harapan'];
        }
    }
    $jawaban = $jawaban / $responden;
    $rata = number_format($jawaban, 2);
    return $rata;
}


// =============== Hitung Rata-Rata Per Dimensi =============
function hitungRataDimensi($jenis, $judul)
{
    global $koneksi;
    $rataPrep = 0;
    $rataHar = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE jenisKuisioner_id = '$jenis' AND judul_id  = '$judul'");
    $jumlah = mysqli_num_rows($query);
    while ($data = mysqli_fetch_assoc($query)) {
        $no_pertanyaan = $data['id_pertanyaan'];
        $attribut_prep = hitungRata($judul, $no_pertanyaan);
        $attribut_har = hitungRata_h($judul, $no_pertanyaan);
        $rataPrep = $rataPrep + $attribut_prep;
        $rataHar = $rataHar + $attribut_har;
    }
    $hasil_prep = $rataPrep / $jumlah;
    $rataTotalPrep = number_format($hasil_prep, 2);
    $hasil_har = $rataHar / $jumlah;
    $rataTotalHar = number_format($hasil_har, 2);
    $rataGap = $rataTotalPrep - $rataTotalHar;
    $rataGap = number_format($rataGap, 2);

    return ['rataPrep' => $rataTotalPrep, 'rataHar' => $rataTotalHar, 'rataGap' => $rataGap];
    // return $jumlah;
}

// ====== Hitung Rata-rata Per pertanyaan
// function hitungRataPertanyaan($jenis, ){
//     global $koneksi;
//     $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE id_pertanyaan = '$no_pertanyaan'");
//     $jumlah

// }



// ============== TOTAL =============================

function hasilJumlahPrep($judul)
{
    global $koneksi;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$judul'");
    $total_stp = 0; // Variabel untuk mengakumulasi total STP
    $total_tp = 0; // Variabel untuk mengakumulasi total TP
    $total_cp = 0; // Variabel untuk mengakumulasi total CP
    $total_p = 0; // Variabel untuk mengakumulasi total P
    $total_sp = 0; // Variabel untuk mengakumulasi total SP
    $total_stp_h = 0; // Variabel untuk mengakumulasi total STP
    $total_tp_h = 0; // Variabel untuk mengakumulasi total TP
    $total_cp_h = 0; // Variabel untuk mengakumulasi total CP
    $total_p_h = 0; // Variabel untuk mengakumulasi total P
    $total_sp_h = 0; // Variabel untuk mengakumulasi total SP
    $total_rH = 0; // Variabel untuk mengakumulasi total RH
    $total_rP = 0; // Variabel untuk mengakumulasi total RP
    while ($data = mysqli_fetch_assoc($query)) {
        $id_pertanyaan = $data['id_pertanyaan'];
        $stp_p = hitung_STP($id_pertanyaan);
        $tp_p = hitung_TP($id_pertanyaan);
        $cp_p = hitung_CP($id_pertanyaan);
        $p_p = hitung_P($id_pertanyaan);
        $sp_p = hitung_SP($id_pertanyaan);
        $stp_h = hitung_STP_h($id_pertanyaan);
        $tp_h = hitung_TP_h($id_pertanyaan);
        $cp_h = hitung_CP_h($id_pertanyaan);
        $p_h = hitung_P_h($id_pertanyaan);
        $sp_h = hitung_SP_h($id_pertanyaan);
        $rP = hitungRata($judul, $id_pertanyaan);
        $rH = hitungRata_h($judul, $id_pertanyaan);
        // Akumulasi hasil STP
        $total_stp += $stp_p;
        $total_tp += $tp_p;
        $total_cp += $cp_p;
        $total_p += $p_p;
        $total_sp += $sp_p;
        $total_stp_h += $stp_h;
        $total_tp_h += $tp_h;
        $total_cp_h += $cp_h;
        $total_p_h += $p_h;
        $total_sp_h += $sp_h;
        $total_rH += $rH;
        $total_rP += $rP;
    }
    // Tampilkan baris
    return ['total_stp' => $total_stp, 'total_tp' => $total_tp, 'total_cp' => $total_cp, 'total_p' => $total_p, 'total_sp' => $total_sp, 'total_rP' => $total_rP];
}


function hitungJumlahHar($judul)
{
    global $koneksi;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$judul'");
    $total_stp_h = 0; // Variabel untuk mengakumulasi total STP
    $total_tp_h = 0; // Variabel untuk mengakumulasi total TP
    $total_cp_h = 0; // Variabel untuk mengakumulasi total CP
    $total_p_h = 0; // Variabel untuk mengakumulasi total P
    $total_sp_h = 0; // Variabel untuk mengakumulasi total SP
    $total_rH = 0; // Variabel untuk mengakumulasi total RH
    while ($data = mysqli_fetch_assoc($query)) {
        $id_pertanyaan = $data['id_pertanyaan'];
        $stp_h = hitung_STP_h($id_pertanyaan);
        $tp_h = hitung_TP_h($id_pertanyaan);
        $cp_h = hitung_CP_h($id_pertanyaan);
        $p_h = hitung_P_h($id_pertanyaan);
        $sp_h = hitung_SP_h($id_pertanyaan);
        $rH = hitungRata_h($judul, $id_pertanyaan);
        // Akumulasi hasil STP
        $total_stp_h += $stp_h;
        $total_tp_h += $tp_h;
        $total_cp_h += $cp_h;
        $total_p_h += $p_h;
        $total_sp_h += $sp_h;
        $total_rH += $rH;
    }
    // Tampilkan baris
    return ['total_stp_h' => $total_stp_h, 'total_tp_h' => $total_tp_h, 'total_cp_h' => $total_cp_h, 'total_p_h' => $total_p_h, 'total_sp_h' => $total_sp_h, 'total_rH' => $total_rH];
}
