<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dataDivisi = Divisi::all();
        return view('divisi.index', compact('dataDivisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dataDivisi = Divisi::create([
            'nama_divisi' => $request->nama_divisi
        ]);

        if ($dataDivisi) {
            return redirect('divisi')->with('success','data berhasil diinput');
        }
        else{
            return redirect()->back()->with('error', 'data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Divisi $divisi, $id)
    {
        //
        $dataDivisi = Divisi::findOrFail($id);
        return view('divisi.edit', compact('dataDivisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Divisi $divisi, $id)
    {
        //
        $dataDivisi = Divisi::findOrFail($id);
        $dataDivisi->update([
            'nama_divisi' => $request->nama_divisi
        ]);

        if($dataDivisi)
        {
            return redirect()->route('divisi')->with('succes', 'Data Berhasil Diinput');
        }
        else
        {
            return redirect()->back()->with('error', 'Data Gagal Diinput');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Divisi $divisi, $id)
    {
        //
        $dataDivisi = Divisi::findOrFail($id);
        $dataDivisi->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
