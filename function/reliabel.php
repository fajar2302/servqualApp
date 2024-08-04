<?php

// mencari semua jawaban per user

function findAnswer($nama_tabel, $id_judul)
{
    global $koneksi;
    $total = 0;
    $query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE judul_id = '$id_judul'");
    while ($get = mysqli_fetch_assoc($query_pertanyaan)) {
        $presepsi = $get['presepsi'];
        $total += $presepsi;
    }

    return $total;
}

// mencari total skor tiap pertanyaan
function findX($id_judul, $nama_tabel)
{
    global $koneksi;
    $jumlah = 0;
    $query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' ");
    $numrows = mysqli_num_rows($query_pertanyaan);
    if ($numrows > 0) {
        while ($get = mysqli_fetch_assoc($query_pertanyaan)) {
            $id = $get['id_pertanyaan'];
            $total = GetUserSkor($id, $nama_tabel)['presepsi'];
            $jumlah += $total;
        }
        return ['jumlah' => $jumlah, 'k' => $numrows];
    }
}

// total X

function totalX($id_judul)
{
    global $koneksi;
    $totalAkhir = 0;
    $totalAkhirKuadrat = 0;
    $query_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    $numrows = mysqli_num_rows($query_user);
    while ($get = mysqli_fetch_assoc($query_user)) {
        $id_user = $get['username'];
        $nama_tabel = detailUser($id_user)['nama_tabel'];
        $total_skor_user = findX($id_judul, $nama_tabel)['jumlah'];
        $total_skor_kuadrat = $total_skor_user * $total_skor_user;
        $totalAkhir += $total_skor_user;
        $totalAkhirKuadrat += $total_skor_kuadrat;
    }
    return ['totalAkhir' => $totalAkhir, 'totalAkhirKuadrat' => $totalAkhirKuadrat, 'resp' => $numrows];
}

// mencari nilai Xt 
function findXt($id_judul)
{

    // total X
    $totalX = totalX($id_judul)['totalAkhir'];
    $totalXkuadrat = totalX($id_judul)['totalAkhirKuadrat'];
    $totalResp = totalX($id_judul)['resp'];

    // rumus
    $before = ($totalXkuadrat) - (($totalX * $totalX) / $totalResp);
    $hasil = number_format($before, 4);

    return $hasil;
}

// varians Total 

function variansTot($id_judul)
{
    $xt = findXt($id_judul);
    $n = totalX($id_judul)['resp'];

    $before = $xt / $n;
    $hasil = number_format($before, 4);

    return $hasil;
}


// Mean 
function mean($id_judul)
{
    global $koneksi;
    $totalX = totalX($id_judul)['totalAkhir'];

    // mencari K
    $query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul'");
    $k = mysqli_num_rows($query_pertanyaan);
    $hasil = $totalX / $k;
    $mean = number_format($hasil, 4);

    return ['mean' => $mean, 'k' => $k];
}


// rumus reliabel

function reliabel($id_judul)
{
    $k = mean($id_judul)['k'];
    $mean = mean($id_judul)['mean'];
    $varians = variansTot($id_judul);
    $status = '';



    // rumus 
    $ri = (($k / ($k - 1))) * (1 - (($mean * ($k - $mean)) / ($k * $varians)));
    $hasil = number_format($ri, 3);




    // status 
    if ($hasil >= 0.80 && $hasil <= 1.00) {
        $status = 'Reliabel';
    } else {
        $status = 'Tidak Reliabel';
    }

    return ['hasil' => $hasil, 'status' => $status];
}
