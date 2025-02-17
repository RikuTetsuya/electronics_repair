<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;

use Illuminate\Support\Facades\Mail;
// use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function adminRegister() {
        return view('auth.adminregister');
    }

    public function adminRegisterStore(Request $request) {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Menyimpan data ke tabel users
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing password
            'user_type' => 1, // User type 1
        ]);

        return redirect('login')->with('success', 'User added successfully.');
    }

    public function userRegister() {
        return view('auth.register');
    }

    public function userRegisterStore(Request $request) {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        // Generate ID Unik
        do {
            $randomNumber = mt_rand(100000, 999999);  // Angka acak 6 digit
            $uniqueId = '1010' . $randomNumber;
        } while (DB::table('users')->where('id', $uniqueId)->exists());  // Cek apakah ID sudah ada

        // Menyimpan data ke tabel users
        User::create([
            'id' => $uniqueId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing password
            'user_type' => 2, // User type 1
            'telepon' => $request->telepon ?? '', // Tambahkan ini
        ]);

        return redirect('login')->with('success', 'User added successfully.');
    }
    
    public function landing() {
        $layanans = DB::table('master_layanans')
        ->select('nama_layanan')
        ->where('status', 1)
        ->paginate(8); // 8 item per halaman

        $ratings = DB::table('master_ratings')
        ->join('users', 'master_ratings.user_id', '=', 'users.id')
        ->select('master_ratings.*', 'users.name as user_name', 'users.image as image')
        ->get();

        return view('customer.landing', compact('layanans', 'ratings'));
     }
     
    public function login() {
        // dd(Hash::make('123'));
        if(!empty(Auth::check())){
            if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3)
            {
                return redirect('admin/dashboard');
            }

            else if(Auth::user()->user_type == 2)
            {
                return redirect('customer/main');
            }

            // else if(Auth::user()->user_type == 3)
            // {
            //     return redirect('administrator/dashboard');
            // }
        }
         
        return view('auth.login');
    }
 
    // public function AuthLogin(Request $request) {
    //     // dd($request->all());
    //     $remember = !empty($request) ? true : false;
    //     if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            
    //         if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3)
    //         {
    //             return redirect('admin/dashboard');
    //         }

    //         else if(Auth::user()->user_type == 2)
    //         {
    //             return redirect('customer/main');
    //         }

    //         // else if(Auth::user()->user_type == 3)
    //         // {
    //         //     return redirect('admin/dashboard');
    //         // }

    //     } else {

    //         return redirect()->back()->with('error', 'Please enter the right email and password');
        
    //     }
    // }

    public function AuthLogin(Request $request) {
        // dd($request->all());
        $remember = !empty($request->remember) ? true : false;
    
        // Cek apakah pengguna ada dan is_delete = 0
        $user = User::where('email', $request->email)->first();
    
        if ($user && $user->is_delete == 0 && Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            
            if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3) {
                return redirect('admin/dashboard');
            } else if(Auth::user()->user_type == 2) {
                return redirect('customer/main');
            }
    
        } else {
            return redirect()->back()->with('error', 'Please enter the right email and password or your account has been banned');
        }
    }

    public function forgotpassword() {
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request) {
        $user = User::getEmailSingle($request->email);

        if(!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'We have sent an email, check to reset your password');
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function reset($remember_token) {
        $user = User::getTokenSingle($remember_token);

        if(!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset');
        } else {
            abort(404);
        }
    }

    public function PostReset($token, Request $request) {
        if($request->password == $request->cpassword) {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url('login'))->with('success', 'Password changed');
        } else {
            return redirect()->back()->with('error', 'Password and Confirm Password does not match');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }   
}
