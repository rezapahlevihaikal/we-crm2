<?php

namespace App\Http\Controllers;

use App\Models\CashIn;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashInController extends Controller
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
        $dataCashIn = CashIn::all();
        return view('cashIn.index', compact('dataCashIn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dataInvoice = Invoice::whereIn('inv_status_id', [2, 3])->get(['id', 'inv_number', 'product_id', 'company_id']);
        // $dataInvoice = DB::table('invoices')->select('*')->whereIn('inv_status_id',[2, 3])->get(['id', 'inv_number', 'product_id', 'company_id']);
        return view('cashIn.create', compact('dataInvoice'));
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
        $headerNameDoc = 'FileCashIn';
        $sourceDoc = Auth::user()->id;

        if ($request->file) {
            $filename = $headerNameDoc."_".$nameDoc."_".$sourceDoc."_".".".$request->file->extension();        
            $request->file->move(public_path('uploads'), $filename);
        }        
        
        $dataCashIn = CashIn::create([
            'inv_id' => $request->inv_id,
            'author_id' => Auth::user()->id,
            'cash_in_date' => $request->cash_in_date,
            'nominal_cash_in' => str_replace('.', '', $request->nominal_cash_in),
            'nominal_ppn' => str_replace('.', '', $request->nominal_ppn),
            'nominal_pph' => str_replace('.', '', $request->nominal_pph),
            'file' => $filename,
            'bank_penerima' => $request->bank_penerima,
            'deskripsi' => $request->deskripsi
        ]);
        
        if ($dataCashIn) {
            return redirect()->route('cashIn')->withStatus('data berhasil diinput');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashIn  $cashIn
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashIn  $cashIn
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dataInvoice = Invoice::get(['id', 'inv_number', 'product_id', 'company_id']);
        $dataCashIn = CashIn::find($id);

        return view('cashIn.edit', compact('dataInvoice', 'dataCashIn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CashIn  $cashIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|mimes:jpg,jpeg,png,doc,docx,xlx,xlsx,pdf|max:5120'
        ]);

        $dataCashIn = CashIn::find($id);

        $nameDoc = Carbon::now()->format('ymd');
        $headerNameDoc = 'FileCashOut';
        $sourceDoc = Auth::user()->id;

        if ($request->has('file')) {
            $filename = $headerNameDoc."_".$nameDoc."_".$sourceDoc.".".$request->file->getClientOriginalExtension();
            File::delete(public_path('uploads'), $dataCashIn->file);
            $request->file->move(public_path('uploads'), $filename);
        }
        else {
            $filename = $dataCashIn->file;
        }

        $dataCashIn->update([
            'inv_id' => $request->inv_id,
            'cash_in_date' => $request->cash_in_date,
            'nominal_cash_in' => str_replace('.', '', $request->nominal_cash_in),
            'nominal_ppn' => str_replace('.', '', $request->nominal_ppn),
            'nominal_pph' => str_replace('.', '', $request->nominal_pph),
            'file' => $filename,
            'bank_penerima' => $request->bank_penerima,
            'deskripsi' => $request->deskripsi      
        ]);

        if ($dataCashIn) {
            return redirect()->route('cashIn')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->withErrors('data gagal diupdate');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashIn  $cashIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashIn $cashIn)
    {
        //
    }
}
