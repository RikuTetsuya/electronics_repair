<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function list() {
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = "Admin List";
        return view('admin.admin.list', $data);
    }

    public function add() {
        $data['header_title'] = "Add New Admin";
        return view('admin.admin.add', $data);
    }

    public function insert(Request $request) {
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

    public function edit($id) {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Admin";
            return view('admin.admin.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request) {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('admin/admin/list')->with('success', "Admin Edited");
    }

    public function activate($id) {
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

    public function deactivate($id) {
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

    public function destroy($id)
    {
        $delete = DB::table('users')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with('success', 'Admin Deleted');
        } else {
            return Redirect::back()->with('warning', 'Failed to delete');
        }
    }
}
