<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ServiceOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reportouts = DB::table('service_outs')
            ->join('service_ins', 'service_outs.service_in_id', '=', 'service_ins.id')
            ->join('master_mitras', 'service_outs.mitra_id', '=', 'master_mitras.id')
            ->join('users', 'service_ins.user_id', '=', 'users.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->select(
                'service_outs.id',
                'users.name',
                'users.email',
                'users.telepon',
                'users.alamat',
                'master_layanans.nama_layanan',
                'master_mitras.nama_mitra',
                'service_ins.tanggal_masuk',
                'service_ins.deskripsi_masalah',
                'service_ins.status',
                'service_ins.tanggal_estimasi',
                'service_ins.perbaikan_pihak_ketiga',
                'service_ins.harga',
                'service_ins.catatan',
                // 'service_outs.vendor_name',
                'service_outs.tanggal_keluar',
                'service_outs.tanggal_diterima',
                'service_outs.biaya',
                'service_outs.catatan as catatan_service_out',
                'service_outs.status as status_service_out',
                'master_layanans.nama_layanan',
                DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya')
            )
            ->where('service_ins.perbaikan_pihak_ketiga', 1)
            ->orderBy('service_outs.tanggal_keluar', 'desc') // Mengurutkan berdasarkan tanggal masuk terbaru
            // ->get();
            ->paginate(5); // Tambahkan pagination, 5 data per halaman

        return view('admin.reportouts.index', compact('reportouts'));
    }

    public function show(string $id)
    {
        $serviceOut = DB::table('service_outs')
            ->join('service_ins', 'service_outs.service_in_id', '=', 'service_ins.id')
            ->select(
                'service_outs.id',
                'service_ins.deskripsi_masalah',
                'service_outs.vendor_name',
                'service_outs.tanggal_keluar',
                'service_outs.tanggal_diterima',
                'service_outs.biaya',
                'service_outs.catatan',
                'service_outs.status'
            )
            ->where('service_outs.id', $id) // Tambahkan baris ini untuk memfilter berdasarkan ID
            ->first();

        // Mengembalikan data dalam format JSON
        return response()->json($serviceOut);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua service_in_id yang sudah digunakan di tabel service_outs
        $usedServiceInIds = DB::table('service_outs')->pluck('service_in_id')->toArray();
        // Ambil data mitra dari tabel master_mitras
        $mitras = DB::table('master_mitras')
            ->select('id as mitra_id', 'nama_mitra', 'alamat') // Ambil ID, nama mitra, dan alamat
            ->get();
        // Ambil service_ins yang perbaikan_pihak_ketiga = 1 dan status = 3, tetapi tidak ada di service_outs
        $reportouts = DB::table('service_ins')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id') // Join ke tabel master_layanans
            ->select('service_ins.id', 'service_ins.deskripsi_masalah', 'master_layanans.nama_layanan') // Pilih deskripsi masalah dan nama layanan
            ->where('service_ins.perbaikan_pihak_ketiga', 1)
            ->where('service_ins.status', 3)
            ->whereNotIn('service_ins.id', $usedServiceInIds) // Abaikan yang sudah digunakan
            ->get();

        return view('admin.reportouts.add', compact('reportouts', 'mitras', 'usedServiceInIds'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'service_in_id' => 'required|integer|exists:service_ins,id',
            'mitra_id' => 'required',
            'tanggal_diterima' => 'nullable|date',

            'catatan' => 'nullable|string',
            'status' => 'required|integer|in:0,1,2',
            'biaya' => [
                'required',
                'numeric',
                'min:0',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
        ], [
            'biaya.required' => 'Biaya harus diisi.',
            'biaya.numeric' => 'Biaya harus berupa angka.',
            'biaya.min' => 'Biaya tidak boleh kurang dari 0.',
            'biaya.regex' => 'Format biaya tidak valid. Maksimal dua angka di belakang koma.',
        ]);

        // Ambil data service_in yang terkait
        $serviceIn = DB::table('service_ins')->where('id', $request->input('service_in_id'))->first();
        if (!$serviceIn) {
            return redirect()->back()->withErrors(['error' => 'Data Service In tidak ditemukan']);
        }

        // Ambil tanggal_diterima dari input user
        $tanggalDiterima = $request->input('tanggal_diterima') ? \Carbon\Carbon::parse($request->input('tanggal_diterima')) : null;

        // Insert data baru ke service_outs
        DB::table('service_outs')->insert([
            'service_in_id' => $request->input('service_in_id'),
            'mitra_id' => $request->mitra_id,
            'tanggal_keluar' => now(),
            'tanggal_diterima' => $request->input('tanggal_diterima'),
            'biaya' => $request->input('biaya'),
            'catatan' => $request->input('catatan'),
            'status' => $request->input('status'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Hitung total_harga baru
        $harga = (float) $serviceIn->harga;
        $biaya = (float) $request->input('biaya');
        $totalHarga = $harga + $biaya;

        // Update total_harga di service_ins
        DB::table('service_ins')
            ->where('id', $request->input('service_in_id'))
            ->update([
                'total_harga' => $totalHarga,
                // 'updated_at' => now(),
            ]);

        // Redirect dengan pesan sukses
        return redirect('admin/service_out/list')->with('success', 'Service Out successfully added.');
    }


    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reportout = DB::table('service_outs')
            ->join('service_ins', 'service_outs.service_in_id', '=', 'service_ins.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->leftJoin('master_mitras', 'service_outs.mitra_id', '=', 'master_mitras.id')
            ->select(
                'service_outs.*',
                'service_ins.deskripsi_masalah',
                'master_layanans.nama_layanan',
                'master_mitras.nama_mitra'
            )
            ->where('service_outs.id', $id)
            ->first();

        if (!$reportout) {
            return redirect()->back()->withErrors(['error' => 'Data Service Out tidak ditemukan']);
        }

        $mitras = DB::table('master_mitras')
            ->select('id as mitra_id', 'nama_mitra', 'alamat')
            ->get();

        return view('admin.reportouts.edit', compact('reportout', 'mitras'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'mitra_id' => 'required',
            'tanggal_diterima' => 'nullable|date',
            
            'catatan' => 'nullable|string',
            'status' => 'required|integer|in:0,1,2',
            'biaya' => [
                'required',
                'numeric',
                'min:0',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
        ], [
            'biaya.required' => 'Biaya harus diisi.',
            'biaya.numeric' => 'Biaya harus berupa angka.',
            'biaya.min' => 'Biaya tidak boleh kurang dari 0.',
            'biaya.regex' => 'Format biaya tidak valid. Maksimal dua angka di belakang koma.',
        ]);
        
        $serviceOut = DB::table('service_outs')->where('id', $id)->first();
        if (!$serviceOut) {
            return redirect()->back()->withErrors(['error' => 'Data Service Out tidak ditemukan']);
        }

        $serviceIn = DB::table('service_ins')->where('id', $serviceOut->service_in_id)->first();
        if (!$serviceIn) {
            return redirect()->back()->withErrors(['error' => 'Data Service In tidak ditemukan']);
        }

        $tanggalDiterima = $request->input('tanggal_diterima') ? \Carbon\Carbon::parse($request->input('tanggal_diterima')) : null;

        if ($tanggalDiterima && $tanggalDiterima->lt($serviceOut->tanggal_keluar)) {
            return redirect()->back()->withErrors(['tanggal_diterima' => 'Tanggal diterima tidak boleh lebih kecil dari tanggal keluar']);
        }

        DB::table('service_outs')
            ->where('id', $id)
            ->update([
                'mitra_id' => $request->mitra_id,
                'tanggal_diterima' => $request->input('tanggal_diterima'),
                'biaya' => $request->input('biaya'),
                'catatan' => $request->input('catatan'),
                'status' => $request->input('status'),
                // 'updated_at' => now(),
            ]);

        $totalHarga = (float) $serviceIn->harga + (float) $request->input('biaya');

        DB::table('service_ins')
            ->where('id', $serviceOut->service_in_id)
            ->update([
                'total_harga' => $totalHarga,
                'updated_at' => now(),
            ]);

        return redirect('admin/service_out/list')
            ->with('success', 'Service Out updated successfully.');
    }


    // public function update(Request $request, string $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'vendor_name' => 'string',
    //         'tanggal_diterima' => 'nullable|date',
    //         'biaya' => 'nullable|string',
    //         'status' => 'required|integer|in:0,1,2',
    //     ]);

    //     // Ambil tanggal_keluar dari database untuk perbandingan
    //     $serviceOut = DB::table('service_outs')->where('id', $id)->first();
    //     $tanggalKeluar = $serviceOut->tanggal_keluar;

    //     // Ambil tanggal_diterima dari input user
    //     $tanggalDiterima = $request->input('tanggal_diterima');

    //     // Jika tanggal diterima diisi, lakukan pengecekan dengan tanggal keluar
    //     if ($tanggalDiterima && strtotime($tanggalDiterima) < strtotime($tanggalKeluar)) {
    //         // Jika tanggal diterima kurang dari tanggal keluar, redirect back dengan error
    //         return redirect()->back()->withErrors(['tanggal_diterima' => 'Tanggal diterima tidak boleh kurang dari tanggal keluar']);
    //     }

    //     // Update data di database menggunakan Query Builder
    //     DB::table('service_outs')
    //         ->where('id', $id)
    //         ->update([
    //             'vendor_name' => $request->input('vendor_name'),
    //             'tanggal_diterima' => $tanggalDiterima, // Update jika valid
    //             'biaya' => $request->input('biaya'),
    //             'catatan' => $request->input('catatan'),
    //             'status' => $request->input('status'),
    //             'updated_at' => now(), // Update timestamp
    //         ]);

    //     // Redirect ke halaman list dengan pesan sukses
    //     return redirect('admin/service_out/list')
    //         ->with('success', 'Service status and estimated date updated successfully.');
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = DB::table('service_outs')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with('success', 'Service Out Deleted');
        } else {
            return Redirect::back()->with('warning', 'Failed to delete Service Out');
        }
    }
}
