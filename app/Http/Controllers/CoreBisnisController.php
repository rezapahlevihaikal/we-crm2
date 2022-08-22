<?php

namespace App\Http\Controllers;

use App\Models\CoreBisnis;
use App\Models\Divisi;
use Illuminate\Http\Request;

class CoreBisnisController extends Controller
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
        $dataDivisi = Divisi::get(['id', 'nama_divisi']);
        $dataCoreBisnis = CoreBisnis::with(['getDivisiCore'])->get();
        
        return view('coreBisnis.index', compact('dataDivisi', 'dataCoreBisnis'));
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
        $dataCoreBisnis = CoreBisnis::create([
            'nama_core_bisnis' => $request->nama_core_bisnis,
            'id_divisi' => $request->id_divisi
        ]);

        if ($dataCoreBisnis) {
            return redirect('coreBisnis')->with('success', 'data berhasil diinput');
        }
        else {
            return redirect()->back()->with('error', 'data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CoreBisnis  $coreBisnis
     * @return \Illuminate\Http\Response
     */
    public function show(CoreBisnis $coreBisnis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CoreBisnis  $coreBisnis
     * @return \Illuminate\Http\Response
     */
    public function edit(CoreBisnis $coreBisnis, $id)
    {
        //
        $dataDivisi = Divisi::get(['id', 'nama_divisi']);
        $dataCoreBisnis = CoreBisnis::findOrFail($id);

        return view('coreBisnis.edit', compact('dataDivisi', 'dataCoreBisnis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoreBisnis  $coreBisnis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoreBisnis $coreBisnis, $id)
    {
        //
        $dataCoreBisnis = CoreBisnis::findOrFail($id);
        $dataCoreBisnis->update([
            'nama_core_bisnis' => $request->nama_core_bisnis,
            'id_divisi' => $request->id_divisi
        ]);

        if ($dataCoreBisnis) {
            return redirect('coreBisnis')->with('success', 'data berhasil diupdate');
        }
        else {
            return redirect()->back()->with('error', 'data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoreBisnis  $coreBisnis
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoreBisnis $coreBisnis, $id)
    {
        //
        $dataCoreBisnis = CoreBisnis::findOrFail($id);
        $dataCoreBisnis->delete();

        return redirect()->back()->with('success', 'data berhasil dihapus');
    }
}
