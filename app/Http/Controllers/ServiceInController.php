<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ServiceInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data Service In dengan relasi ke users, master_layanans, service_outs, dan master_mitras
        $reportins = DB::table('service_ins')
            ->join('users', 'service_ins.user_id', '=', 'users.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->leftJoin('service_outs', 'service_ins.id', '=', 'service_outs.service_in_id') // Join ke service_outs
            ->leftJoin('master_mitras', 'service_outs.mitra_id', '=', 'master_mitras.id') // Join ke master_mitras
            ->select(
                'service_ins.order_id',
                'users.name',
                'users.email',
                'users.telepon',
                'users.alamat',
                'master_layanans.nama_layanan',
                'master_mitras.nama_mitra', // Kolom dari master_mitras
                'service_ins.id',
                'service_ins.tanggal_masuk',
                'service_ins.deskripsi_masalah',
                'service_ins.status', 
                'service_ins.status_payment',
                'service_ins.tanggal_estimasi',
                'service_ins.perbaikan_pihak_ketiga',
                'service_ins.harga',
                'service_ins.catatan',
                'service_outs.tanggal_keluar',
                'service_outs.tanggal_diterima',
                'service_outs.biaya',
                'service_outs.catatan as catatan_service_out',
                'service_outs.status as status_service_out',
                DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya') // Hitung total biaya
            )
            ->orderBy('service_ins.tanggal_masuk', 'desc') // Urutkan berdasarkan tanggal masuk terbaru
            // ->get();
            ->paginate(5); // Tambahkan pagination, 5 data per halaman

        // Return ke view dengan data
        return view('admin.reportins.index', compact('reportins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        // $reportins = DB::table('service_ins')
        //     ->join('users', 'service_ins.user_id', '=', 'users.id')
        //     ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
        //     ->leftJoin('service_outs', 'service_ins.id', '=', 'service_outs.service_in_id') // Tambahkan join ke service_outs
        //     ->select(
        //         'service_ins.id',
        //         'service_ins.order_id',
        //         'users.name',
        //         'users.email',
        //         'users.telepon',
        //         'users.alamat',
        //         'master_layanans.nama_layanan',
        //         'service_ins.tanggal_masuk',
        //         'service_ins.deskripsi_masalah',
        //         'service_ins.status',
        //         'service_ins.tanggal_estimasi',
        //         'service_ins.perbaikan_pihak_ketiga',
        //         'service_ins.harga',
        //         'service_ins.catatan',
        //         'service_outs.tanggal_keluar',
        //         'service_outs.tanggal_diterima',
        //         'service_outs.biaya',
        //         'service_outs.catatan as catatan_service_out',
        //         DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya')
        //     )
        //     ->where('service_ins.id', $id)
        //     ->first();
        
        //     dd($reportins);
        // // Jika Anda memerlukan data untuk select options di form, pastikan Anda memanggilnya di sini
        // $services = DB::table('master_layanans')->get();
        // $customers = DB::table('users')->get();
        $reportins = DB::table('service_ins')
            ->join('users', 'service_ins.user_id', '=', 'users.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->leftJoin('service_outs', 'service_ins.id', '=', 'service_outs.service_in_id') // Join ke service_outs
            ->leftJoin('master_mitras', 'service_outs.mitra_id', '=', 'master_mitras.id') // Join ke master_mitras
            ->select(
                'service_ins.order_id',
                'service_ins.id',
                'users.name',
                'users.email',
                'users.telepon',
                'users.alamat',
                'master_layanans.nama_layanan',
                'master_mitras.nama_mitra', // Kolom dari master_mitras
                'service_ins.tanggal_masuk',
                'service_ins.deskripsi_masalah',
                'service_ins.status',
                'service_ins.status_payment',
                'service_ins.tanggal_estimasi',
                'service_ins.perbaikan_pihak_ketiga',
                'service_ins.harga',
                'service_ins.catatan',
                'service_outs.tanggal_keluar',
                'service_outs.tanggal_diterima',
                'service_outs.biaya',
                'service_outs.catatan as catatan_service_out',
                'service_outs.status as status_service_out',
                DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya') // Hitung total biaya
            )
            ->orderBy('service_ins.tanggal_masuk', 'desc') // Urutkan berdasarkan tanggal masuk terbaru
            ->first();
        // dd($reportins);

        return view('admin.reportins.edit', compact('reportins'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, string $id)
     {
         // Ambil tanggal masuk dari database
         $serviceIn = DB::table('service_ins')->where('id', $id)->first();
         if (!$serviceIn) {
             return redirect()->back()->withErrors(['error' => 'Data Service In tidak ditemukan untuk ID: ' . $id]);
         }
     
         $serviceOut = DB::table('service_outs')->where('service_in_id', $id)->first();
     
         // Validasi input tanpa validasi after_or_equal
         $request->validate([
             'status' => 'required|integer|in:0,1,2,3,4',
             'tanggal_estimasi' => 'required|date',
             'perbaikan_pihak_ketiga' => 'required|integer|in:0,1,2',
             'harga' => 'required|numeric',
         ]);
     
         // Gunakan Carbon untuk parsing dan memformat tanggal
         $tanggalMasuk = \Carbon\Carbon::parse($serviceIn->tanggal_masuk)->format('Y-m-d');
         $tanggalEstimasi = \Carbon\Carbon::parse($request->input('tanggal_estimasi'))->format('Y-m-d');
     
         // Lakukan pengecekan apakah tanggal estimasi lebih kecil dari tanggal masuk
         if ($tanggalEstimasi < $tanggalMasuk) {
             return redirect()->back()->withErrors(['tanggal_estimasi' => 'Tanggal estimasi tidak boleh kurang dari tanggal masuk']);
         }
     
         $harga = (float) $request->input('harga');
         $biaya = $serviceOut ? (float) $serviceOut->biaya : 0;
         $totalHarga = $harga + $biaya;
     
         // Lanjutkan update
         DB::table('service_ins')
             ->where('id', $id)
             ->update([
                 'status' => $request->input('status'),
                 'tanggal_estimasi' => $request->input('tanggal_estimasi'),
                 'perbaikan_pihak_ketiga' => $request->input('perbaikan_pihak_ketiga'),
                 'harga' => $request->input('harga'),
                 'catatan' => $request->input('catatan'),
                 'total_harga' => $totalHarga,
                 'status_payment' => $request->input('status_payment'),
                 'updated_at' => now(),
             ]);
     
         // Redirect ke halaman list dengan pesan sukses
         return redirect('admin/service_in/list')->with('success', 'Service In Updated');
     }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = DB::table('service_ins')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with('success', 'Service In Deleted');
        } else {
            return Redirect::back()->with('warning', 'Failed to delete Service In');
        }
    }
}
