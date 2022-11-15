<?php

namespace App\Http\Controllers;

use App\Models\CashOut;
use App\Models\TipeCost;
use App\Models\SubTipe;
use App\Models\Product;
use App\Models\CoreBisnis;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CashOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dataCashOut = CashOut::all();
        return view('cashOut.index', compact('dataCashOut'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dataCoreBisnis = CoreBisnis::get(['id', 'nama_core_bisnis']);
        $dataTipeCost = TipeCost::get(['id', 'nama']);
        $dataSubTipe = SubTipe::get(['id', 'name']);
        $dataProduct = Product::get(['id', 'name']);

        return view('cashOut.create', compact('dataCoreBisnis', 'dataTipeCost', 'dataSubTipe', 'dataProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filename = null;
        $request->validate([
            'file' => 'nullable|mimes:jpg,jpeg,png,doc,docx,xlx,xlsx,pdf|max:5120'
        ]);

        $rules = [
            'file' => 'nullable|mimes:jpg,jpeg,png,doc,docx,xlx,xlsx,pdf|max:5120'
        ];

        $customMessage = [
            'max' => 'The :attribute max :value'
        ];

        $this->validate($request, $rules, $customMessage);

        $nameDoc = Carbon::now()->format('ymd');
        $headerNameDoc = 'FileCashOut';
        $sourceDoc = Auth::user()->id;

        if ($request->file) {
            $filename = $headerNameDoc."_".$nameDoc."_".$sourceDoc."_".".".$request->file->extension();        
            $request->file->move(public_path('uploads'), $filename);
        }        
        
        $dataCashOut = CashOut::create([
            'subtipe_id' => $request->subtipe_id,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'nominal' => $request->nominal,
            'dibayarkan_kepada' => $request->dibayarkan_kepada,
            'pic_id' => Auth::user()->id,
            'ket_pembayaran' => $request->ket_pembayaran,
            'product_id' => $request->product_id,
            'core_bisnis_id' => $request->core_bisnis_id,
            'file' => $filename
        ]);
        
        if ($dataCashOut) {
            return redirect()->route('cashOut')->withStatus('data berhasil diinput');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashOut  $cashOut
     * @return \Illuminate\Http\Response
     */
    public function show(CashOut $cashOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashOut  $cashOut
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataCoreBisnis = CoreBisnis::get(['id', 'nama_core_bisnis']);
        $dataTipeCost = TipeCost::get(['id', 'nama']);
        $dataSubTipe = SubTipe::get(['id', 'name']);
        $dataProduct = Product::get(['id', 'name']);
        $dataCashOut = CashOut::findOrFail($id);

        return view('cashOut.edit', compact('dataCashOut','dataCoreBisnis', 'dataTipeCost', 'dataSubTipe', 'dataProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CashOut  $cashOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|mimes:jpg,jpeg,png,doc,docx,xlx,xlsx,pdf|max:5120'
        ]);

        $dataCashOut = CashOut::findOrFail($id);

        $nameDoc = Carbon::now()->format('ymd');
        $headerNameDoc = 'FileCashOut';
        $sourceDoc = Auth::user()->id;

        if ($request->has('file')) {
            $filename = $headerNameDoc."_".$nameDoc."_".$sourceDoc.".".$request->file->getClientOriginalExtension();
            File::delete(public_path('uploads'), $dataCashOut->file);
            $request->file->move(public_path('uploads'), $filename);
        }
        else {
            $filename = $dataCashOut->file;
        }

        $dataCashOut->update([
            'subtipe_id' => $request->subtipe_id,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'nominal' => $request->nominal,
            'dibayarkan_kepada' => $request->dibayarkan_kepada,
            'ket_pembayaran' => $request->ket_pembayaran,
            'product_id' => $request->product_id,
            'core_bisnis_id' => $request->core_bisnis_id,
            'file' => $filename         
        ]);

        if ($dataCashOut) {
            return redirect()->route('cashOut')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->withErrors('data gagal diupdate');
        }   
    }

    public function getFileCashOut($id)
    {
        $dataCashOut = CashOut::where('id', $id)->first();
        $filePath = public_path('uploads/'. $dataCashOut->file);
        // dd($filePath);
        return response()->download($filePath);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashOut  $cashOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashOut $cashOut)
    {
        //
    }
}
