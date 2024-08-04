<section class="kuesioner">
    <div class="row mx-2">
        <h1 class="mt-4">Kelola Kuesioner</h1>
        <ol class="breadcrumb mb-4 mx-3">
            <li class="breadcrumb-item"><a href="../index-admin.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Kuesioner</li>
        </ol>
        <p class="h6">Selamat datang di Halaman Kelola Kuesioner! <br> Mulailah membuat pertanyaan-pertanyaan yang
            relevan
            dan efektif untuk mengukur kualitas layanan dengan cermat dan mudah di sini.</p>
    </div>
    <div class="mt-4">
        <hr class="dropdown-divider" />
    </div>

    <div class="row-justify-content-center ">
        <button type="button" class="btn btn-primary add-button mx-3 my-3" id="callModalAddKuisioner"
            data-toggle="tooltip" data-placement="top" title="Tambah data baru"><i class="fas fa-plus"></i> Tambah
            Kuisioner</button>
        <!-- modals -->
        <div class="modal mt-4 mx-auto" tabindex="-1" id="modalShow" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" id="headerModal">
                        <h5 class="modal-title" id="modalTittle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-1 pb-0" id="bdModalKuisioner"></div>
                    <div class="modal-footer bg-custom mt-3">
                        <p style="color:#777474;">&copy; <?php echo date("Y") ?>Febrian</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modals -->
        <div class="col-md-12">
            <div class="card mx-3" width="400px">
                <div class="card-body" id="load-kuis">
                    <!-- Tabel -->
                    <div class="tabel" id="load-tabel"></div>
                    <!-- end Tabel -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {

    // LOAD TABEL
    $('#load-tabel').load('tabel.php');

    // LOAD FORM INPUT
    $('#callModalAddKuisioner').on('click', function(event) {
        event.preventDefault();
        $('#modalShow').modal('show');
        $('#modalTittle').html('Tambah Data Baru');
        $('#bdModalKuisioner').text('loading...');
        $('#bdModalKuisioner').load('form-input.php');
        $('#headerModal').removeClass();
        $('#headerModal').addClass('modal-header bg-primary text-white');
    });


})
</script>