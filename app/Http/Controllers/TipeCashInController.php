<?php

namespace App\Http\Controllers;

use App\Models\TipeCashIn;
use Illuminate\Http\Request;

class TipeCashInController extends Controller
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
        $data = TipeCashIn::all();
        return view('cashIn.tipeCashIn.index', compact('data'));
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
        $data = TipeCashIn::create([
            'name' => $request->name
        ]);

        if ($data) {
            return redirect()->route('tipeCashIn')->withStatus('data berhasil diinput');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipeCashIn  $tipeCashIn
     * @return \Illuminate\Http\Response
     */
    public function show(TipeCashIn $tipeCashIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipeCashIn  $tipeCashIn
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TipeCashIn::find($id);
        return view('cashIn.tipeCashIn.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipeCashIn  $tipeCashIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = TipeCashIn::find($id);
        $data->update([
            'name' => $request->name
        ]);

        if ($data) {
            return redirect()->route('tipeCashIn')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->withErrors('data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipeCashIn  $tipeCashIn
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TipeCashIn::find($id);
        $data->delete();

        return redirect()->back()->withStatus('data berhasil dihapus');
    }
}
