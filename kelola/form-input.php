<!-- Modal -->

<form id="form-data">
    <div class="mb-3">
        <label for="exampleInputText1" class="form-label">Judul</label>
        <input type="text" class="form-control name" id="exampleInputText1" name="judul">
    </div>
    <div class="mb-3">
        <label for="exampleInputText2" class="form-label">Lokasi</label>
        <input type="text" class="form-control lokasi" id="exampleInputText2" name="lokasi">
        <input type="hidden" class="status" id="exampleInputText2" name="status" value="false">
    </div>
    <div class="mb-3">
        <label for="exampleInputText3" class="form-label">Tahun</label>
        <select class="form-select" aria-label="Default select example" name="tahun">
            <option value="">-select option-</option>
            <?php
            $tahun = date('Y');
            for ($i = 0; $i < 10; $i++) {
            ?>
                <option value="<?= $tahun - $i; ?>"><?= $tahun - $i; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="d-grid col-6 mx-auto">
        <button class="btn add-button btn-primary" type="submit" name="simpan">SIMPAN</button>
    </div>
</form>
<script>
    $(document).ready(function() {

        function load_tabel() {

        }

        // FUNGSI KETIKA MEMASUKKAN DATA
        $('#form-data').submit(function(e) {
            e.preventDefault();

            let judul = $('#exampleInputText1').val();
            let lokasi = $('#exampleInputText2').val();
            let select = $('.form-select').val();

            if (judul && lokasi && select) {
                let data = $(this).serialize();
                $.post('proses-input.php', 'simpan=&' + data, function(respon) {
                    $('#modalShow').modal('hide');
                    var pecah = respon.split('|');
                    Swal.fire({
                        position: 'center',
                        icon: pecah[0],
                        title: pecah[1],
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if (pecah[0] == 'success') {
                        let id = pecah[2]; // Periksa apakah pecah sudah didefinisikan
                        $.post('pertanyaan/pertanyaan.php', {
                            id: id,
                        }, function(response) {
                            $('#main-container').html(response);
                        })
                    }
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Silahkan Lengkapi Form',
                    showConfirmButton: false,
                    timer: 1500
                });
                // Tambahkan kelas border-danger hanya jika nilai kosong
                $('#exampleInputText1').toggleClass('border border-danger', !judul);
                $('#exampleInputText2').toggleClass('border border-danger', !lokasi);
                $('.form-select').toggleClass('border border-danger', !select);
            }
        });

    })
</script>