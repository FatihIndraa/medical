<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\RekamMedis;
use App\Models\Tindakan;
use App\Models\User;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    public function viewTindakan(Request $request)
    {
        // Ambil semua data pasien
        $users = User::all();
        
        // Ambil semua data dokter
        $dokters = Dokter::all();

        $rekam = RekamMedis::all();
        
        // Ambil semua data tindakan
        $tindakans = Tindakan::all();
        
        // Tampilkan view dan teruskan data ke view
        return view('dashboard.tindakan', [
            'title' => 'Tambah Rekam Medis',
            'active' => 'rekam medis',
            'users' => $users,
            'dokters' => $dokters,
            'tindakans' => $tindakans // Teruskan data tindakan ke view
        ]);
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari permintaan
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'tindakan' => 'required|string|max:255',
        ]);

        // Periksa apakah rekam medis tersebut sudah memiliki tindakan
        $existingTindakan = Tindakan::where('rekam_medis_id', $request->rekam_medis_id)->first();

        // Jika sudah ada tindakan untuk rekam medis tersebut, kembalikan pesan kesalahan
        if ($existingTindakan) {
            return response()->json(['message' => 'Rekam medis ini sudah memiliki tindakan.'], 422);
        }

        // Simpan tindakan ke dalam database
        Tindakan::create([
            'rekam_medis_id' => $request->rekam_medis_id,
            'tindakan' => $request->tindakan,
        ]);

        // Berikan respons sukses
        return response()->json(['message' => 'Tindakan berhasil ditambahkan.']);
    }
    public function edit($id)
    {
        // Temukan data tindakan berdasarkan ID
        $tindakan = Tindakan::findOrFail($id);

        // Tampilkan view edit tindakan dan teruskan data tindakan
        return view('edit-tindakan', compact('tindakan'));
    }

    public function checkTindakan($rekam_medis_id)
    {
        // Periksa apakah ada tindakan yang terkait dengan rekam medis ini
        $hasTindakan = Tindakan::where('rekam_medis_id', $rekam_medis_id)->exists();

        // Kembalikan respons dalam bentuk JSON
        return response()->json(['hasTindakan' => $hasTindakan]);
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari permintaan
        $request->validate([
            'tindakan' => 'required|string|max:255',
        ]);

        $tindakan = Tindakan::findOrFail($id);

        $tindakan->tindakan = $request->input('tindakan');
        $tindakan->save();
        // Redirect atau kembalikan respons yang sesuai
        return redirect('/dashboard/tindakan')->with('success', 'Tindakan berhasil diperbarui.');
    }
}

// <?php

// namespace App\Http\Controllers;

// use App\Models\Dokter;
// use App\Models\RekamMedis;
// use App\Models\User;
// use App\Models\Tindakan; // Import model Tindakan
// use Illuminate\Http\Request;

// class TindakanController extends Controller
// {
    

    

// }
