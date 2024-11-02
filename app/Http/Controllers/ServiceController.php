<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = DB::table('master_layanans')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ];

        $simpan = DB::table('master_layanans')->insert($data);
        if ($simpan) {
            return redirect('admin/service/list')->with(['success' => 'Data Sub-Department Berhasil Disimpan']);
        } else {
            return redirect('admin/service/list')->with(['warning' => 'Data Sub- Gagal Disimpan']);
        }
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
        $services = DB::table('master_layanans')->where('id', $id)->first();
        return view('admin.services.edit', compact('services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ];

        $simpan = DB::table('master_layanans')->where('id', $id)->update($data);
        if ($simpan) {
            return redirect('admin/service/list')->with(['success' => 'Data Sub-Department Berhasil Diubah']);
        } else {
            return redirect('admin/service/list')->with(['warning' => 'Data Sub- Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    

    public function destroy($id)
    {
        $delete = DB::table('master_layanans')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with('success', 'Service Deleted');
        } else {
            return Redirect::back()->with('warning', 'Failed to delete');
        }
    }
}
