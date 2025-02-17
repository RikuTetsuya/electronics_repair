<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = DB::table('master_faqs')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faqs.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'question' => $request->question,
            'answer' => $request->answer,
            // 'status' => $request->status,
        ];

        $simpan = DB::table('master_faqs')->insert($data);
        if ($simpan) {
            return redirect('admin/faqs/list')->with(['success' => 'FAQ Added']);
        } else {
            return redirect('admin/faqs/list')->with(['warning' => 'FAQ Failed to Add']);
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
        $faqs = DB::table('master_faqs')->where('id', $id)->first();
        return view('admin.faqs.edit', compact('faqs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'question' => $request->question,
            'answer' => $request->answer,
            // 'status' => $request->status,
        ];

        $simpan = DB::table('master_faqs')->where('id', $id)->update($data);
        if ($simpan) {
            return redirect('admin/faqs/list')->with(['success' => 'FAQ Edited']);
        } else {
            return redirect('admin/faqs/list')->with(['warning' => 'FAQ Failed to Change']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    

    public function destroy($id)
    {
        $delete = DB::table('master_faqs')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with('success', 'FAQ Deleted');
        } else {
            return Redirect::back()->with('warning', 'FAQ Failed to Delete');
        }
    }
}
