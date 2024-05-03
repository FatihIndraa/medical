@extends('dashboard.layout.template')

@section('konten')
    <div class="col py-3">
        <div class="bg-white container-sm col-6 border my-3 rounded px-5 py-3 pb-5">
            <h1>Halo!!</h1>
            @auth('operators')
                <div class="mb-3">Selamat datang {{ Auth::guard('operators')->user()->name }}</div>
            @endauth
            @auth('dokters')
                <div class="mb-3">Selamat datang {{ Auth::guard('dokters')->user()->name }}</div>
            @endauth
            @auth('web')
                <div class="mb-3">Selamat datang {{ Auth::guard('web')->user()->name }}</div>
            @endauth
            @auth('operators')
                <a href="/dashboard/tambah-rekam-medis" class="btn btn-primary mb-2">Tambah Rekam Medis</a>
            @endauth
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">Keluhan</th>
                            @if (auth()->guard('dokters')->check() || auth()->guard('operators')->check())
                                <th scope="col">Action</th>
                            @elseif (auth()->guard('web')->check())
                                <th scope="col">Lihat Tindakan</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($rekamMedis as $rekam)
                            @php
                                // Batasi keluhan menjadi maksimal 10 kata
                                $keluhan = $rekam->keluhan;
                                $wordCount = str_word_count($keluhan);

                                if ($wordCount > 10) {
                                    $keluhan = implode(' ', array_slice(str_word_count($keluhan, 1), 0, 10)) . '...';
                                }
                            @endphp

                            @if (auth()->guard('dokters')->check() && $rekam->dokter_id == auth()->guard('dokters')->user()->id)
                                <tr>
                                    <td>{{ $rekam->user->name }}</td>
                                    <td>{{ $rekam->dokter->name }}</td>
                                    <td>{{ $keluhan }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm"
                                            onclick="showPatientDetails('{{ $rekam->user->name }}', '{{ $rekam->user->gender }}', '{{ $rekam->user->alamat }}', '{{ $rekam->dokter->name }}', '{{ $rekam->keluhan }}')">
                                            <i class="bi bi-eye"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                            @elseif (auth()->guard('operators')->check())
                                <tr>
                                    <td>{{ $rekam->user->name }}</td>
                                    <td>{{ $rekam->dokter->name }}</td>
                                    <td>{{ $keluhan }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm"
                                            onclick="showPatientDetails('{{ $rekam->user->name }}', '{{ $rekam->user->gender }}', '{{ $rekam->user->alamat }}', '{{ $rekam->dokter->name }}', '{{ $rekam->keluhan }}')">
                                            <i class="bi bi-eye"></i> Lihat
                                        </button>
                                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i>
                                            Hapus</a>
                                    </td>
                                </tr>
                            @elseif (auth()->guard('web')->check() && $rekam->user_id == auth()->guard('web')->user()->id)
                                <tr>
                                    <td>{{ $rekam->user->name }}</td>
                                    <td>{{ $rekam->dokter->name }}</td>
                                    <td>{{ $keluhan }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm"
                                            onclick="showPatientDetails('{{ $rekam->user->name }}', '{{ $rekam->user->gender }}', '{{ $rekam->user->alamat }}', '{{ $rekam->dokter->name }}', '{{ $rekam->keluhan }}')">
                                            <i class="bi bi-eye"></i> Lihat
                                        </button>
                                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i>
                                            Hapus</a>
                                        <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i>
                                            Edit</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
                    <h5>Keluhan:</h5>
                    <p id="keluhanPasien"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan detail pasien
        function showPatientDetails(nama, jenisKelamin, alamat, namaDokter, keluhan) {
            document.getElementById("namaPasien").innerHTML = nama;
            document.getElementById("jenisKelaminPasien").innerHTML = jenisKelamin;
            document.getElementById("alamatPasien").innerHTML = alamat;
            document.getElementById("namaDokter").innerHTML = namaDokter;
            document.getElementById("keluhanPasien").innerHTML = keluhan;
            var myModal = new bootstrap.Modal(document.getElementById('patientDetailsModal'));
            myModal.show();
        }
    </script>
@endsection
