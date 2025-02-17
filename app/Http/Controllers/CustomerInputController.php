<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class CustomerInputController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function main()
    {
        $user = Auth::user();  // Dapatkan data pengguna yang sedang login

        // Pagination untuk layanans
        $layanans = DB::table('master_layanans')
            ->select('nama_layanan')
            ->where('status', 1)
            ->paginate(8);
        
        $faqs = DB::table('master_faqs')
            ->select('question', 'answer')
            ->get();

        // Tetap gunakan query untuk ratings
        $ratings = DB::table('master_ratings')
            ->join('users', 'master_ratings.user_id', '=', 'users.id')
            ->select('master_ratings.*', 'users.name as user_name', 'users.image as image')
            ->get();

        return view('customer.main', compact('ratings', 'layanans', 'user', 'faqs'));
    }

    public function storeRating(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'ratingValue' => 'required|integer|min:1|max:5',
                'reviewText' => 'required|string|max:255',
            ]);

            $userId = Auth::user()->id; // Ambil ID pengguna
            $existingRating = DB::table('master_ratings')->where('user_id', $userId)->first();

            if ($existingRating) {
                // Jika sudah ada, update rating dan ulasan
                DB::table('master_ratings')
                    ->where('user_id', $userId)
                    ->update([
                        'rating' => $request->ratingValue,
                        'description' => $request->reviewText,
                        'updated_at' => now(),
                    ]);
                return redirect('customer/main/#testimonials')->with('success', 'Rating dan ulasan berhasil diperbarui!');
            } else {
                // Jika belum ada, simpan rating dan ulasan baru
                DB::table('master_ratings')->insert([
                    'user_id' => $userId,
                    'rating' => $request->ratingValue,
                    'description' => $request->reviewText,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                return redirect('customer/main/#testimonials')->with('success', 'Rating dan ulasan berhasil ditambahkan!');
            }
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan untuk debugging
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function accInfo()
    {
        $user = Auth::user();  // Dapatkan data pengguna yang sedang login
        return view('customer.profile.index', compact('user'));
    }

    // public function updateProfilePic(Request $request) {
    //     // Validasi file gambar
    //     $request->validate([
    //         'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Ambil pengguna yang login
    //     $user = User::find(Auth::id());

    //     // Hapus gambar lama jika ada
    //     if ($user->image && Storage::disk('public')->exists($user->image)) {
    //         Storage::disk('public')->delete($user->image);
    //     }

    //     // Simpan gambar baru
    //     $imagePath = $request->file('profile_picture')->store('profile_images', 'public');
    //     $user->image = $imagePath;
    //     $user->save();

    //     return redirect()->back()->with('success', 'Profile picture updated successfully!');
    // }

    public function updateProfilePic(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::find(Auth::id());

        // Hapus gambar lama jika ada
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        // Simpan gambar baru
        $imageName = 'profile_images/' . uniqid() . '.' . $request->image->extension();
        $request->image->storeAs('public', $imageName);
        $user->image = $imageName;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function updateAccInfo(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'telepon' => [
                'required',          // Nomor telepon wajib diisi
                'regex:/^[0-9]{10,15}$/', // Hanya angka, panjang 10-15 digit
            ],
            'alamat' => 'required|string|max:1000',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        $user = User::find(Auth::id()); // Ambil pengguna yang sedang login

        // Mengupdate informasi nama, email, telepon, dan alamat
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->telepon = $request->input('telepon'); // Tambahkan baris untuk menyimpan nomor telepon
        $user->alamat = $request->input('alamat');  // Tambahkan baris untuk menyimpan alamat

        // Jika ada gambar yang diupload, proses upload dan simpan nama file ke database
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('profile_images', 'public'); // Simpan di storage/app/public/profile_images
        //     $user->image = $imagePath; // Simpan path gambar ke kolom image
        // }

        $user->save(); // Simpan perubahan data

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());

        // Periksa apakah kata sandi saat ini cocok
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Perbarui kata sandi
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    public function deleteProfilePic()
    {
        // $user = Auth::user();
        $user = User::find(Auth::id());

        // Hapus gambar hanya jika ada
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
            $user->image = null; // Set gambar jadi null
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile picture deleted');
    }

    public function index(Request $request)
{
    $userId = Auth::user()->id; // Ambil ID pengguna yang sedang login

    // Menghitung statistik
    $totalOrders = DB::table('service_ins')
        ->where('user_id', $userId)
        ->count();

    $totalWaiting = DB::table('service_ins')
        ->where('user_id', $userId)
        ->where('status', 0)
        ->count();

    $totalRejected = DB::table('service_ins')
        ->where('user_id', $userId)
        ->where('status', 1)
        ->count();

    $totalAccepted = DB::table('service_ins')
        ->where('user_id', $userId)
        ->where('status', 2)
        ->count();

    $totalOnProcess = DB::table('service_ins')
        ->where('user_id', $userId)
        ->where('status', 3)
        ->count();

    $totalFinished = DB::table('service_ins')
        ->where('user_id', $userId)
        ->where('status', 4)
        ->count();

    // Query data customer dengan filter
    $query = DB::table('service_ins')
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
            'service_ins.catatan',
            'service_outs.tanggal_keluar',
            'service_outs.tanggal_diterima',
            'service_outs.biaya',
            'service_outs.catatan as catatan_service_out',
            DB::raw('COALESCE(service_ins.harga, 0) + COALESCE(service_outs.biaya, 0) as total_biaya')
        )
        ->where('service_ins.user_id', $userId);

    // Terapkan filter jika ada
    if ($request->filled('tanggal_masuk')) {
        $query->whereDate('service_ins.tanggal_masuk', $request->input('tanggal_masuk'));
    }

    if ($request->filled('order_id')) {
        $query->where('service_ins.order_id', $request->input('order_id'));
    }

    if ($request->filled('layanan')) {
        $query->where('master_layanans.id', $request->input('layanan'));
    }

    if ($request->filled('status')) {
        $query->where('service_ins.status', $request->input('status'));
    }

    if ($request->filled('status_payment')) {
        $query->where('service_ins.status_payment', $request->input('status_payment'));
    }

    // Urutkan data dan tambahkan pagination
    $customer = $query->orderBy('service_ins.tanggal_masuk', 'desc')->paginate(5);

    // Data tambahan untuk filter
    $layanans = DB::table('master_layanans')->where('status', '!=', 0)->get();

    return view('customer.order.index', compact('customer', 'totalOrders', 'totalWaiting', 'totalRejected', 'totalAccepted', 'totalOnProcess', 'totalFinished', 'layanans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $layanans = DB::table('master_layanans')->where('status', '!=', 0)->get(); // Ambil data layanan yang tidak berstatus 2

        return view('customer.order.add', compact('user', 'layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'layanan_id' => 'required',
            'deskripsi_masalah' => 'required',
        ]);

        // Simpan data customer
        // DB::table('users')->insert([
        //     'id' => Auth::user()->id,
        //     'name' => Auth::user()->name,
        //     'email' => Auth::user()->email,
        //     'telepon' => $request->telepon,
        //     'alamat' => $request->alamat,
        // ]);

        // Buat ID unik dengan format ORDER-(huruf dan angka random)
        $uniqueId = 'ORDER-' . Str::random(8);

        // Simpan data service_in
        DB::table('service_ins')->insert([
            // 'user_id' => DB::getPdo()->lastInsertId(),
            'user_id' => Auth::id(), // Ambil ID pengguna yang sedang login
            'layanan_id' => $request->layanan_id,
            'deskripsi_masalah' => $request->deskripsi_masalah,
            'status' => 0,  // Set status default
            'tanggal_masuk' => now(),
            'order_id' => 'ORDER-' . strtoupper(Str::random(8)),
        ]);

        return redirect('customer/order')->with('success', 'Order added');
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
        // Ambil data order berdasarkan ID
        $order = DB::table('service_ins')
            ->join('users', 'service_ins.user_id', '=', 'users.id')
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id')
            ->select(
                'service_ins.id',
                'service_ins.order_id',
                'users.name',
                'users.email',
                'users.telepon',
                'users.alamat',
                'service_ins.layanan_id',
                'service_ins.deskripsi_masalah'
            )
            ->where('service_ins.id', $id)
            ->first();

        return response()->json(['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input dari form edit
        $request->validate([
            'telepon' => 'required',
            'alamat' => 'required',
            'layanan_id' => 'required',
            'deskripsi_masalah' => 'required',
        ]);

        // Ambil user_id dari service_ins berdasarkan ID yang diberikan
        $serviceIn = DB::table('service_ins')->where('id', $id)->first();

        // Pastikan order ditemukan sebelum melakukan pembaruan
        if (!$serviceIn) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update data di tabel users menggunakan user_id
        DB::table('users')
            ->where('id', $serviceIn->user_id)
            ->update([
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'updated_at' => now(),
            ]);

        // Update data di tabel service_ins
        DB::table('service_ins')
            ->where('id', $id)
            ->update([
                'layanan_id' => $request->layanan_id,
                'deskripsi_masalah' => $request->deskripsi_masalah,
                'updated_at' => now(),
            ]);


        return redirect('customer/order')->with('success', 'Order updated successfully!');
        // $request->validate([
        //     'layanan_id' => 'required',
        //     'deskripsi_masalah' => 'required',
        // ]);

        // // Update data service_ins
        // DB::table('service_ins')
        //     ->where('id', $id)
        //     ->update([
        //         'layanan_id' => $request->layanan_id,
        //         'deskripsi_masalah' => $request->deskripsi_masalah,

        //     ]);

        //     return redirect('customer/order')->with('success', 'Order changed');
        // return redirect('customer/')->with('success', 'Order updated successfully');
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
