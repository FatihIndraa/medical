<!-- Modal untuk menampilkan detail pasien -->
<div class="modal fade" id="patientDetailsModal" tabindex="-1" aria-labelledby="patientDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patientDetailsModalLabel">Detail Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Nama Pasien:</h5>
                <p id="namaPasien"></p>
                <h5>Jenis Kelamin:</h5>
                <p id="jenisKelaminPasien"></p>
                <h5>Alamat:</h5>
                <p id="alamatPasien"></p>
                <h5>Nama Dokter:</h5>
                <p id="namaDokter"></p>
                <h5>Nomor yang bisa dihubungi:</h5>
                <p id="telp"></p>
                <h5>Keluhan:</h5>
                <p id="keluhanPasien"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk mengedit data pasien -->
<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPatientModalLabel">Edit Data Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPatientForm" data-rekam-medis-id="" method="PUT">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="userId"> <!-- Input userId ditambahkan di sini -->
                    <div class="mb-3">
                        <label for="editNamaPasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="editNamaPasien" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editNamaDokter" class="form-label">Nama Dokter</label>
                        <select class="form-select" id="editNamaDokter" name="dokter">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editJenisKelaminPasien" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="editJenisKelaminPasien" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editAlamatPasien" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="editAlamatPasien" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="telpEdit" class="form-label">Nomor yang bisa dihubungi</label>
                        <input type="number" class="form-control" id="telpEdit">
                    </div>
                    <div class="mb-3">
                        <label for="editKeluhanPasien" class="form-label">Keluhan</label>
                        <input type="text" class="form-control" id="editKeluhanPasien">
                    </div>
                    <input type="hidden" id="userId">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Fungsi untuk menampilkan detail pasien
    function showPatientDetails(nama, jenisKelamin, alamat, namaDokter, telpPasien, keluhan) {
        document.getElementById("namaPasien").innerHTML = nama;
        document.getElementById("jenisKelaminPasien").innerHTML = jenisKelamin;
        document.getElementById("alamatPasien").innerHTML = alamat;
        document.getElementById("namaDokter").innerHTML = namaDokter;
        document.getElementById("telp").innerHTML = telpPasien;
        document.getElementById("keluhanPasien").innerHTML = keluhan;
        var myModal = new bootstrap.Modal(document.getElementById('patientDetailsModal'));
        myModal.show();
    }

    // Fungsi untuk mengisi formulir edit dengan data pasien yang dipilih
    function editPatientDetails(nama, jenisKelamin, alamat, dokterId, telp, keluhan, dokters, rekamMedisId, userId) {
        // Isi formulir edit dengan data yang tepat
        document.getElementById("editNamaPasien").value = nama;
        document.getElementById("editJenisKelaminPasien").value = jenisKelamin;
        document.getElementById("editAlamatPasien").value = alamat;

        var select = document.getElementById("editNamaDokter");
        select.innerHTML = ''; // Kosongkan opsi dokter sebelum menambahkan yang baru
        dokters.forEach(function(dokter) {
            var option = document.createElement("option");
            option.text = dokter.name;
            option.value = dokter.id;
            if (dokter.id === dokterId) {
                option.selected = true; // Pilih opsi dokter yang sesuai dengan dokterId
            }
            select.appendChild(option);
        });

        // Set nilai nomor telepon pasien menggunakan properti value
        document.getElementById("telpEdit").value = telp; // Updated ID to telpEdit

        document.getElementById("editKeluhanPasien").value = keluhan; // Isi input keluhan

        // Simpan ID pasien dan dokter dalam atribut data untuk referensi nanti
        document.getElementById("editPatientForm").setAttribute("data-pasien-id", nama);
        document.getElementById("editPatientForm").setAttribute("data-dokter-id", dokterId);
        document.getElementById("editPatientForm").setAttribute("data-rekam-medis-id", rekamMedisId);
        document.getElementById("userId").value = userId; // Atur nilai userId

        // Tampilkan modal edit
        var myModal = new bootstrap.Modal(document.getElementById('editPatientModal'));
        myModal.show();
    }


    // Menangani submit formulir edit pasien
    document.getElementById("editPatientForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah pengiriman formulir secara default

        // Ambil data yang diedit dari formulir
        var userId = document.getElementById("userId").value;
        var rekamMedisId = this.getAttribute("data-rekam-medis-id"); // Ambil ID rekam medis dari atribut data

        var nama = document.getElementById("editNamaPasien").value;
        var dokterId = document.getElementById("editNamaDokter").value;
        var keluhan = document.getElementById("editKeluhanPasien").value;
        var telp = document.getElementById("telpEdit").value; // Updated ID to telpEdit
        var jenisKelamin = document.getElementById("editJenisKelaminPasien").value; // Ambil jenis kelamin yang diedit
        var alamat = document.getElementById("editAlamatPasien").value; // Ambil alamat yang diedit

        // Kirim data yang diedit ke server menggunakan AJAX
        axios.put('/rekam-medis/' + rekamMedisId, {
                user_id: userId,
                dokter: dokterId,
                keluhan: keluhan,
                telp: telp, // Kirim nomor telepon yang diedit
                jenis_kelamin: jenisKelamin, // Kirim jenis kelamin yang diedit
                alamat: alamat // Kirim alamat yang diedit
            })
            .then(function(response) {
                // Tanggapi respons dari server di sini
                console.log(response);
                // Tampilkan pesan sukses
                alert('Rekam Medis berhasil diperbarui');
                // Sembunyikan modal setelah berhasil
                var myModal = new bootstrap.Modal(document.getElementById('editPatientModal'));
                myModal.hide();
                // Perbarui halaman setelah berhasil menyimpan perubahan
                window.location.reload();
            })
            .catch(function(error) {
                // Tangani kesalahan jika terjadi
                console.error(error);
                alert('Terjadi kesalahan saat menyimpan perubahan.');
            });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
