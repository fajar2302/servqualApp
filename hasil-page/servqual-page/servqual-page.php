<?php
include '../../koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM tb_judul");

if (mysqli_num_rows($query) > 0) {

?>
<section class="olah-data">
    <div class="row mx-3 my-3">
        <h1 class="mt-4 text-uppercase">Servqual</h1>
        <ol class="breadcrumb mb-2 mx-3">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Servqual</li>
        </ol>
        <p class="h6"> Selamat datang di halaman Service Quality! <br>
            halaman ini berfungsi untuk melihat hasil pengolahan data kuesioner menggunakan metode <span
                class="fst-italic">service
                quaity</span> yang telah visualisasikan dengan interpolasi gap untuk memisahkan
            kepentingan
            dalam kuadran.
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
                                <a href="#" class="open btn btn-success btn-sm" id="open"
                                    open-id="<?= $query_kuisioner['id_judul'] . "|" . $query_kuisioner['judul']; ?>">
                                    <i class="bi bi-arrow-up-right-square"></i> Detail
                                </a>
                                <a href="#" hidden id="loading" class="loading btn btn-success btn-sm" disabled>
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div> Mohon Tunggu...
                                </a>
                                <a href="#" class="print btn btn-primary btn-sm"
                                    print-id="<?= $query_kuisioner['id_judul'] ?>" target="_blank">
                                    <i class="bi bi-file-earmark-arrow-down"></i> Cetak
                                </a>

                            </td>
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
        $.post('servqual-page/servqualGapTotal.php', {
            id: id,
            judul: judul,
        }, function(respon) {
            $('#open').removeAttr('hidden');
            $('#loading').attr("hidden", "hidden");
            $('#table-data').html(respon);
            $('#datatablesSimple').DataTable();
        })
    })
    $('.print').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('print-id');
        let directLink = '../hasil-page/print-servqual/data.php?id=' + id;

        // Mengarahkan browser ke direct link
        window.open(directLink, '_blank');
    })
})
</script>