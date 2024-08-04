<?php
include '../../koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM tb_judul");

if (mysqli_num_rows($query) > 0) {

?>
<section class="olah-data">
    <div class="row mx-3 my-3">
        <h1 class="mt-4">Pengujian Hasil Kuesioner</h1>
        <ol class="breadcrumb mb-2 mx-3">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Hasil-Pengujian</li>
        </ol>
        <p class="h6">Selamat datang di Halaman Pengujian Kuesioner! <br>
            Halaman ini merupakan halaman untuk melihat hasil pengujian kuesioner
            yang dihitung menggunakan koefisien korelasi instrumen, sementara keandalan diukur menggunakan
            koefisien
            <span class="fst-italic">Alpha Cronbach</span>."
        </p>
    </div>
    <div class="mt-4">
        <hr class="dropdown-divider" />
    </div>
    <div id="table-data">
        <div class="card m-3">
            <div class="card-body">
                <table class="table table-bordered">

                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul Kuisioner</th>
                            <th scope="col" class="text-center">Opsi</th>
                            <!-- <th scope="col">Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $jumlah = 1;
                            while ($query_kuisioner = mysqli_fetch_assoc($query)) {
                                if ($query_kuisioner['status'] == 'true') {
                            ?>
                        <tr>
                            <td><?= $jumlah++; ?></td>
                            <td><?= $query_kuisioner['judul']; ?></td>
                            <td class="text-center">
                                <a href="#" id="open" class="open btn btn-success btn-sm"
                                    open-id="<?= $query_kuisioner['id_judul'] . "|" . $query_kuisioner['judul']; ?>">

                                    <i class="bi bi-arrow-up-right-square"></i> Detail

                                </a>
                                <a href="#" hidden id="loading" class="loading btn btn-success btn-sm" disabled>
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div> Mohon Tunggu...
                                </a>
                            </td>
                        </tr>
                        <?php
                                }
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php
} else {
?>
<h4 class="text-center text-uppercase">DATA KOSONG</h4>

<?php
}
?>

<script>
$(document).ready(function() {
    $('.open').on('click', function(e) {
        e.preventDefault();
        let data = $(this).attr('open-id');
        let pisah = data.split('|');
        id = pisah[0];
        judul = pisah[1];
        $('#loading').removeAttr('hidden');
        $('#open').attr("hidden", "hidden");
        $(this).prop("disabled", true);
        // alert(data);
        $.post('pengujian-page/validitas.php', {
            id: id,
            judul: judul,
        }, function(respon) {
            $('#open').removeAttr('hidden');
            $('#loading').attr("hidden", "hidden");
            $('#table-data').html(respon);
            $('#datatablesSimple').DataTable();
        })
    })
})
</script>