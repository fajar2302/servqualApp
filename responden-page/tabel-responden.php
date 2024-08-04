<?php
include '../koneksi.php';


$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");

?>



<thead>
    <tr>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Umur</th>
        <th>Pekerjaan</th>
        <th>Tgl Pengisian</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Umur</th>
        <th>Pekerjaan</th>
        <th>Tgl Pengisian</th>
    </tr>
</tfoot>
<tbody>
    <?php
    while ($data = mysqli_fetch_assoc($query)) {
        $id_user = $data['username'];
        $nama = $data['nama'];
        $jenkel = $data['jenis_kelamin'];
        $alamat = $data['alamat'];
        $umur = $data['umur'];
        // $pekerjaan = $data['pekerjaan'];
        // $tgl_pengisian = $data['tgl_pengisian'];


    ?>
    <tr>
        <td><?= $nama ?></td>
        <td><?= $jenkel ?></td>
        <td><?= $alamat ?></td>
        <td><?= $umur ?></td>
        <td></td>
        <td></td>
    </tr>
    <?php
    }
    ?>
</tbody>