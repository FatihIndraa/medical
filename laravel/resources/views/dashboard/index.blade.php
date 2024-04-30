@extends('dashboard.layout.template')
@section('konten')
    <div class="col py-3">
        <div class="bg-white container-sm col-6 border my-3 rounded px-5 py-3 pb-5">
            <h1>Halo!!</h1>
            <div class="mb-3">Selamat datang {{ Auth::user()->name }}</div>
            @auth('operators')
                <a href="/dashboard/rekam-medis" class="btn btn-primary mb-2">Tambah Rekam Medis</a>
            @endauth
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
