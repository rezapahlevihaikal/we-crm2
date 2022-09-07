<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Deals;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        // $dataDealsIn = Deals::where('id_stage', 3)->get();
        // return view('invoice.index', compact('dataDealsIn'));
        
    }

    public function requestInvoice()
    {
        $dataDealsIn = Deals::where('id_stage', 3)->get();
        return view('invoice.indexRequest', compact('dataDealsIn'));
    }

    public function detailInvoice($id)
    {
        $dataDealsIn = Deals::findOrFail($id);
        return view('invoice.detailInvoice', compact('dataDealsIn'));
    }

    public function createInvoice(Request $request, $id)
    {
        
        $dataDealsIn = Deals::find($id);
        $dataDealsIn->update([
            'id_stage' => 5,
        ]);

        
        $dataCreateIn = Invoice::create([
            'deals_id' => $dataDealsIn->id
        ]);

        if ($dataCreateIn) {
            return redirect()->route('requestInvoice')->withStatus('data berhasil di generate');
        } else {
            return redirect()->back()->withErrors('data gagal di generate');
        }
        
    }

    public function generateDeals()
    {
        // $no = 1;
        // $invoice = Invoice::findOrFail($id);
        // $pdf = PDF::loadview('invoice.invoice_page', compact('no', 'invoice'));
        // $pdf->setPaper('legal', 'potrait');
        // return $pdf->stream();
        $pdf = Pdf::loadView('invoice.invoice_page');
        return $pdf->stream('invoice.pdf');
        
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
