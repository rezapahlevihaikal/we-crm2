<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Deals;
use App\Models\InvStatus;
use App\Models\Companies;
use App\Models\Product;
use App\Models\User;
use DB;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
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
        $dataInvoice = Invoice::all();
        return view('invoice.index', compact('dataInvoice'));
        
    }

    public function requestInvoice()
    {
        $dataDealsIn = Deals::where('id_stage', 3, 5)->latest('id')->get();
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

        //==== deklarasi format nomor invoice====
        $formatHeader = 'WE';
        $dateNow = Carbon::now()->format('y');
        $order = Invoice::orderBy('created_at', 'desc')->first();
        //=======================================

        //======== Deklarasi Kode Sales ==========
        $midSalesAttribute = $dataDealsIn->getUser->initial;
        $endSalesAttribute = $dataDealsIn->getUser->id;
        //========================================

        //======== Deklarasi Nomor Order =========
        $headerOrder = $dataDealsIn->id_author;
        $attOrder = $dataDealsIn->id;
        //========================================
        
        
        $dataCreateIn = Invoice::create([
            'deals_id' => $dataDealsIn->id,
            'inv_date' => $request->inv_date,
            'exp_inv_date' => $request->exp_inv_date,
            'billed_value' => $request->billed_value,
            'product_id' => $dataDealsIn->id_product,
            'size' => $dataDealsIn->size,
            'sales_code' => $midSalesAttribute . $endSalesAttribute,
            'no_order' => $headerOrder . $attOrder,
            'author' => $dataDealsIn->id_author,
            'faktur_pajak' => $request->faktur_pajak,
            'ppn' => $request->input('ppn') ? $dataDealsIn->size * 11 / 100 : 0,
            'inv_status_id' => $request->inv_status_id,
            'pic_inv' => $request->pic_inv,
            'inv_number' => $formatHeader . $dateNow . "E" . str_pad($order->id + 1, 4, "0", STR_PAD_LEFT),
            'company_id' => $dataDealsIn->id_company,
            'inv_desc' => $request->inv_desc,

        ]);

        if ($dataCreateIn) {
            return redirect()->route('requestInvoice')->withStatus('data berhasil di generate');
        } else {
            return redirect()->back()->withErrors('data gagal di generate');
        }
        
    }

    public function downloadMediaOrder($id)
    {
        $dataDealsIn = Deals::where('id', $id)->firstOrFail();
        $filePath = public_path('uploads/'. $dataDealsIn->file);
        
        return response()->download($filePath);
    }

    public function editRequest($id)
    {
        $dataStatusInv = InvStatus::get(['id', 'name']);
        $dataInvoice = Invoice::findOrFail($id);
        return view('invoice.edit', compact('dataInvoice', 'dataStatusInv'));
    }

    public function updateRequest(Request $request, $id)
    {
        $dataInvoice = Invoice::findOrFail($id);
        
        $dataInvoice->update([
            'billed_value' => $request->billed_value,
            'faktur_pajak' => $request->faktur_pajak,
            'inv_date' => $request->inv_date,
            'exp_inv_date' => $request->exp_inv_date,
            'inv_status_id' => $request->inv_status_id,
            'pic_inv' => $request->pic_inv,
            'ppn' => $request->input('ppn') ? $request->size * 11 /100 : 0,
            'inv_desc' => $request->inv_desc
        ]);
        
        if($dataInvoice)
        {
            return redirect()->route('invoice')->withStatus('data berhasil diinput');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
    }

    public function generateDeals($id)
    {
        $dataInvoice = Invoice::findOrFail($id);
        $pdf = Pdf::loadView('invoice.invoice_page', compact('dataInvoice'));

        $headerName = $dataInvoice->inv_number;
        return $pdf->stream('INV-'.$headerName.'.pdf');
    }

    public function createSingleInvoice()
    {
        $dataCompany = Companies::get(['id', 'company_name']);
        $dataProduct = Product::get(['id', 'name']);
        $dataStatusInv = InvStatus::get(['id', 'name']);
        return view('invoice.create', compact('dataCompany', 'dataProduct', 'dataStatusInv'));
    }

    public function postCreateInvoice(Request $request)
    {
        $dataDealsIn = Deals::all();

        //==== deklarasi format nomor invoice====
        $formatHeader = 'WE';
        $dateNow = Carbon::now()->format('y');
        $order = Invoice::orderBy('created_at', 'desc')->first();
        //=======================================

        //======== Deklarasi Kode Sales ==========
        $midSalesAttribute = $dataDealsIn->getUser->initial;
        $endSalesAttribute = $dataDealsIn->getUser->id;
        //========================================

        //======== Deklarasi Nomor Order =========
        $headerOrder = $dataDealsIn->id_author;
        $attOrder = $dataDealsIn->id;
        //========================================

        $dataInvoice = Invoice::create([
            'inv_date' => $request->inv_date,
            'exp_inv_date' => $request->exp_inv_date,
            'billed_value' => $request->billed_value,
            'product_id' => $dataDealsIn->id_product,
            'size' => $dataDealsIn->size,
            'sales_code' => $midSalesAttribute . $endSalesAttribute,
            'no_order' => $headerOrder . $attOrder,
            'author' => $dataDealsIn->id_author,
            'faktur_pajak' => $request->faktur_pajak,
            'ppn' => $request->input('ppn') ? $dataDealsIn->size * 11 / 100 : 0,
            'inv_status_id' => $request->inv_status_id,
            'pic_inv' => $request->pic_inv,
            'inv_number' => $formatHeader . $dateNow . "E" . str_pad($order->id + 1, 4, "0", STR_PAD_LEFT),
            'company_id' => $dataDealsIn->id_company,
            'inv_desc' => $request->inv_desc,
        ]);
        dd($dataInvoice);
        if($dataInvoice)
        {
            return redirect()->route('invoice')->withStatus('data berhasil diinput');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
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
