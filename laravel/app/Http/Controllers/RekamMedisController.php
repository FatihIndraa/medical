<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pengguna
        $users = User::all();
        
        // Ambil semua data dokter
        $dokters = Dokter::all();
        

        // Tampilkan view dan teruskan data ke view
        return view('dashboard.tambah-rekam-medis', [
            'title' => 'Tambah Rekam Medis',
            'active' => 'rekam medis',
            'users' => $users, // Teruskan data pengguna ke view
            'dokters' => $dokters // Teruskan data dokter ke view
        ]);
    
    }
    public function showRekamMedis()
    {
        // Ambil semua data rekam medis
        $rekamMedis = RekamMedis::all();

        // Ambil semua data dokter
        $dokters = Dokter::all();

        // Tampilkan view dan teruskan data ke view
        return view('dashboard.index', [
            'title' => 'Data Rekam Medis',
            'active' => 'rekam medis',
            'rekamMedis' => $rekamMedis, // Teruskan data rekam medis ke view
            'dokters' => $dokters // Teruskan data dokter ke view
        ]);
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'user_id' => 'required',
            'dokter' => 'required',
            'keluhan' => 'required',
        ]);

        // Buat rekam medis baru berdasarkan data yang diterima
        $rekamMedis = new RekamMedis();
        $rekamMedis->user_id = $validatedData['user_id'];
        $rekamMedis->dokter_id = $validatedData['dokter'];
        $rekamMedis->keluhan = $validatedData['keluhan'];
        $rekamMedis->save();

        // Redirect ke halaman tertentu setelah berhasil menyimpan rekam medis
        return redirect('/dashboard')->with('success', 'Rekam Medis berhasil ditambahkan');
    }
    public function edit($id)
    {
        // Temukan rekam medis berdasarkan ID yang diberikan
        $rekamMedis = RekamMedis::findOrFail($id);
        
        // Ambil semua data dokter
        $dokters = Dokter::all();
        
        // Tampilkan view dan teruskan data ke view
        return view('dashboard.edit-rekam-medis', [
            'title' => 'Edit Rekam Medis',
            'active' => 'rekam medis',
            'rekamMedis' => $rekamMedis, // Teruskan data rekam medis ke view
            'dokters' => $dokters // Teruskan data dokter ke view
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'dokter' => 'required',
            'telp' => 'required',
            'keluhan' => 'required',
        ]);

        // Temukan rekam medis berdasarkan ID yang diberikan
        $rekamMedis = RekamMedis::findOrFail($id);

        // Update data rekam medis dengan data yang diterima dari request
        $rekamMedis->user_id = auth()->user()->id; // Set user_id berdasarkan pengguna yang sedang masuk
        $rekamMedis->dokter_id = $validatedData['dokter']; // Tetapkan dokter_id yang diterima dari request
        $rekamMedis->telp = $validatedData['telp'];
        $rekamMedis->keluhan = $validatedData['keluhan'];
        $rekamMedis->save();

        // Redirect ke halaman tertentu setelah berhasil menyimpan perubahan rekam medis
        return response()->json(['message' => 'Rekam Medis berhasil diperbarui'], 200);
    }

    public function destroy($id)
    {
        try {
            // Temukan rekam medis berdasarkan ID yang diberikan
            $rekamMedis = RekamMedis::findOrFail($id);
            
            // Hapus rekam medis
            $rekamMedis->delete();

            // Jika berhasil, kembalikan respons dengan pesan sukses
            return response()->json(['message' => 'Rekam Medis berhasil dihapus'], 200);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus rekam medis'], 500);
        }
    }

}
