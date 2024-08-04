<?php
require '../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM `tb_judul`");

if (mysqli_num_rows($result) > 0) {
?>
    <table class="table table-bordered">

        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 480px;">Judul Kuisioner</th>
                <th scope="col">Tahun</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Opsi</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jumlah = 1;
            while ($query_kuisioner = mysqli_fetch_assoc($result)) {
                if ($query_kuisioner['status'] === 'true') {
                    $status = 'checked';
                } else {
                    $status = '';
                }
            ?>
                <tr>
                    <td><?= $jumlah++; ?></td>
                    <td><a class="open text-decoration-none text-black" open-id="<?= $query_kuisioner['id_judul'] . "|" . $query_kuisioner['judul']; ?>" href="#"><?= $query_kuisioner['judul']; ?></a>
                    </td>
                    <td><?= $query_kuisioner['tahun']; ?></td>
                    <td><?= $query_kuisioner['lokasi']; ?></td>
                    <td><a class="info btn btn-primary btn-sm" info-id="<?= $query_kuisioner['id_judul']; ?>" href="#">

                            <i class="bi bi-info-circle"></i> Lihat

                        </a>
                        <a class="edit btn btn-success btn-sm" edit-id="<?= $query_kuisioner['id_judul'] . " |" . $query_kuisioner['judul']; ?>" href="#" role="button">

                            <i class="bi bi-pencil-square"></i> Edit

                        </a>
                        <a class="hapus btn btn-danger btn-sm" hapus-id="<?= $query_kuisioner['id_judul']; ?>" href="#">

                            <i class="bi bi-trash"></i> Hapus

                        </a>
                    </td>
                    <td>
                        <div class="form-check text-center form-switch">
                            <input class="form-check-input" type="checkbox" status-id=<?= $query_kuisioner['id_judul']; ?> name="status" role="switch" id="flexSwitchCheckChecked" value="<?= $query_kuisioner['status'] ?>" <?= $status; ?>>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

<?php

} else {
    echo "<h4 class='text-center'>DATA KOSONG</h4>";
}
?>

<!-- modals -->
<div class="row-justify-content-center">
    <div class="modal mt-4 mx-auto" tabindex="-1" id="modalShow">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="headerModal">
                    <h5 class="modal-title" id="modalTittle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pb-0" id="bdModalKuisioner"></div>
                <div class="modal-footer mt-3">
                    <p style="color:#777474;">&copy; <?php echo date("Y") ?> Febrian</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modals -->



<script>
    // kalo dalam perulangan, jangan pakai id. pakai class
    $(document).ready(function() {

        // fungsi ketika klik buka
        $('.open').on('click', function(e) {
            e.preventDefault();

            let data = $(this).attr('open-id');
            let pisah = data.split('|');
            let id = pisah[0];
            // alert(pisah[1]);
            $.post('pertanyaan/pertanyaan.php', {
                id: id,
            }, function(response) {
                $('#main-container').html(response);
            })


        })

        // fungsi ketika klik info
        $('.info').on('click', function(e) {
            e.preventDefault();
            // alert('bisa');
            let data = $(this).attr('info-id');
            $('#modalShow').modal('show');
            $('#modalTittle').html('Kuesioner Info');
            $.post('info.php', {
                id: data,
            }, function(respon) {
                $('#bdModalKuisioner').html(respon);
                $('#headerModal').removeClass();
                $('#headerModal').addClass('modal-header bg-primary text-white')
            })
        })

        // fungsi ketika klik hapus
        $('.hapus').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('hapus-id');
            Swal.fire({
                title: 'Yakin Ingin Menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('proses-input.php', 'hapus=' + id, function(respon) {
                        var pecah = respon.split('|');
                        $('#load-tabel').load('tabel.php');
                        Swal.fire({
                            position: 'center',
                            icon: pecah[0],
                            title: pecah[1],
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                }
            })


        })

        // fungsi ketika klik edit
        $('.edit').on('click', function(e) {
            let data = $(this).attr('edit-id');
            let pisah = data.split('|');
            let id = pisah[0];
            let judul = pisah[1];
            e.preventDefault();
            $('#modalShow').modal('show');
            $('#modalTittle').html(id + '-' + judul);
            $.post(
                'edit.php', {
                    id: id,
                },
                function(respon) {
                    $('#bdModalKuisioner').html(respon);
                    $('#headerModal').removeClass();
                    $('#headerModal').addClass('modal-header bg-success text-white')
                }
            );
        });


        // Fungsi Ketika Switch Status di Tekan
        $('.form-check-input').on('click', function(e) {
            e.preventDefault();
            let id = $(this).attr('status-id');
            let formStatus = $(this).val();
            // alert(formStatus);
            if (formStatus === 'false') {
                formStatus = 'true';
            } else if (formStatus === 'true') {
                formStatus = 'false';
            }
            Swal.fire({
                icon: 'question',
                title: 'Anda Yakin Ingin Mengganti Status?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Ganti',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.post('switchButton.php', {
                        id: id,
                        status: formStatus,
                    }, function(respon) {
                        let pecah = respon.split('|');
                        $('#main-container').load('kuesioner-page.php');
                        Swal.fire({
                            position: 'center',
                            icon: pecah[0],
                            title: pecah[1],
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                }
            })
        });
    })
</script>