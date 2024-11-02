<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CustomerInputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id; // Ambil ID pengguna yang sedang login
        
        // Menghitung total order
        $totalOrders = DB::table('service_ins')
            ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
            ->where('master_customers.user_id', $userId)
            ->count();

        $totalWaiting = DB::table('service_ins')
            ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
            ->where('master_customers.user_id', $userId)
            ->where('service_ins.status', 0) // Misalkan 0 adalah status "waiting"
            ->count();

        $totalRejected = DB::table('service_ins')
            ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
            ->where('master_customers.user_id', $userId)
            ->where('service_ins.status', 1) // Misalkan 1 adalah status "rejected"
            ->count();

        $totalAccepted = DB::table('service_ins')
            ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
            ->where('master_customers.user_id', $userId)
            ->where('service_ins.status', 2) // Misalkan 2 adalah status "accepted"
            ->count();

        $totalOnProcess = DB::table('service_ins')
            ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
            ->where('master_customers.user_id', $userId)
            ->where('service_ins.status', 3) // Misalkan 3 adalah status "on process"
            ->count();

        $totalFinished = DB::table('service_ins')
            ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
            ->where('master_customers.user_id', $userId)
            ->where('service_ins.status', 4) // Misalkan 4 adalah status "finished"
            ->count();
        
        
        // Ambil data customer dan service_ins seperti sebelumnya
        $customer = DB::table('service_ins')
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
                'service_ins.status_payment',
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
            ->where('master_customers.user_id', $userId) // Filter berdasarkan user_id
            ->orderBy('service_ins.tanggal_masuk', 'desc') // Mengurutkan berdasarkan tanggal masuk terbaru
            ->get();
        
        return view('customer.input.index', compact('customer', 'totalOrders', 'totalWaiting', 'totalRejected', 'totalAccepted', 'totalOnProcess', 'totalFinished'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $layanans = DB::table('master_layanans')->where('status', '!=', 0)->get(); // Ambil data layanan yang tidak berstatus 2

        return view('customer.input.add', compact('user', 'layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'telepon' => 'required',
            'alamat' => 'required',
            'layanan_id' => 'required',
            'deskripsi_masalah' => 'required',
        ]);

        // Simpan data customer
        DB::table('master_customers')->insert([
            'user_id' => Auth::user()->id,
            'nama_customer' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        // Buat ID unik dengan format ORDER-(huruf dan angka random)
        $uniqueId = 'ORDER-' . Str::random(8);

        // Simpan data service_in
        DB::table('service_ins')->insert([
            'customer_id' => DB::getPdo()->lastInsertId(),
            'layanan_id' => $request->layanan_id,
            'deskripsi_masalah' => $request->deskripsi_masalah,
            'status' => 0,  // Set status default
            'tanggal_masuk' => now(),
            'order_id' => 'ORDER-' . strtoupper(Str::random(8)),
        ]);        

        return redirect('customer/')->with('success', 'Order added');
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
    public function edit($id)
{
    $user = Auth::user();
    // Ambil data service_ins berdasarkan ID
    $order = DB::table('service_ins')
        ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
        ->where('service_ins.id', $id)
        ->select(
            'service_ins.id',
            'service_ins.layanan_id',
            'service_ins.deskripsi_masalah',
            'master_customers.nama_customer',
            'master_customers.telepon',
            'master_customers.email'
        )
        ->first();

    $layanans = DB::table('master_layanans')->where('status', '!=', 0)->get(); // Ambil data layanan yang tidak berstatus 2

    return view('customer.input.edit', compact('user', 'order', 'layanans'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'layanan_id' => 'required',
        'deskripsi_masalah' => 'required',
    ]);

    // Update data service_ins
    DB::table('service_ins')
        ->where('id', $id)
        ->update([
            'layanan_id' => $request->layanan_id,
            'deskripsi_masalah' => $request->deskripsi_masalah,
            
        ]);

    return redirect('customer/')->with('success', 'Order updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = DB::table('service_ins')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with('success', 'Order deleted');
        } else {
            return Redirect::back()->with('warning', 'Failed to delete order');
        }
    }
}
