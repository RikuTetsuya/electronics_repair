<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request) {
        $request->request->add(['total_harga' => $request->total_harga * 1, 'status' => "Unpaid"]);
        // $order = Order::create($request->all());

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
                'service_ins.total_harga',
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

            $firstReportin = $reportins->first();
    
            // Cek jika order_id sudah ada
            if (empty($firstReportin->order_id)) {
                // Jika order_id belum ada, buat yang baru
                $newOrderId = 'ORDER-' . strtoupper(uniqid());
                // Simpan order_id ke dalam database
                DB::table('service_ins')
                    ->where('id', $firstReportin->id)
                    ->update(['order_id' => $newOrderId]);
            } else {
                // Gunakan order_id yang sudah ada
                $newOrderId = $firstReportin->order_id;
            }
        
        $grossAmount = (float) $firstReportin->total_harga;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $firstReportin->order_id,
                'gross_amount' => $grossAmount
            ),
            'customer_details' => array(
                'name' => $request->nama_customer,
                'email' => $request->email,
                'phone' => $request->telepon,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('customer.input.checkout', compact('snapToken', 'reportins', 'firstReportin'));
    }

    public function callback(Request $request) {
        $serverKey = config('midtrans.server_key'); // Pastikan server key yang sama dengan di Midtrans
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        
        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update(['status_payment' => 'Paid']);
            }
        }
    }
}
