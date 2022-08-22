<?php

namespace App\Http\Controllers;

use App\Models\Stages;
use Illuminate\Http\Request;

class StagesController extends Controller
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
        $dataStage = Stages::all();
        return view('stages.index', compact('dataStage'));
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
        $dataStage = Stages::create([
            'nama_stage' => $request->nama_stage
        ]);

        if ($dataStage) {
            return redirect('stages')->with('success','data berhasil diinput');
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
    public function edit($id)
    {
        //
        $dataStage = Stages::findOrFail($id);
        return view('stages.edit', compact('dataStage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $dataStage = Stages::findOrFail($id);
        $dataStage->update([
            'nama_stage' => $request->nama_stage
        ]);

        if($dataStage)
        {
            return redirect()->route('stages')->with('succes', 'Data Berhasil Diinput');
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
    public function destroy($id)
    {
        //
        $dataStage = Stages::findOrFail($id);
        $dataStage->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
