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

class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::whereIn('user_type', [1, 3, 4])
            ->orderBy('user_type', 'desc') // Urutkan Superadmin dulu
            ->get();
        $data['header_title'] = "Admin List";
        return view('admin.admin.list', $data);
    }

    public function listCust()
    {
        $data['getRecord'] = User::whereIn('user_type', [2])
            ->orderBy('user_type', 'desc') // Urutkan Superadmin dulu
            ->get();
        $data['header_title'] = "Admin List";
        return view('admin.customer.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Admin";
        return view('admin.admin.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', "New Admin Added");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Admin";
            return view('admin.admin.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if (!empty($request->user_type)) {
            $user->user_type = $request->user_type;
        }
        $user->save();
        return redirect('admin/admin/list')->with('success', "Admin Edited");
    }

    public function activate($id)
    {
        $user = User::getSingle($id);

        // ini untuk ngecek apakah is_delete saat ini adalah 1/0
        if ($user->is_delete == 1) {
            // kalo is_delete 1 maka aktifkan admin
            $user->is_delete = 0;
            $user->save();

            return redirect('admin/admin/list')->with('success', "Admin Activated");
        } else {
            // Jika is_delete udh 0 dari awal, tampilin pesan klo admin udh aktif
            return redirect('admin/admin/list')->with('success', "Admin's Already Activated :)");
        }
    }

    public function activateCust($id)
    {
        $user = User::getSingle($id);

        // ini untuk ngecek apakah is_delete saat ini adalah 1/0
        if ($user->is_delete == 1) {
            // kalo is_delete 1 maka aktifkan admin
            $user->is_delete = 0;
            $user->save();

            return redirect('admin/customer/list')->with('success', "Admin Activated");
        } else {
            // Jika is_delete udh 0 dari awal, tampilin pesan klo admin udh aktif
            return redirect('admin/customer/list')->with('success', "Admin's Already Activated :)");
        }
    }

    public function deactivate($id)
    {
        $user = User::getSingle($id);

        // ini untuk ngecek apakah is_delete saat ini adalah 1/0 (0=aktif, 1=nonaktif)
        if ($user->is_delete == 0) {
            // kalo is_delete 0 maka nonaktifkan admin
            $user->is_delete = 1;
            $user->save();

            return redirect('admin/admin/list')->with('success', "Admin Deactivated");
        } else {
            // Jika is_delete udh 1 dari awal, tampilin pesan klo admin udh aktif
            return redirect('admin/admin/list')->with('success', "Admin's Already Deactivated :)");
        }
    }

    public function deactivateCust($id)
    {
        $user = User::getSingle($id);

        // ini untuk ngecek apakah is_delete saat ini adalah 1/0 (0=aktif, 1=nonaktif)
        if ($user->is_delete == 0) {
            // kalo is_delete 0 maka nonaktifkan admin
            $user->is_delete = 1;
            $user->save();

            return redirect('admin/customer/list')->with('success', "Admin Deactivated");
        } else {
            // Jika is_delete udh 1 dari awal, tampilin pesan klo admin udh aktif
            return redirect('admin/customer/list')->with('success', "Admin's Already Deactivated :)");
        }
    }

    public function destroy($id)
    {
        $delete = DB::table('users')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with('success', 'Admin Deleted');
        } else {
            return Redirect::back()->with('warning', 'Failed to delete');
        }
    }

    public function accInfo()
    {
        $user = Auth::user();  // Dapatkan data pengguna yang sedang login
        return view('admin.profile.index', compact('user'));
    }

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

    public function listRating()
    {
        $ratings = DB::table('service_ins')
            ->join('users', 'service_ins.user_id', '=', 'users.id') // Join dengan users berdasarkan user_id
            ->join('master_layanans', 'service_ins.layanan_id', '=', 'master_layanans.id') // Join dengan master_layanans berdasarkan layanan_id
            ->select(
                'service_ins.id',
                'service_ins.rating',
                'service_ins.feedback',
                'service_ins.layanan_id',
                'master_layanans.nama_layanan as layanan', // Menampilkan nama layanan dari master_layanans
                'service_ins.user_id',
                'users.name as user_name', // Menampilkan nama user
                'users.image as image'
            )
            ->whereNotNull('service_ins.rating')  // Hanya menampilkan yang memiliki rating
            ->whereNotNull('service_ins.feedback') // Hanya menampilkan yang memiliki feedback
            ->get();
        return view('admin.rating.list', compact('ratings'));
    }
    
    public function editRatingOrder(Request $request, $id) {
        $ratings = DB::table('service_ins')
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

        // if (!$ratings) {
        //     // Jika tidak ditemukan data, tampilkan halaman 404 atau pesan error
        //     abort(404, 'Order not found');
        // }
    
        return view('admin.rating.edit', compact('ratings'));
    }

    public function updateRatingOrder(Request $request, $id) {
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
