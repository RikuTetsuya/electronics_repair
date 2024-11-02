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
        
        $reportins = DB::table('service_ins')
            ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->leftJoin('service_outs', 'service_ins.id', '=', 'service_outs.service_in_id')
            ->select(
                'service_ins.id', 
                'service_ins.order_id', 
                'master_customers.nama_customer',
                'master_customers.email',
                'master_customers.telepon',
                'master_customers.alamat',
                'master_layanans.nama_layanan',
                'service_ins.tanggal_masuk',
                'service_ins.deskripsi_masalah',
                'service_ins.status',
                'service_ins.tanggal_estimasi',
                'service_ins.perbaikan_pihak_ketiga',
                'service_ins.harga',
                'service_ins.catatan',
                'service_outs.vendor_name',
                'service_outs.tanggal_keluar',
                'service_outs.tanggal_diterima',
                'service_outs.biaya',
                'service_outs.catatan as catatan_service_out',
                'master_layanans.nama_layanan',
                DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya')
            )
            ->orderBy('service_ins.tanggal_masuk', 'desc') // Mengurutkan berdasarkan tanggal masuk terbaru
            ->get();

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
        $reportins = DB::table('service_ins')
            ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->leftJoin('service_outs', 'service_ins.id', '=', 'service_outs.service_in_id') // Tambahkan join ke service_outs
            ->select(
                'service_ins.id', 
                'service_ins.order_id', 
                'master_customers.nama_customer',
                'master_customers.email',
                'master_customers.telepon',
                'master_customers.alamat',
                'master_layanans.nama_layanan',
                'service_ins.tanggal_masuk',
                'service_ins.deskripsi_masalah',
                'service_ins.status',
                'service_ins.tanggal_estimasi',
                'service_ins.perbaikan_pihak_ketiga',
                'service_ins.harga',
                'service_ins.catatan',
                'service_outs.vendor_name', // Kolom dari service_outs
                'service_outs.tanggal_keluar',
                'service_outs.tanggal_diterima',
                'service_outs.biaya',
                'service_outs.catatan as catatan_service_out',
                DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya')
            )
            ->where('service_ins.id', $id)
            ->first();
        
        // Jika Anda memerlukan data untuk select options di form, pastikan Anda memanggilnya di sini
        $services = DB::table('master_layanans')->get();
        $customers = DB::table('master_customers')->get();

        return view('admin.reportins.edit', compact('reportins', 'services', 'customers'));
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ambil tanggal masuk dari database
        $serviceIn = DB::table('service_ins')->where('id', $id)->first();
        $serviceOut = DB::table('service_outs')->where('service_in_id', $id)->first(); // Ambil data service_outs

        // Validasi input tanpa validasi after_or_equal, karena akan dilakukan pengecekan manual
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3,4',
            'tanggal_estimasi' => 'required|date', // Validasi tanggal tanpa after_or_equal
            'perbaikan_pihak_ketiga' => 'required|integer|in:0,1,2',
            'harga' => 'required|numeric',
        ]);

        // Gunakan Carbon untuk parsing dan memformat tanggal dengan format yang sama
        $tanggalMasuk = \Carbon\Carbon::parse($serviceIn->tanggal_masuk)->format('Y-m-d');
        $tanggalEstimasi = \Carbon\Carbon::parse($request->input('tanggal_estimasi'))->format('Y-m-d');

        // Lakukan pengecekan apakah tanggal estimasi lebih kecil dari tanggal masuk
        if ($tanggalEstimasi < $tanggalMasuk) {
            // Jika tanggal estimasi kurang dari tanggal masuk, redirect back dengan error
            return redirect()->back()->withErrors(['tanggal_estimasi' => 'Periksa Kembali! Tanggal estimasi tidak boleh kurang dari tanggal masuk']);
        }
        
        // Konversi harga dari string ke float untuk memastikan penjumlahan berjalan dengan benar
        $harga = (float) $request->input('harga');
        $biaya = $serviceOut ? (float) $serviceOut->biaya : 0;

        // Hitung total harga
        $totalHarga = $harga + $biaya;

        // Jika tanggal estimasi >= tanggal masuk (termasuk sama), lanjutkan update
        DB::table('service_ins')
            ->where('id', $id)
            ->update([
                'status' => $request->input('status'),
                'tanggal_estimasi' => $request->input('tanggal_estimasi'),
                'perbaikan_pihak_ketiga' => $request->input('perbaikan_pihak_ketiga'),
                'harga' => $request->input('harga'), 
                'catatan' => $request->input('catatan'), 
                'total_harga' => $totalHarga, // Update kolom total_harga
                'updated_at' => now(), // Update timestamp
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
