<?php

// menghitung jumlah pertanyaan
function QuestionCalcultae($judul)
{
    global $koneksi;
    $query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$judul' ");
    $num_rows = mysqli_num_rows($query_pertanyaan);


    return $num_rows;
}

// mengambil jawaban user
function GetUserSkor($id_pertanyaan, $nama_tabel)
{
    global $koneksi;
    $query_skor = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$id_pertanyaan'");
    if (mysqli_num_rows($query_skor) > 0) {

        while ($get = mysqli_fetch_assoc($query_skor)) {
            $presepsi = $get['presepsi'];
            $harapan = $get['harapan'];
        }
        return ['presepsi' => $presepsi, 'harapan' => $harapan];
    }
}

// mengambil semua jawaban user per judul
function GetUserSkorbyTitle($judul, $nama_tabel)
{
    global $koneksi;
    $total_p = 0;
    $total_h = 0;
    $query_skor = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE judul_id = '$judul' ASC");
    if (mysqli_num_rows($query_skor)> 0){

        while ($get = mysqli_fetch_assoc($query_skor)) {
            $presepsi = $get['presepsi'];
            $harapan = $get['harapan'];
            $total_p += $presepsi;
        }
        $total_h += $harapan;
    }

    return ['total_presepsi' => $total_p, 'total_harapan' => $total_h];
}


// get data presepsi
function getSkor($nama_tabel, $judul)
{
    global $koneksi;

    $query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE judul_id = '$judul' ");
}

// menghitung varians butir
function Variabel($id_pertanyaan, $judul)
{
    global $koneksi;

    // mengambil data user
    $query_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    $total_value = 0;
    while ($get_user = mysqli_fetch_assoc($query_user)) {
        $id_user = $get_user['username'];
        $get_table_name = detailUser($id_user);
        $nama_tabel = $get_table_name['nama_tabel'];
        $presepsi_value = GetUserSkor($id_pertanyaan, $nama_tabel)['presepsi']; // nilai X
        $value_kuadrat = $presepsi_value * $presepsi_value; // nilai x kuadrat
        $total_value += $presepsi_value;
    }
    // $total_value = hitungTotal($id_pertanyaan); // total Nilai X
    $total_value_kuadrat = $value_kuadrat * $value_kuadrat; // total nilai x kuadrat

    $question_num_rows = QuestionCalcultae($judul); //nilai N

    $operasi1 = $total_value_kuadrat - (($total_value * $total_value) / $question_num_rows);
    $hasil = $operasi1 / $question_num_rows;
    $varians = number_format($hasil, 4);

    return $varians;
    // return ['totalX_kuadrat_value' => $total_value_kuadrat, 'totalXprep_value' => $total_value, 'nValue' => $question_num_rows];
}


// menghitung varians total

function variansTotal($judul)
{
    global $koneksi;
    // mengambil data user
    $jumlah = 0;
    $total_kuadrat = 0;
    $query_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($get_user = mysqli_fetch_assoc($query_user)) {
        $id_user = $get_user['username'];
        $get_table_name = detailUser($id_user);
        $nama_tabel = $get_table_name['nama_tabel'];
        $presepsi_total = GetUserSkorbyTitle($judul, $nama_tabel)['total_presepsi']; // jumlah skor seluruh pertanyaan peruser
        $jumlah += $presepsi_total; //nilai jumlah seluruh pertanyan user

        $total_ykuadrat = totalY($nama_tabel)['ykuadrat_presepsi'];

        $total_kuadrat += $total_ykuadrat;
    }



    //  jumlah responden
    $jumlah_resp = mysqli_num_rows($query_user); //jumlah responden

    // rumus varians total
    $pembilang_kanan = ($jumlah * $jumlah) / $jumlah_resp;
    $perhitungan_pembilang  = $total_kuadrat - $pembilang_kanan;
    $hasil = $perhitungan_pembilang / $jumlah_resp;
    $varians_total = number_format($hasil, 4);


    return $varians_total;
}

// jumlah varians butir
function totalVarians($judul)
{
    global $koneksi;
    $total_var_butir = 0;
    $query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$judul'");
    while ($get = mysqli_fetch_assoc($query_pertanyaan)) {
        $id_pertanyaan = $get['id_pertanyaan'];
        $varians_butir = Variabel($id_pertanyaan, $judul);
        $total_var_butir += $varians_butir;
    }

    return $total_var_butir;
}


// rumus reliabel