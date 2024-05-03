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
                                    <td>Actions for Doctor</td>
                                </tr>
                            @elseif (auth()->guard('operators')->check())
                                <tr>
                                    <td>{{ $rekam->user->name }}</td>
                                    <td>{{ $rekam->dokter->name }}</td>
                                    <td>{{ $keluhan }}</td>
                                    <td>Actions for Operator</td>
                                </tr>
                            @elseif (auth()->guard('web')->check() && $rekam->user_id == auth()->guard('web')->user()->id)
                                <tr>
                                    <td>{{ $rekam->user->name }}</td>
                                    <td>{{ $rekam->dokter->name }}</td>
                                    <td>{{ $keluhan }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
