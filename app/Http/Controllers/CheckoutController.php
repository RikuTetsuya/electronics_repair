<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {

        $request->request->add(['total_harga' => $request->total_harga * 1, 'status' => "Unpaid"]);
        // $order = Order::create($request->all());
        // $orderId = $request->order_id; // Ambil order_id yang dipilih dari request

        $reportins = DB::table('service_ins')
            ->join('users', 'service_ins.user_id', '=', 'users.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->leftJoin('service_outs', 'service_ins.id', '=', 'service_outs.service_in_id')
            ->leftJoin('master_mitras', 'service_outs.mitra_id', '=', 'master_mitras.id') // Join ke master_mitras
            ->select(
                'service_ins.id',
                'service_ins.order_id',
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
                'service_ins.total_harga',
                'service_ins.catatan',
                // 'service_outs.vendor_name',
                'service_outs.tanggal_keluar',
                'service_outs.tanggal_diterima',
                'service_outs.biaya',
                'service_outs.catatan as catatan_service_out',
                'master_layanans.nama_layanan',
                DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya')
            )
            // ->orderBy('service_ins.tanggal_masuk', 'desc') // Mengurutkan berdasarkan tanggal masuk terbaru
            // ->where('service_ins.order_id', $orderId) // Hanya ambil data berdasarkan order_id yang dipilih
            ->orderBy('service_ins.tanggal_masuk', 'asc') // Urutkan berdasarkan tanggal masuk terbaru        
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
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->telepon,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('customer.order.checkout', compact('snapToken', 'reportins', 'firstReportin'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key'); // Pastikan server key yang sama dengan di Midtrans
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                // $order = Order::find($request->order_id);
                // $order->update(['status_payment' => 'Paid']);
                DB::table('service_ins')
                    ->where('order_id', $request->order_id)
                    ->update(['status_payment' => 'Paid',
                                       'updated_at' => now(),
                ]);
            }
        }
    }

    public function invoice(Request $request, $id)
    {
        // Ambil data tunggal berdasarkan ID
        $invoice = DB::table('service_ins')
            ->join('users', 'service_ins.user_id', '=', 'users.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->leftJoin('service_outs', 'service_ins.id', '=', 'service_outs.service_in_id')
            ->leftJoin('master_mitras', 'service_outs.mitra_id', '=', 'master_mitras.id')
            ->select(
                'service_ins.id',
                'service_ins.order_id',
                'users.name',
                'users.email',
                'users.telepon',
                'users.alamat',
                'master_layanans.nama_layanan',
                'master_mitras.nama_mitra',
                'master_mitras.alamat as alamat_mitra',
                'service_ins.tanggal_masuk',
                'service_ins.deskripsi_masalah',
                'service_ins.status',
                'service_ins.status_payment',
                'service_ins.tanggal_estimasi',
                'service_ins.perbaikan_pihak_ketiga',
                'service_ins.harga',
                'service_ins.total_harga',
                'service_ins.catatan',
                'service_outs.tanggal_keluar',
                'service_outs.tanggal_diterima',
                'service_outs.biaya',
                'service_outs.catatan as catatan_service_out',
                DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya')
            )
            ->where('service_ins.id', $id) // Ambil data berdasarkan ID
            ->first();

        if (!$invoice) {
            return redirect()->back()->with('error', 'Invoice not found.');
        }

        if ($request->query('output') == 'pdf') {
            $pdf = Pdf::loadView('customer.order.invoice', compact('invoice'));
            return $pdf->download('invoice-' . $invoice->order_id . '.pdf');
        }

        return view('customer.order.invoice', compact('invoice'));
    }

    public function details(Request $request, $id)
    {
        $reportins = DB::table('service_ins')
            ->join('users', 'service_ins.user_id', '=', 'users.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->leftJoin('service_outs', 'service_ins.id', '=', 'service_outs.service_in_id')
            ->leftJoin('master_mitras', 'service_outs.mitra_id', '=', 'master_mitras.id')
            ->select(
                'service_ins.id',
                'service_ins.order_id',
                'users.name',
                'users.email',
                'users.telepon',
                'users.alamat',
                'master_layanans.nama_layanan',
                'master_mitras.nama_mitra',
                'service_ins.tanggal_masuk',
                'service_ins.deskripsi_masalah',
                'service_ins.status',
                'service_ins.status_payment',
                'service_ins.tanggal_estimasi',
                'service_ins.perbaikan_pihak_ketiga',
                'service_ins.harga',
                'service_ins.total_harga',
                'service_ins.catatan',
                'service_ins.rating',
                'service_ins.feedback',
                'service_outs.tanggal_keluar',
                'service_outs.tanggal_diterima',
                'service_outs.biaya',
                'service_outs.catatan as catatan_service_out',
                'master_layanans.nama_layanan',
                DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya')
            )
            ->where('service_ins.order_id', $id) // Tambahkan filter berdasarkan order_id dari URL
            ->first();

        if (!$reportins) {
            // Jika tidak ditemukan data, tampilkan halaman 404 atau pesan error
            abort(404, 'Order not found');
        }

        return view('customer.order.detail', compact('reportins'));
    }

    public function storeRatingOrder(Request $request, $id)
    {
        // Validasi input
    $request->validate([
        'ratingValue' => 'required|integer|min:1|max:5',
        'reviewText' => 'required|string|max:255',
    ]);

    // Cek apakah data service_ins ada
    $serviceIn = DB::table('service_ins')->where('id', $id)->first();

    if (!$serviceIn) {
        return redirect()->back()->with('error', 'Order not found.');
    }

    // Update rating dan feedback
    DB::table('service_ins')
        ->where('id', $id)
        ->update([
            'rating' => $request->ratingValue,
            'feedback' => $request->reviewText,
            // 'updated_at' => now(),
        ]);

    return redirect()->back()->with('success', 'Your Review Added Successfully!');
    }

}
