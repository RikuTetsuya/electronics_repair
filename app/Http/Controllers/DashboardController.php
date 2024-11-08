<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function dashboard() {
        $data['header_title'] = 'Dashboard'; 

        if(Auth::user()->user_type == 1) // Admin
        {
            // Mengambil jumlah customer
            $jumlahCustomer = DB::table('master_customers')->count();

            // Mengambil jumlah service in
            $jumlahServiceIn = DB::table('service_ins')->count();

            // Mengambil jumlah service out
            $jumlahServiceOut = DB::table('service_outs')->count();

            // Mengambil jumlah akun customer
            $jumlahAkunCustomer = DB::table('users')->where('user_type', 2)->count();

            // Mengambil jumlah akun admin
            $jumlahAkunAdmin = DB::table('users')->where('user_type', 1)->count();

            // Mengambil jumlah layanan
            $jumlahLayanan = DB::table('master_layanans')->count();

            $report = DB::table('service_ins')
                ->join('master_customers', 'service_ins.customer_id', '=', 'master_customers.id')
                ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
                ->leftJoin('service_outs', 'service_ins.id', '=', 'service_outs.service_in_id')
                ->select(
                    'service_ins.id', 
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
                    DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya')
                )
                ->orderBy('service_ins.tanggal_masuk', 'desc') // Mengurutkan berdasarkan tanggal masuk terbaru
                ->get();

            return view('admin.dashboard', compact(
                'jumlahCustomer', 
                'jumlahServiceIn', 
                'jumlahServiceOut', 
                'jumlahAkunCustomer', 
                'jumlahAkunAdmin', 
                'jumlahLayanan',
                'report',
            ));
        }
        else if(Auth::user()->user_type == 2) // Customer
        {
            return view('customer.dashboard', $data);
        }
    }
}
