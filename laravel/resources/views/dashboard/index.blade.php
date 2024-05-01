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
                            <th scope="col">#</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekamMedis as $rekam)
                            <tr>
                                <td>{{ $rekam->id }}</td>
                                <td>{{ $rekam->user->name }}</td>
                                <td>{{ $rekam->dokter->name }}</td>
                                <td>{{ $rekam->keluhan }}</td>
                                <td>Actions</td> <!-- Tambahkan tombol action sesuai kebutuhan -->
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
