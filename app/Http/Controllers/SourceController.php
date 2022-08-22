<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
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
        $dataSource = Source::all();
        return view('source.index', compact('dataSource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $dataSource = Source::create([
            'nama_source' => $request->nama_source
        ]);

        if ($dataSource) {
            # code...
            return redirect()->route('source')->withStatus('data berhasil diinput');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dataSource = Source::findOrFail($id);
        return view('source.edit', compact('dataSource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $dataSource = Source::findOrFail($id);
        $dataSource->update([
            'nama_source' => $request->nama_source
        ]);

        if ($dataSource) {
            # code...
            return redirect()->route('source')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dataSource = Source::findOrFail($id);
        $dataSource->delete();

        return redirect()->back()->withStatus('data berhasil dihapus');
    }
}
