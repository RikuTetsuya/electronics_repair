<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mitra = DB::table('master_mitras')->get();
        return view('admin.mitra.index', compact('mitra'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mitra.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama_mitra' => $request->nama_mitra,
            'alamat' => $request->alamat,
            // 'status' => $request->status,
        ];

        $simpan = DB::table('master_mitras')->insert($data);
        if ($simpan) {
            return redirect('admin/mitra/list')->with(['success' => 'Mitra Berhasil Disimpan']);
        } else {
            return redirect('admin/mitra/list')->with(['warning' => 'Mitra Gagal Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mitra = DB::table('master_mitras')->where('id', $id)->first();
        return view('admin.mitra.edit', compact('mitra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input (opsional, tapi disarankan)
        $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);
    
        $data = [
            'nama_mitra' => $request->nama_mitra,
            'alamat' => $request->alamat,
        ];
    
        // Pastikan update hanya terjadi pada data dengan ID yang sesuai
        $simpan = DB::table('master_mitras')->where('id', $id)->update($data);
    
        if ($simpan) {
            return redirect('admin/mitra/list')->with(['success' => 'Mitra Berhasil Diubah']);
        } else {
            return redirect('admin/mitra/list')->with(['warning' => 'Tidak ada perubahan data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = DB::table('master_mitras')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with('success', 'Mitra Dihapus');
        } else {
            return Redirect::back()->with('warning', 'Mitra Gagal Dihapus');
        }
    }
}
