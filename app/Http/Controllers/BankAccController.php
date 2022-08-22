<?php

namespace App\Http\Controllers;

use App\Models\BankAcc;
use Illuminate\Http\Request;

class BankAccController extends Controller
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
        $dataBankAcc = BankAcc::all();

        return view('bankAcc.index', compact('dataBankAcc'));
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
        $dataBankAcc = BankAcc::create([
            'nama_bank' => $request->nama_bank
        ]);

        if($dataBankAcc)
        {
            return redirect('bankAcc')->withStatus('data berhasil diinput');
        }
        else
        {
            return redirect()->back()->withErrors('data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAcc  $bankAcc
     * @return \Illuminate\Http\Response
     */
    public function show(BankAcc $bankAcc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAcc  $bankAcc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dataBankAcc = BankAcc::findOrFail($id);
        return view('bankAcc.edit', compact('dataBankAcc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAcc  $bankAcc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataBankAcc = BankAcc::findOrFail($id);
        $dataBankAcc->update([
            'nama_bank'
        ]);

        if($dataBankAcc)
        {
            return redirect('bankAcc')->withStatus('data berhasil diupdate');
        }
        else
        {
            return redirect()->back()->withErrors('data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAcc  $bankAcc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dataBankAcc = BankAcc::findOrFail($id);
        $dataBankAcc->delete();

        return redirect()->back()->with('success', 'data berhasil dihapus');
    }
}
